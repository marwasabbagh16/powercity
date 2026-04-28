<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchProductImages extends Command
{
    protected $signature = 'products:fetch-images {--limit=50}';
    protected $description = 'Récupère les images produits';

    public function handle()
    {
        $limit = $this->option('limit');
        $products = Product::whereNull('image')->limit($limit)->get();
        $this->info("Traitement de {$products->count()} produits...");

        $success = 0;
        $failed  = 0;

        foreach ($products as $product) {
            $this->line("Traitement : {$product->reference}");

            try {
                $query = 'Eaton ' . $product->reference . ' product';

                // Utiliser l'API DuckDuckGo correctement
                $tokenResponse = Http::timeout(10)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                        'Accept' => 'text/html',
                    ])
                    ->get('https://duckduckgo.com/');

                preg_match('/vqd=([\d-]+)&/', $tokenResponse->body(), $vqdMatch);
                
                if (empty($vqdMatch[1])) {
                    // Essayer autre format
                    preg_match("/vqd='([\d-]+)'/", $tokenResponse->body(), $vqdMatch);
                }

                // Si toujours pas de token, utiliser Unsplash comme fallback
                if (empty($vqdMatch[1])) {
                    $this->warn("Token introuvable, utilisation fallback...");
                    
                    // Chercher sur ecosia images
                    $ecosiaResponse = Http::timeout(10)
                        ->withHeaders([
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                        ])
                        ->get('https://www.ecosia.org/images', [
                            'q' => $query,
                        ]);

                    preg_match('/"thumbnail":"(https?:\/\/[^"]+)"/', 
                        $ecosiaResponse->body(), $imgMatch);

                    if (!empty($imgMatch[1])) {
                        $imageUrl = $imgMatch[1];
                        $this->saveImage($product, $imageUrl);
                        $success++;
                    } else {
                        $this->warn("✗ Pas d'image : {$product->reference}");
                        $failed++;
                    }

                    usleep(rand(1000000, 2000000));
                    continue;
                }

                $vqd = $vqdMatch[1];

                $searchResponse = Http::timeout(10)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                        'Referer' => 'https://duckduckgo.com/',
                        'Accept' => 'application/json',
                    ])
                    ->get('https://duckduckgo.com/i.js', [
                        'q'   => $query,
                        'vqd' => $vqd,
                        'p'   => '1',
                        'f'   => ',,,,,',
                        'o'   => 'json',
                    ]);

                $data = $searchResponse->json();

                if (!empty($data['results'][0]['image'])) {
                    $imageUrl = $data['results'][0]['image'];
                    $saved = $this->saveImage($product, $imageUrl);
                    if ($saved) {
                        $success++;
                    } else {
                        $failed++;
                    }
                } else {
                    $this->warn("✗ Pas de résultat : {$product->reference}");
                    $failed++;
                }

                usleep(rand(1500000, 2500000));

            } catch (\Exception $e) {
                $this->error("Erreur {$product->reference} : " . $e->getMessage());
                $failed++;
            }
        }

        $this->info("Terminé ! ✓ Succès : {$success} | ✗ Échecs : {$failed}");
    }

    private function saveImage($product, $imageUrl)
    {
        try {
            $imageResponse = Http::timeout(15)
                ->withHeaders(['User-Agent' => 'Mozilla/5.0'])
                ->get($imageUrl);

            if ($imageResponse->successful() && strlen($imageResponse->body()) > 2000) {
                $filename = 'products/' . preg_replace('/[^a-zA-Z0-9\-]/', '_', $product->reference) . '.jpg';
                Storage::disk('public')->put($filename, $imageResponse->body());
                $product->update(['image' => $filename]);
                $this->info("✓ {$product->reference}");
                return true;
            }
        } catch (\Exception $e) {
            $this->error("Save error: " . $e->getMessage());
        }
        return false;
    }
}