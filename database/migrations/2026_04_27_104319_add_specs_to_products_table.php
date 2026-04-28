<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('topologie')->nullable()->after('description');
        $table->string('puissance')->nullable()->after('topologie');
        $table->string('rendement')->nullable()->after('puissance');
        $table->string('configuration')->nullable()->after('rendement');
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['topologie', 'puissance', 'rendement', 'configuration']);
    });
}
};
