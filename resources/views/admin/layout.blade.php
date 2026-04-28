<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PowerCity Admin – @yield('title', 'Dashboard')</title>
<link rel="icon" type="image/png" href="{{ asset('images/logoo.png') }}"class="h-30 w-auto">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/lucide@0.263.1/dist/umd/lucide.min.js"></script>
<style>
:root {
    --navy: #0d2b45;
    --navy-dark: #081828;
    --navy-mid: #0f3356;
    --green: #4caf50;
    --green-dark: #388e3c;
    --text: #e8edf5;
    --text-muted: #8a9bbf;
    --border: rgba(255,255,255,0.08);
    --card: rgba(13,43,69,0.9);
    --sidebar-w: 240px;
}
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Sora',sans-serif; background:var(--navy-dark); color:var(--text); min-height:100vh; display:flex; }

/* SIDEBAR */
.sidebar { width:var(--sidebar-w); min-height:100vh; background:linear-gradient(180deg,var(--navy) 0%,#050f1a 100%); border-right:1px solid var(--border); display:flex; flex-direction:column; position:fixed; left:0; top:0; bottom:0; z-index:100; }
.sidebar-logo { padding:20px 16px; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:10px; }
.logo-icon { width:36px; height:36px; background:var(--green); border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:16px; color:#fff; }
.logo-text { font-weight:800; font-size:15px; color:#fff; }
.logo-text span { color:var(--green); }
.logo-sub { font-size:10px; color:var(--text-muted); margin-top:1px; }

.sidebar-section { padding:16px 12px 4px; }
.sidebar-label { font-size:10px; font-weight:600; letter-spacing:0.12em; color:var(--text-muted); text-transform:uppercase; padding:0 8px 8px; }

.nav-item { display:flex; align-items:center; gap:10px; padding:9px 12px; border-radius:8px; cursor:pointer; font-size:13px; font-weight:500; color:var(--text-muted); transition:all .18s; margin-bottom:2px; text-decoration:none; }
.nav-item:hover { background:rgba(255,255,255,0.06); color:var(--text); }
.nav-item.active { background:linear-gradient(90deg,rgba(76,175,80,0.2),rgba(76,175,80,0.05)); color:var(--green); border-left:2px solid var(--green); }
.nav-badge { margin-left:auto; background:var(--green); color:#fff; font-size:10px; font-weight:700; border-radius:20px; padding:1px 7px; }
.nav-badge.red { background:#ef4444; }
.nav-badge.blue { background:#2563eb; }

.sidebar-footer { margin-top:auto; padding:14px 12px; border-top:1px solid var(--border); }
.admin-chip { display:flex; align-items:center; gap:10px; background:rgba(255,255,255,0.04); border-radius:10px; padding:10px 12px; }
.admin-avatar { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,var(--green),#2563eb); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:13px; color:#fff; }
.admin-name { font-size:12px; font-weight:600; }
.admin-role { font-size:10px; color:var(--text-muted); }

/* MAIN */
.main { margin-left:var(--sidebar-w); flex:1; display:flex; flex-direction:column; min-height:100vh; }

/* TOPBAR */
.topbar { height:60px; padding:0 24px; display:flex; align-items:center; justify-content:space-between; background:rgba(8,24,40,0.9); border-bottom:1px solid var(--border); backdrop-filter:blur(12px); position:sticky; top:0; z-index:50; }
.page-title { font-size:17px; font-weight:700; }
.breadcrumb { font-size:11px; color:var(--text-muted); margin-top:2px; }
.topbar-right { display:flex; align-items:center; gap:10px; }
.icon-btn { width:34px; height:34px; border-radius:8px; background:rgba(255,255,255,0.05); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background .15s; }
.icon-btn:hover { background:rgba(255,255,255,0.1); }

/* CONTENT */
.content { padding:24px; flex:1; }

/* KPI */
.kpi-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:20px; }
.kpi-card { background:var(--card); border:1px solid var(--border); border-radius:12px; padding:18px; position:relative; overflow:hidden; transition:transform .18s; }
.kpi-card:hover { transform:translateY(-2px); }
.kpi-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--kpi-color, var(--green)); }
.kpi-icon { width:36px; height:36px; border-radius:10px; background:var(--kpi-bg,rgba(76,175,80,0.15)); display:flex; align-items:center; justify-content:center; margin-bottom:12px; }
.kpi-val { font-size:24px; font-weight:800; margin-bottom:2px; }
.kpi-label { font-size:11px; color:var(--text-muted); }
.kpi-delta { font-size:11px; margin-top:6px; }
.kpi-delta.up { color:var(--green); }
.kpi-delta.down { color:#ef4444; }

/* PANEL */
.panel { background:var(--card); border:1px solid var(--border); border-radius:12px; overflow:hidden; margin-bottom:16px; }
.panel-head { padding:14px 18px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
.panel-title { font-size:14px; font-weight:700; }

/* TABLE */
.table-wrap { overflow-x:auto; }
table { width:100%; border-collapse:collapse; font-size:13px; }
th { text-align:left; padding:10px 16px; font-size:11px; font-weight:600; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.07em; border-bottom:1px solid var(--border); background:rgba(255,255,255,0.02); }
td { padding:11px 16px; border-bottom:1px solid rgba(255,255,255,0.04); vertical-align:middle; }
tr:last-child td { border-bottom:none; }
tr:hover td { background:rgba(255,255,255,0.02); }

/* STATUS */
.pill { display:inline-flex; align-items:center; gap:4px; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }
.pill::before { content:'●'; font-size:7px; }
.pill-green { background:rgba(76,175,80,0.15); color:#4caf50; }
.pill-yellow { background:rgba(234,179,8,0.15); color:#eab308; }
.pill-red { background:rgba(239,68,68,0.15); color:#ef4444; }
.pill-blue { background:rgba(37,99,235,0.15); color:#60a5fa; }

/* BTN */
.btn { padding:7px 14px; border-radius:8px; font-size:12px; font-weight:600; cursor:pointer; border:none; transition:all .15s; display:inline-flex; align-items:center; gap:6px; font-family:'Sora',sans-serif; }
.btn-green { background:var(--green); color:#fff; }
.btn-green:hover { background:var(--green-dark); }
.btn-outline { background:transparent; color:var(--text-muted); border:1px solid var(--border); }
.btn-outline:hover { border-color:var(--green); color:var(--green); }
.btn-red { background:#ef4444; color:#fff; }

/* GRID */
.grid-2 { display:grid; grid-template-columns:1.5fr 1fr; gap:16px; margin-bottom:16px; }
.grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:16px; }

/* ALERT */
.alert-green { display:flex; align-items:center; gap:10px; background:rgba(76,175,80,0.1); border:1px solid rgba(76,175,80,0.25); border-radius:10px; padding:12px 16px; margin-bottom:18px; font-size:13px; }

/* DEVIS ITEM */
.devis-item { display:flex; align-items:flex-start; gap:12px; padding:13px 16px; border-bottom:1px solid rgba(255,255,255,0.04); transition:background .15s; }
.devis-item:last-child { border-bottom:none; }
.devis-item:hover { background:rgba(255,255,255,0.03); }
.dav { width:34px; height:34px; border-radius:50%; background:linear-gradient(135deg,var(--green),#2563eb); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:12px; color:#fff; flex-shrink:0; }

/* SCROLLBAR */
::-webkit-scrollbar { width:5px; }
::-webkit-scrollbar-thumb { background:rgba(255,255,255,0.1); border-radius:3px; }

/* FLASH */
.flash { padding:10px 16px; border-radius:8px; margin-bottom:16px; font-size:13px; }
.flash-success { background:rgba(76,175,80,0.15); border:1px solid rgba(76,175,80,0.3); color:#4caf50; }

/* Fix pagination SVG icons */
svg {
    display: inline;
    width: 1em;
    height: 1em;
    vertical-align: middle;
}
</style>
@stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">⚡</div>
        <div>
            <div class="logo-text">PO<span>W</span>ERCITY</div>
            <div class="logo-sub">Admin Panel</div>
        </div>
    </div>
    

    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    📊 Tableau de bord
</a>
<a href="{{ route('admin.products') }}" class="nav-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
    📦 Produits
</a>
<a href="{{ route('admin.devis') }}" class="nav-item {{ request()->routeIs('admin.devis*') ? 'active' : '' }}">
    📋 Demandes de devis
</a>
<a href="{{ route('admin.clients') }}" class="nav-item {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
    👥 Clients
</a>

    <a href="{{ route('admin.categories') }}" class="nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
    🗂️ Catégories
</a>
<a href="{{ route('home') }}" class="nav-item" target="_blank">
    🌐 Voir le site
</a>

    <div class="sidebar-footer">
        <div class="admin-chip">
            <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="admin-name">{{ auth()->user()->name }}</div>
                <div class="admin-role">Administrateur</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="margin-top:8px">
            @csrf
            <button class="btn btn-outline" style="width:100%;justify-content:center;margin-top:6px">
                 🚪 Déconnexion
              </button>
        </form>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div>
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
            <div class="breadcrumb">Admin / @yield('breadcrumb', 'Dashboard')</div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('home') }}" class="icon-btn" target="_blank" title="Voir le site">
                🌐
            </a>
             <div class="icon-btn">
               🔔
             </div>
            <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--green),#2563eb);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </header>

    <div class="content">
        @if(session('success'))
        <div class="flash flash-success">✅ {{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/lucide@0.263.1/dist/umd/lucide.min.js" onload="lucide.createIcons()"></script>
@stack('scripts')
</body>
</html>