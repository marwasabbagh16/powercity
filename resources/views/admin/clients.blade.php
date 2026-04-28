@extends('admin.layout')
@section('title', 'Clients')
@section('page-title', 'Gestion des clients')
@section('breadcrumb', 'Clients')

@section('content')

<div class="panel">
    <div class="panel-head">
        <span class="panel-title">{{ $clients->total() }} clients</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Entreprise</th>
                    <th>Ville</th>
                    <th>Demandes</th>
                    <th>Dernier contact</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px">
                            <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--green),#2563eb);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;color:#fff;flex-shrink:0">
                                {{ strtoupper(substr($client->client_name, 0, 2)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:13px">{{ $client->client_name }}</div>
                                <div style="font-size:11px;color:var(--text-muted)">{{ $client->client_email }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:13px">{{ $client->client_company ?? '—' }}</td>
                    <td style="font-size:13px;color:var(--text-muted)">{{ $client->client_city ?? '—' }}</td>
                    <td>
                        <span style="font-weight:700;color:var(--green);font-size:15px">{{ $client->total_devis }}</span>
                        <span style="font-size:11px;color:var(--text-muted)"> demande(s)</span>
                    </td>
                    <td style="font-size:11px;color:var(--text-muted)">
                        {{ \Carbon\Carbon::parse($client->dernier_contact)->format('d/m/Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:30px;color:var(--text-muted)">Aucun client pour le moment</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:16px">{{ $clients->links() }}</div>
</div>

@endsection