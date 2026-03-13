<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Car Wash — Admin Dashboard</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@400;500&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --bg0:#060c14;--bg1:#0a1220;--bg2:#0f1a2e;--bg3:#152238;
  --border:rgba(255,255,255,0.07);--border2:rgba(255,255,255,0.12);
  --cyan:#00d4ff;--teal:#00b89c;--amber:#f59e0b;--amber2:#fbbf24;
  --blue:#3b82f6;--green:#22c55e;--red:#ef4444;--purple:#a78bfa;
  --text:#e8f1ff;--soft:#8da0bc;--muted:#4a5e7a;
  --r:10px;--r2:16px;--shadow:0 20px 60px rgba(0,0,0,0.6);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Outfit',sans-serif;background:var(--bg0);color:var(--text);min-height:100vh;overflow-x:hidden;}
body::before{content:'';position:fixed;inset:0;z-index:0;
  background:
    radial-gradient(ellipse 900px 600px at -10% -5%,rgba(0,212,255,0.06) 0%,transparent 55%),
    radial-gradient(ellipse 700px 500px at 110% 100%,rgba(0,184,156,0.05) 0%,transparent 55%);
  pointer-events:none;}

/* ── Sidebar ── */
.sidebar{position:fixed;left:0;top:0;bottom:0;width:230px;background:var(--bg1);border-right:1px solid var(--border);z-index:300;display:flex;flex-direction:column;}
.sb-logo{display:flex;align-items:center;gap:10px;padding:20px 18px 16px;border-bottom:1px solid var(--border);}
.sb-logo-mark{width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,var(--cyan),var(--teal));display:grid;place-items:center;flex-shrink:0;}
.sb-logo-mark svg{width:18px;height:18px;fill:var(--bg0);}
.sb-logo-text{font-family:'Syne',sans-serif;font-weight:800;font-size:15px;background:linear-gradient(90deg,var(--cyan),var(--teal));-webkit-background-clip:text;-webkit-text-fill-color:transparent;line-height:1.2;}
.sb-logo-sub{font-size:10px;color:var(--muted);letter-spacing:0.8px;text-transform:uppercase;}
.nav-group{padding:14px 10px 4px;}
.nav-group-label{font-size:10px;font-weight:600;letter-spacing:1.2px;text-transform:uppercase;color:var(--muted);padding:0 8px;margin-bottom:6px;}
.nav-btn{display:flex;align-items:center;gap:10px;width:100%;padding:10px;border-radius:var(--r);border:none;background:transparent;color:var(--soft);font-family:'Outfit',sans-serif;font-size:13.5px;font-weight:500;cursor:pointer;transition:all .18s;text-align:left;}
.nav-btn svg{width:17px;height:17px;flex-shrink:0;opacity:.65;transition:opacity .18s;}
.nav-btn:hover{background:rgba(255,255,255,0.05);color:var(--text);}
.nav-btn:hover svg{opacity:1;}
.nav-btn.active{background:rgba(0,212,255,0.10);color:var(--cyan);}
.nav-btn.active svg{opacity:1;stroke:var(--cyan);}
.sb-bottom{margin-top:auto;padding:12px 10px;}
.sb-divider{height:1px;background:var(--border);margin:10px 0;}
.live-badge{display:flex;align-items:center;gap:7px;padding:8px 10px;border-radius:var(--r);background:rgba(34,197,94,0.07);border:1px solid rgba(34,197,94,0.15);font-size:11px;color:#86efac;font-weight:500;margin:0 0 8px;}
.live-dot{width:7px;height:7px;border-radius:999px;background:var(--green);animation:livePulse 2s infinite;}
@keyframes livePulse{0%,100%{opacity:1;transform:scale(1);}50%{opacity:.5;transform:scale(.85);}}

/* ── Main ── */
.main{margin-left:230px;padding:0 28px 60px;position:relative;z-index:1;min-height:100vh;}
.topbar{position:sticky;top:0;z-index:200;display:flex;align-items:center;justify-content:space-between;padding:14px 0;background:rgba(6,12,20,0.85);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);gap:16px;flex-wrap:wrap;}
.topbar-left{display:flex;flex-direction:column;}
.topbar-title{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;letter-spacing:-.3px;}
.topbar-sub{font-size:12px;color:var(--muted);margin-top:1px;}
.topbar-right{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}

/* ── Sections ── */
.section{display:none;padding-top:24px;animation:fadeIn .3s ease both;}
.section.active{display:block;}
@keyframes fadeIn{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}

/* ── Stat cards ── */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:22px;}
.stat-card{background:var(--bg2);border:1px solid var(--border);border-radius:var(--r2);padding:20px;position:relative;overflow:hidden;transition:transform .2s;}
.stat-card::after{content:'';position:absolute;top:-40px;right:-40px;width:110px;height:110px;border-radius:999px;opacity:.06;}
.stat-card:hover{transform:translateY(-2px);}
.sc-icon{width:34px;height:34px;border-radius:9px;display:grid;place-items:center;margin-bottom:14px;}
.sc-icon svg{width:17px;height:17px;}
.sc-val{font-family:'Syne',sans-serif;font-size:28px;font-weight:800;margin-bottom:2px;line-height:1;}
.sc-label{font-size:12px;color:var(--soft);font-weight:500;}
.sc-sub{font-size:11px;color:var(--muted);margin-top:3px;}
.stat-card.s-total::after{background:var(--cyan);}
.stat-card.s-total .sc-icon{background:rgba(0,212,255,0.10);}
.stat-card.s-total .sc-val{color:var(--cyan);}
.stat-card.s-pending::after{background:var(--amber);}
.stat-card.s-pending .sc-icon{background:rgba(245,158,11,0.10);}
.stat-card.s-pending .sc-val{color:var(--amber);}
.stat-card.s-done::after{background:var(--green);}
.stat-card.s-done .sc-icon{background:rgba(34,197,94,0.10);}
.stat-card.s-done .sc-val{color:var(--green);}
.stat-card.s-top::after{background:var(--purple);}
.stat-card.s-top .sc-icon{background:rgba(167,139,250,0.10);}
.stat-card.s-top .sc-val{color:var(--purple);font-size:16px;padding-top:6px;}

/* ── Panel ── */
.panel{background:var(--bg2);border:1px solid var(--border);border-radius:var(--r2);margin-bottom:18px;overflow:hidden;}
.panel-head{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--border);gap:12px;flex-wrap:wrap;}
.panel-head-l{display:flex;align-items:center;gap:10px;}
.panel-title{font-family:'Syne',sans-serif;font-size:15px;font-weight:700;color:var(--text);}
.panel-body{padding:20px;}

/* ── Tab bar ── */
.tab-bar{display:flex;gap:4px;margin-bottom:20px;background:var(--bg3);padding:4px;border-radius:var(--r);width:fit-content;}
.tab-btn{padding:8px 18px;border-radius:8px;border:none;background:transparent;font-family:'Outfit',sans-serif;font-size:13px;font-weight:500;color:var(--muted);cursor:pointer;transition:all .18s;display:flex;align-items:center;gap:7px;}
.tab-btn.active{background:rgba(0,212,255,0.12);color:var(--cyan);}
.tab-btn:hover:not(.active){color:var(--soft);}
.tab-count{display:inline-grid;place-items:center;min-width:18px;height:18px;padding:0 5px;border-radius:999px;background:rgba(255,255,255,0.08);color:var(--soft);font-size:10px;font-weight:700;}
.tab-btn.active .tab-count{background:rgba(0,212,255,0.2);color:var(--cyan);}

/* ── Toolbar ── */
.toolbar{display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:16px;}
.search-wrap{position:relative;flex:1;min-width:200px;max-width:320px;}
.search-wrap svg{position:absolute;left:11px;top:50%;transform:translateY(-50%);width:15px;height:15px;opacity:.4;pointer-events:none;}
.search-input{width:100%;padding:9px 12px 9px 34px;border-radius:var(--r);border:1.5px solid var(--border2);background:var(--bg3);color:var(--text);font-family:'Outfit',sans-serif;font-size:13px;outline:none;transition:all .2s;}
.search-input::placeholder{color:var(--muted);}
.search-input:focus{border-color:var(--cyan);box-shadow:0 0 0 3px rgba(0,212,255,0.08);}
.filter-select{padding:9px 12px;border-radius:var(--r);border:1.5px solid var(--border2);background:var(--bg3);color:var(--text);font-family:'Outfit',sans-serif;font-size:13px;outline:none;cursor:pointer;transition:border-color .2s;}
.filter-select:focus{border-color:var(--cyan);}
.filter-input-date{padding:9px 12px;border-radius:var(--r);border:1.5px solid var(--border2);background:var(--bg3);color:var(--text);font-family:'Outfit',sans-serif;font-size:13px;outline:none;transition:border-color .2s;}
.filter-input-date:focus{border-color:var(--cyan);}

/* ── Buttons ── */
.btn{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:var(--r);border:none;cursor:pointer;font-family:'Outfit',sans-serif;font-size:13px;font-weight:600;transition:all .18s;white-space:nowrap;}
.btn svg{width:14px;height:14px;flex-shrink:0;}
.btn-primary{background:linear-gradient(90deg,var(--teal),var(--cyan));color:var(--bg0);box-shadow:0 6px 20px rgba(0,212,255,0.15);}
.btn-primary:hover{filter:brightness(1.07);transform:translateY(-1px);}
.btn-ghost{background:rgba(255,255,255,0.04);border:1.5px solid var(--border2);color:var(--soft);}
.btn-ghost:hover{background:rgba(255,255,255,0.08);color:var(--text);}
.btn-danger{background:rgba(239,68,68,0.10);border:1.5px solid rgba(239,68,68,0.25);color:#fca5a5;}
.btn-danger:hover{background:rgba(239,68,68,0.18);}
.btn-success{background:rgba(34,197,94,0.12);border:1.5px solid rgba(34,197,94,0.3);color:#86efac;}
.btn-success:hover{background:rgba(34,197,94,0.22);transform:translateY(-1px);}
.btn-sm{padding:6px 11px;font-size:12px;}

/* ── Table ── */
.tbl-wrap{overflow-x:auto;}
table.orders-table{width:100%;border-collapse:collapse;}
.orders-table th{font-size:11px;font-weight:600;letter-spacing:.8px;text-transform:uppercase;color:var(--muted);padding:0 14px 12px;text-align:left;white-space:nowrap;}
.orders-table td{padding:12px 14px;font-size:13px;border-top:1px solid var(--border);vertical-align:middle;}
.orders-table tbody tr{transition:background .15s;}
.orders-table tbody tr:hover td{background:rgba(255,255,255,0.025);}

/* Status badges */
.status-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:999px;font-size:11px;font-weight:600;white-space:nowrap;}
.status-badge .bdot{width:6px;height:6px;border-radius:999px;background:currentColor;}
.s-pending{background:rgba(245,158,11,0.12);color:#fcd34d;}
.s-inprogress{background:rgba(59,130,246,0.12);color:#93c5fd;}
.s-completed{background:rgba(34,197,94,0.12);color:#86efac;}
.s-cancelled{background:rgba(239,68,68,0.12);color:#fca5a5;}

.plate-tag{font-family:'DM Mono',monospace;font-size:12px;padding:3px 8px;border-radius:6px;background:rgba(255,255,255,0.06);border:1px solid var(--border2);color:var(--amber2);letter-spacing:.5px;}
.ref-tag{font-family:'DM Mono',monospace;font-size:11px;color:var(--cyan);opacity:.85;}
.price-tag{font-family:'Syne',sans-serif;font-weight:700;color:var(--cyan);}
.row-actions{display:flex;gap:5px;align-items:center;flex-wrap:wrap;min-width:180px;}
.src-badge{display:inline-flex;align-items:center;gap:4px;font-size:10px;padding:2px 7px;border-radius:999px;font-weight:600;}
.src-kiosk{background:rgba(0,212,255,0.10);color:var(--cyan);}
.src-admin{background:rgba(167,139,250,0.10);color:#c4b5fd;}

/* Time info */
.time-cell{font-size:11px;color:var(--muted);line-height:1.8;}
.time-cell strong{color:var(--soft);}
.dur-badge{display:inline-flex;align-items:center;gap:4px;font-size:11px;padding:2px 8px;border-radius:999px;background:rgba(0,212,255,0.08);color:var(--cyan);font-weight:600;margin-top:2px;}

/* Empty state */
.empty-state{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;padding:56px 24px;text-align:center;}
.empty-state svg{opacity:.3;}
.empty-state h3{font-size:15px;color:var(--soft);}
.empty-state p{font-size:13px;color:var(--muted);}

/* Confirm-complete button */
.btn-done{display:inline-flex;align-items:center;gap:5px;padding:5px 10px;border-radius:8px;border:1.5px solid rgba(34,197,94,0.35);background:rgba(34,197,94,0.10);color:#86efac;font-size:11px;font-weight:700;cursor:pointer;transition:.18s;white-space:nowrap;font-family:'Outfit',sans-serif;}
.btn-done:hover{background:rgba(34,197,94,0.22);transform:translateY(-1px);}

/* ── Modal ── */
.modal-overlay{display:none;position:fixed;inset:0;z-index:600;background:rgba(4,9,18,0.70);backdrop-filter:blur(14px);align-items:center;justify-content:center;}
.modal-overlay.open{display:flex;}
.modal{background:var(--bg2);border:1px solid var(--border2);border-radius:var(--r2);padding:28px;width:min(540px,calc(100% - 32px));box-shadow:var(--shadow);animation:fadeIn .25s ease both;max-height:90vh;overflow-y:auto;}
.modal-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:22px;gap:12px;}
.modal-title{font-family:'Syne',sans-serif;font-size:18px;font-weight:800;}
.modal-title-sub{font-size:12px;color:var(--muted);margin-top:2px;}
.modal-close{width:30px;height:30px;border-radius:8px;border:1.5px solid var(--border2);background:rgba(255,255,255,0.04);color:var(--soft);cursor:pointer;font-size:18px;display:grid;place-items:center;transition:all .15s;flex-shrink:0;}
.modal-close:hover{background:rgba(239,68,68,0.12);border-color:rgba(239,68,68,0.3);color:#fca5a5;}
.readonly-banner{background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.2);border-radius:var(--r);padding:10px 14px;font-size:12px;color:#86efac;margin-bottom:18px;}

/* Form */
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;}
.form-row.single{grid-template-columns:1fr;}
.form-group{display:flex;flex-direction:column;gap:6px;}
.form-label{font-size:11px;font-weight:600;letter-spacing:.7px;text-transform:uppercase;color:var(--muted);}
.form-input,.form-select{padding:11px 13px;border-radius:var(--r);border:1.5px solid var(--border2);background:var(--bg3);color:var(--text);font-family:'Outfit',sans-serif;font-size:14px;outline:none;transition:all .2s;}
.form-input::placeholder{color:var(--muted);}
.form-input:focus,.form-select:focus{border-color:var(--cyan);box-shadow:0 0 0 3px rgba(0,212,255,0.08);}
.form-input.error,.form-select.error{border-color:var(--red)!important;box-shadow:0 0 0 3px rgba(239,68,68,0.10)!important;}
.form-input:disabled,.form-select:disabled{opacity:.5;cursor:not-allowed;}
.form-error{font-size:11px;color:#fca5a5;margin-top:3px;display:none;}
.form-error.visible{display:block;}
.form-hint{font-size:11px;color:var(--muted);margin-top:2px;}
.price-display{padding:11px 13px;border-radius:var(--r);border:1.5px solid rgba(0,212,255,0.2);background:rgba(0,212,255,0.05);font-family:'Syne',sans-serif;font-size:18px;font-weight:800;color:var(--cyan);}
.modal-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:22px;}
.modal-alert{display:none;padding:10px 14px;border-radius:var(--r);font-size:12px;margin-bottom:14px;}
.modal-alert.visible{display:block;}
.modal-alert.warn{background:rgba(245,158,11,0.10);border:1px solid rgba(245,158,11,0.25);color:#fcd34d;}
.modal-alert.error{background:rgba(239,68,68,0.10);border:1px solid rgba(239,68,68,0.25);color:#fca5a5;}

/* Services admin */
.svc-admin-row{display:flex;align-items:center;gap:14px;padding:13px 16px;border-radius:var(--r);background:var(--bg3);border:1px solid var(--border);transition:opacity .2s;margin-bottom:10px;}
.svc-admin-name{flex:1;font-size:14px;font-weight:500;}
.price-pair{display:flex;gap:16px;font-size:12px;color:var(--muted);}
.price-pair strong{color:var(--text);}
.switch{position:relative;display:inline-block;width:44px;height:24px;flex-shrink:0;}
.switch input{display:none;}
.slider{position:absolute;cursor:pointer;inset:0;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.14);transition:.2s;border-radius:999px;}
.slider::before{position:absolute;content:"";height:16px;width:16px;left:4px;top:50%;transform:translateY(-50%);background:rgba(6,12,20,.95);transition:.2s;border-radius:999px;}
.switch input:checked+.slider{background:rgba(0,184,156,0.35);border-color:rgba(0,184,156,0.6);}
.switch input:checked+.slider::before{transform:translate(20px,-50%);}
.price-edit-inputs{display:none;align-items:center;gap:8px;flex-wrap:wrap;margin-top:6px;}
.price-edit-inputs.open{display:flex;}
.price-input{width:90px;padding:5px 8px;border-radius:7px;border:1px solid rgba(34,211,238,0.35);background:var(--bg2);color:var(--text);font-size:13px;outline:none;}
.price-input:focus{border-color:var(--cyan);}
.btn-edit-price{font-size:11px;padding:4px 10px;border-radius:6px;border:1px solid rgba(255,255,255,0.14);background:rgba(255,255,255,0.06);color:var(--soft);cursor:pointer;transition:.15s;}
.btn-edit-price:hover{background:rgba(34,211,238,0.12);color:var(--cyan);}
.btn-save-price{font-size:11px;padding:4px 10px;border-radius:6px;border:none;background:rgba(0,184,156,0.25);color:#5eead4;cursor:pointer;font-weight:600;}
.btn-save-price:hover{background:rgba(0,184,156,0.4);}
.btn-cancel-price{font-size:11px;padding:4px 8px;border-radius:6px;border:none;background:rgba(255,255,255,0.05);color:var(--muted);cursor:pointer;}

/* Slot grid */
.slot-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:10px;}
.slot-tile{border-radius:var(--r);border:1.5px solid;padding:14px 12px;cursor:pointer;transition:all .18s;}
.slot-tile.av{border-color:rgba(34,197,94,0.3);background:rgba(34,197,94,0.05);}
.slot-tile.av:hover{border-color:var(--green);background:rgba(34,197,94,0.10);}
.slot-tile.oc{border-color:rgba(239,68,68,0.2);background:rgba(239,68,68,0.04);cursor:not-allowed;opacity:.55;}
.slot-id{font-family:'Syne',sans-serif;font-size:15px;font-weight:800;margin-bottom:3px;}
.slot-loc{font-size:11px;color:var(--muted);margin-bottom:7px;}
.slot-status-txt{font-size:11px;font-weight:600;}
.slot-tile.av .slot-status-txt{color:#86efac;}
.slot-tile.oc .slot-status-txt{color:#fca5a5;}

/* Confirm modal */
.confirm-body{font-size:14px;color:var(--soft);line-height:1.6;margin-bottom:20px;}

/* Toast */
.toast-container{position:fixed;bottom:24px;right:24px;z-index:1000;display:flex;flex-direction:column;gap:8px;}
.toast{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:var(--r);background:var(--bg2);border:1px solid var(--border2);font-size:13px;box-shadow:var(--shadow);animation:toastIn .3s ease both;min-width:260px;max-width:360px;}
@keyframes toastIn{from{opacity:0;transform:translateX(20px);}to{opacity:1;transform:translateX(0);}}
@keyframes toastOut{from{opacity:1;}to{opacity:0;transform:translateX(20px);}}
.toast.leaving{animation:toastOut .3s ease both;}
.toast-icon{width:20px;height:20px;border-radius:6px;display:grid;place-items:center;flex-shrink:0;}
.toast-icon svg{width:12px;height:12px;}
.toast.success .toast-icon{background:rgba(34,197,94,0.2);}
.toast.success .toast-icon svg{stroke:var(--green);}
.toast.error .toast-icon{background:rgba(239,68,68,0.2);}
.toast.error .toast-icon svg{stroke:var(--red);}
.toast.warn .toast-icon{background:rgba(245,158,11,0.2);}
.toast.warn .toast-icon svg{stroke:var(--amber);}
.toast.info .toast-icon{background:rgba(0,212,255,0.2);}
.toast.info .toast-icon svg{stroke:var(--cyan);}
.toast-msg{flex:1;color:var(--text);}
.count-badge{display:inline-grid;place-items:center;min-width:20px;height:20px;padding:0 6px;border-radius:999px;background:rgba(0,212,255,0.12);color:var(--cyan);font-size:11px;font-weight:700;font-family:'Syne',sans-serif;}

/* Loading spinner */
.spinner{display:inline-block;width:16px;height:16px;border:2px solid rgba(255,255,255,0.1);border-top-color:var(--cyan);border-radius:50%;animation:spin .6s linear infinite;}
@keyframes spin{to{transform:rotate(360deg);}}

/* Responsive */
@media(max-width:960px){.sidebar{display:none;}.main{margin-left:0;}.stats-grid{grid-template-columns:repeat(2,1fr);}.form-row{grid-template-columns:1fr;}}
@media(max-width:560px){.stats-grid{grid-template-columns:1fr 1fr;}.main{padding:0 16px 50px;}}
::-webkit-scrollbar{width:6px;height:6px;}::-webkit-scrollbar-track{background:transparent;}::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.09);border-radius:99px;}
</style>
</head>
<body>

<!-- ═══ SIDEBAR ═══ -->
<aside class="sidebar">
  <div class="sb-logo">
    <div class="sb-logo-mark">
      <svg viewBox="0 0 24 24"><path d="M19 17H5v-2l1-4h12l1 4v2zm-1.5 2a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm-11 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/></svg>
    </div>
    <div>
      <div class="sb-logo-text">Car Wash</div>
      <div class="sb-logo-sub">Admin Panel</div>
    </div>
  </div>
  <div class="nav-group">
    <div class="nav-group-label">Main</div>
    <button class="nav-btn active" id="navDash" onclick="showSection('dashboard',this)">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
      Dashboard
    </button>
    <button class="nav-btn" id="navOrders" onclick="showSection('orders',this)">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
      Orders
    </button>
    <button class="nav-btn" id="navSlots" onclick="showSection('slots',this)">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="3" stroke-linecap="round"/><path stroke-linecap="round" d="M3 9h18M9 21V9"/></svg>
      Slots
    </button>
    <button class="nav-btn" id="navServices" onclick="showSection('services',this)">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
      Services
    </button>
  </div>
  <div class="sb-bottom">
    <div class="live-badge"><span class="live-dot"></span>Live sync active</div>
    <div class="sb-divider"></div>
    <a href="login.html" class="nav-btn" style="text-decoration:none;">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
      Logout
    </a>
  </div>
</aside>

<!-- ═══ MAIN ═══ -->
<main class="main">
  <div class="topbar">
    <div class="topbar-left">
      <div class="topbar-title" id="topbarTitle">Dashboard</div>
      <div class="topbar-sub" id="topbarSub">Overview of all operations</div>
    </div>
    <div class="topbar-right">
      <button class="btn btn-ghost" onclick="refreshAll()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        Refresh
      </button>
      <button class="btn btn-primary" onclick="openAddModal()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
        Add Order
      </button>
    </div>
  </div>

  <!-- ══ DASHBOARD ══ -->
  <section class="section active" id="sec-dashboard">
    <div class="stats-grid">
      <div class="stat-card s-total">
        <div class="sc-icon"><svg fill="none" viewBox="0 0 24 24" stroke="var(--cyan)" stroke-width="1.8"><path stroke-linecap="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg></div>
        <div class="sc-val" id="statTotal">0</div>
        <div class="sc-label">Total Orders</div>
        <div class="sc-sub" id="statTotalSub">–</div>
      </div>
      <div class="stat-card s-pending">
        <div class="sc-icon"><svg fill="none" viewBox="0 0 24 24" stroke="var(--amber)" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg></div>
        <div class="sc-val" id="statPending">0</div>
        <div class="sc-label">Pending / In Progress</div>
        <div class="sc-sub">Awaiting service</div>
      </div>
      <div class="stat-card s-done">
        <div class="sc-icon"><svg fill="none" viewBox="0 0 24 24" stroke="var(--green)" stroke-width="1.8"><path stroke-linecap="round" d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
        <div class="sc-val" id="statDone">0</div>
        <div class="sc-label">Completed Today</div>
        <div class="sc-sub" id="statRevenue">₱0 revenue</div>
      </div>
      <div class="stat-card s-top">
        <div class="sc-icon"><svg fill="none" viewBox="0 0 24 24" stroke="var(--purple)" stroke-width="1.8"><path stroke-linecap="round" d="M5 3l14 9-14 9V3z"/></svg></div>
        <div class="sc-val" id="statTopSvc">—</div>
        <div class="sc-label">Top Service</div>
        <div class="sc-sub" id="statTopSvcCount">0 orders</div>
      </div>
    </div>

    <!-- Recent Activity — Active Orders -->
    <div class="panel">
      <div class="panel-head">
        <div class="panel-head-l">
          <div class="panel-title">Active Orders</div>
          <span class="count-badge" id="dashActiveCount">0</span>
        </div>
        <button class="btn btn-ghost btn-sm" onclick="showSection('orders',document.getElementById('navOrders'));switchOrderTab('active')">View All →</button>
      </div>
      <div id="dashActiveMount"></div>
    </div>

    <!-- Recent Completed -->
    <div class="panel">
      <div class="panel-head">
        <div class="panel-head-l">
          <div class="panel-title">Recently Completed</div>
          <span class="count-badge" id="dashDoneCount">0</span>
        </div>
        <button class="btn btn-ghost btn-sm" onclick="showSection('orders',document.getElementById('navOrders'));switchOrderTab('completed')">View All →</button>
      </div>
      <div id="dashDoneMount"></div>
    </div>

    <!-- Bay Status -->
    <div class="panel">
      <div class="panel-head">
        <div class="panel-title">Bay Status</div>
        <div style="display:flex;gap:12px;font-size:12px;color:var(--soft);">
          <span>🟢 <span id="availCount">0</span> available</span>
          <span>🔴 <span id="occCount">0</span> occupied</span>
        </div>
      </div>
      <div class="panel-body"><div class="slot-grid" id="dashSlotGrid"></div></div>
    </div>
  </section>

  <!-- ══ ORDERS ══ -->
  <section class="section" id="sec-orders">
    <div class="panel">
      <div class="panel-head">
        <div class="panel-head-l">
          <div class="panel-title">Orders</div>
          <span class="count-badge" id="ordersCount">0</span>
        </div>
        <button class="btn btn-primary btn-sm" onclick="openAddModal()">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          Add Order
        </button>
      </div>
      <div class="panel-body">
        <!-- Tab bar -->
        <div class="tab-bar">
          <button class="tab-btn active" id="tabActive" onclick="switchOrderTab('active')">
            Active Orders <span class="tab-count" id="tcActive">0</span>
          </button>
          <button class="tab-btn" id="tabCompleted" onclick="switchOrderTab('completed')">
            Completed / Cancelled <span class="tab-count" id="tcDone">0</span>
          </button>
        </div>
        <!-- Toolbar -->
        <div class="toolbar">
          <div class="search-wrap">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
            <input class="search-input" id="searchInput" placeholder="Customer name or plate…" oninput="applyFilters()">
          </div>
          <select class="filter-select" id="filterVehicle" onchange="applyFilters()">
            <option value="">All Vehicle Types</option>
            <option>Sedan</option><option>SUV</option><option>Hatchback</option><option>Pickup</option><option>Van</option>
            <option>Scooter</option><option>Underbone</option><option>Big Bike</option>
          </select>
          <select class="filter-select" id="filterService" onchange="applyFilters()">
            <option value="">All Services</option>
            <option>Basic Wash</option><option>Premium Wash</option><option>Interior Cleaning</option>
            <option>Wax &amp; Polish</option><option>Engine Cleaning</option><option>Valet Service</option>
            <option>Overnight Parking</option><option>Tire Cleaning</option>
          </select>
          <input type="date" class="filter-input-date" id="filterDate" onchange="applyFilters()" title="Filter by date">
          <button class="btn btn-ghost btn-sm" onclick="clearFilters()">Clear</button>
        </div>
        <div id="ordersTableWrap"></div>
      </div>
    </div>
  </section>

  <!-- ══ SLOTS ══ -->
  <section class="section" id="sec-slots">
    <div class="panel">
      <div class="panel-head">
        <div class="panel-title">Bay / Slot Management</div>
        <div style="display:flex;gap:8px;">
          <button class="btn btn-ghost btn-sm active" onclick="renderSlotsSection('ALL',this)">All</button>
          <button class="btn btn-ghost btn-sm" onclick="renderSlotsSection('available',this)">Available</button>
          <button class="btn btn-ghost btn-sm" onclick="renderSlotsSection('occupied',this)">Occupied</button>
        </div>
      </div>
      <div class="panel-body"><div class="slot-grid" id="adminSlotGrid"></div></div>
    </div>
  </section>

  <!-- ══ SERVICES ══ -->
  <section class="section" id="sec-services">
    <div class="panel">
      <div class="panel-head">
        <div class="panel-title">Service Configuration</div>
        <div style="font-size:12px;color:var(--muted);">Toggle availability · Edit Car &amp; Moto prices</div>
      </div>
      <div class="panel-body">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;" id="svcAdminMount"></div>
      </div>
    </div>
  </section>
</main>

<!-- ═══ ADD / EDIT ORDER MODAL ═══ -->
<div class="modal-overlay" id="orderModal">
  <div class="modal">
    <div class="modal-header">
      <div>
        <div class="modal-title" id="modalTitle">Add New Order</div>
        <div class="modal-title-sub" id="modalSub">Fill in the details below</div>
      </div>
      <button class="modal-close" onclick="closeModal('orderModal')">✕</button>
    </div>
    <div class="readonly-banner" id="readonlyBanner" style="display:none;">
      ✓ This order is completed and cannot be modified.
    </div>
    <div class="modal-alert" id="modalAlert"></div>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Customer Name *</label>
        <input class="form-input" id="fCustName" placeholder="Full name" oninput="clearErr('fCustName','errCustName')">
        <div class="form-error" id="errCustName"></div>
      </div>
      <div class="form-group">
        <label class="form-label">Plate Number *</label>
        <input class="form-input" id="fPlate" placeholder="e.g. ABC-1234" style="font-family:'DM Mono',monospace;" oninput="clearErr('fPlate','errPlate')">
        <div class="form-error" id="errPlate"></div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Vehicle Type *</label>
        <select class="form-select" id="fVehicle" onchange="onVehicleChange();clearErr('fVehicle','errVehicle')">
          <option value="">Select type…</option>
          <optgroup label="Car"><option>Sedan</option><option>SUV</option><option>Hatchback</option><option>Pickup</option><option>Van</option></optgroup>
          <optgroup label="Motorcycle"><option>Scooter</option><option>Underbone</option><option>Big Bike</option></optgroup>
        </select>
        <div class="form-error" id="errVehicle"></div>
      </div>
      <div class="form-group">
        <label class="form-label">Slot / Bay *</label>
        <select class="form-select" id="fSlot" onchange="clearErr('fSlot','errSlot')">
          <option value="">Select slot…</option>
        </select>
        <div class="form-error" id="errSlot"></div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Service *</label>
        <select class="form-select" id="fService" onchange="onServiceChange();clearErr('fService','errService')">
          <option value="">Select service…</option>
        </select>
        <div class="form-error" id="errService"></div>
      </div>
      <div class="form-group">
        <label class="form-label">Status *</label>
        <select class="form-select" id="fStatus" onchange="clearErr('fStatus','errStatus')">
          <option value="Pending">Pending</option>
          <option value="In Progress">In Progress</option>
          <option value="Completed">Completed</option>
          <option value="Cancelled">Cancelled</option>
        </select>
        <div class="form-error" id="errStatus"></div>
      </div>
    </div>
    <div class="form-row single">
      <div class="form-group">
        <label class="form-label">Total Price (auto-calculated)</label>
        <div class="price-display" id="priceDisplay">₱0</div>
        <div class="form-hint">Price updates automatically based on service and vehicle type.</div>
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn btn-ghost" onclick="closeModal('orderModal')">Cancel</button>
      <button class="btn btn-primary" id="modalSaveBtn" onclick="saveOrder()">Save Order</button>
    </div>
  </div>
</div>

<!-- ═══ CONFIRM MODAL ═══ -->
<div class="modal-overlay" id="confirmModal">
  <div class="modal" style="max-width:400px;">
    <div class="modal-header">
      <div class="modal-title" id="confirmTitle" style="color:var(--red);">Confirm Action</div>
      <button class="modal-close" onclick="closeModal('confirmModal')">✕</button>
    </div>
    <div class="confirm-body" id="confirmBody"></div>
    <div class="modal-actions">
      <button class="btn btn-ghost" onclick="closeModal('confirmModal')">Cancel</button>
      <button class="btn btn-danger" id="confirmOkBtn">Confirm</button>
    </div>
  </div>
</div>

<div class="toast-container" id="toastContainer"></div>

<script>
/* ════════════════════════════════════════════
   API
════════════════════════════════════════════ */
const API = 'api.php';
async function apiFetch(action, data=null){
  const opts = data
    ? {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(data)}
    : {method:'GET'};
  const res = await fetch(`${API}?action=${action}`, opts);
  if(!res.ok) throw new Error(await res.text());
  return res.json();
}

/* ── State ── */
let slots    = [];
let services = [];
let orders   = [];
let editingOrderId = null;
let currentOrderTab = 'active'; // 'active' | 'completed'

const MOTO_INCOMPATIBLE = ['Premium Wash'];
function isMoto(v){ return ['Scooter','Underbone','Big Bike'].includes(v); }
function isCar(v){  return ['Sedan','SUV','Hatchback','Pickup','Van'].includes(v); }

function getServicePrice(svcName, vehicleType){
  const svc = services.find(s=>s.name===svcName);
  if(!svc) return 0;
  return isMoto(vehicleType) ? Number(svc.motoPrice) : Number(svc.carPrice);
}

function getOccupiedSlotIds(){
  return new Set(
    orders.filter(o=>o.status==='Pending'||o.status==='In Progress').map(o=>o.slotId)
  );
}

function isSlotAvailableForEdit(slotId, excludeOrderId){
  const slot = slots.find(s=>s.slotId===slotId);
  if(!slot || !Number(slot.isAvailable)) return false;
  if(excludeOrderId){
    const editO = orders.find(o=>o.id==excludeOrderId);
    if(editO && editO.slotId===slotId) return true;
  }
  return !getOccupiedSlotIds().has(slotId);
}

/* ════════════════════════════════════════════
   LOAD ALL
════════════════════════════════════════════ */
async function loadAll(){
  const [s, sv, o] = await Promise.all([
    apiFetch('get_slots'),
    apiFetch('get_services'),
    apiFetch('get_orders')
  ]);
  slots    = s.map(x=>({...x, isAvailable:!!Number(x.isAvailable)}));
  services = sv.map(x=>({...x, isAvailable:!!Number(x.isAvailable)}));
  orders   = o;
  renderAll();
}

function renderAll(){
  renderDashboard();
  renderOrdersSection();
  renderSlotsSection('ALL', null);
  renderServicesAdmin();
}

/* ════════════════════════════════════════════
   NAVIGATION
════════════════════════════════════════════ */
const SECTIONS = {
  dashboard:{ el:'sec-dashboard', title:'Dashboard',       sub:'Overview of all operations' },
  orders:   { el:'sec-orders',    title:'Orders',          sub:'Manage all car wash orders' },
  slots:    { el:'sec-slots',     title:'Slots / Bays',    sub:'Manage washing bay availability' },
  services: { el:'sec-services',  title:'Services',        sub:'Configure service availability and pricing' },
};
function showSection(key, btn){
  Object.values(SECTIONS).forEach(s=>document.getElementById(s.el).classList.remove('active'));
  document.querySelectorAll('.nav-btn').forEach(b=>b.classList.remove('active'));
  const sec = SECTIONS[key];
  document.getElementById(sec.el).classList.add('active');
  if(btn) btn.classList.add('active');
  document.getElementById('topbarTitle').textContent = sec.title;
  document.getElementById('topbarSub').textContent   = sec.sub;
}

/* ════════════════════════════════════════════
   DASHBOARD
════════════════════════════════════════════ */
function renderDashboard(){
  const active    = orders.filter(o=>o.status==='Pending'||o.status==='In Progress');
  const completed = orders.filter(o=>o.status==='Completed');
  const revenue   = completed.reduce((s,o)=>s+(Number(o.total)||0),0);
  const pending   = active.length;

  document.getElementById('statTotal').textContent      = orders.length;
  document.getElementById('statTotalSub').textContent   = orders.filter(o=>o.source==='kiosk').length + ' from kiosk';
  document.getElementById('statPending').textContent    = pending;
  document.getElementById('statDone').textContent       = completed.length;
  document.getElementById('statRevenue').textContent    = '₱' + revenue.toLocaleString() + ' revenue';

  const svcCount = {};
  orders.forEach(o=>{
    if(!o.service) return;
    o.service.split(',').forEach(s=>{ const t=s.trim(); svcCount[t]=(svcCount[t]||0)+1; });
  });
  const topSvc = Object.entries(svcCount).sort((a,b)=>b[1]-a[1])[0];
  document.getElementById('statTopSvc').textContent      = topSvc ? topSvc[0].split(' ')[0] : '—';
  document.getElementById('statTopSvcCount').textContent = topSvc ? topSvc[1]+' orders' : 'No data';

  // Active orders panel
  document.getElementById('dashActiveCount').textContent = active.length;
  const am = document.getElementById('dashActiveMount');
  if(!active.length){
    am.innerHTML = emptyState('No active orders right now.','Orders from kiosk or manually added will appear here.');
  } else {
    am.innerHTML = '<div class="tbl-wrap">' + buildOrdersTable(active.slice(0,5), true) + '</div>';
  }

  // Completed orders panel
  document.getElementById('dashDoneCount').textContent = completed.length;
  const dm = document.getElementById('dashDoneMount');
  if(!completed.length){
    dm.innerHTML = emptyState('No completed orders yet.','Completed orders will appear here.');
  } else {
    dm.innerHTML = '<div class="tbl-wrap">' + buildOrdersTable(completed.slice(0,5), true) + '</div>';
  }

  // Bay status
  renderDashboardSlots();
}

function renderDashboardSlots(){
  const occupied = getOccupiedSlotIds();
  let avail=0, occ=0;
  const grid = document.getElementById('dashSlotGrid');
  grid.innerHTML = '';
  slots.forEach(s=>{
    const eff = s.isAvailable && !occupied.has(s.slotId);
    if(eff) avail++; else occ++;
    const div = document.createElement('div');
    div.className = 'slot-tile ' + (eff?'av':'oc');
    div.innerHTML = '<div class="slot-id">'+s.slotId+'</div><div class="slot-loc">'+s.location+'</div><div class="slot-status-txt">'+(eff?'Available':'Occupied')+'</div>';
    grid.appendChild(div);
  });
  document.getElementById('availCount').textContent = avail;
  document.getElementById('occCount').textContent   = occ;
}

function emptyState(h, p){
  return '<div class="empty-state"><svg width="44" height="44" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.3"><path stroke-linecap="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg><h3>'+h+'</h3><p>'+p+'</p></div>';
}

/* ════════════════════════════════════════════
   ORDERS SECTION — tab-based
════════════════════════════════════════════ */
function switchOrderTab(tab){
  currentOrderTab = tab;
  document.getElementById('tabActive').classList.toggle('active', tab==='active');
  document.getElementById('tabCompleted').classList.toggle('active', tab==='completed');
  applyFilters();
}

function renderOrdersSection(){
  const active    = orders.filter(o=>o.status==='Pending'||o.status==='In Progress');
  const completed = orders.filter(o=>o.status==='Completed'||o.status==='Cancelled');
  document.getElementById('tcActive').textContent   = active.length;
  document.getElementById('tcDone').textContent     = completed.length;
  applyFilters();
}

function getFilteredOrders(){
  const q   = (document.getElementById('searchInput')?.value||'').trim().toLowerCase();
  const fv  = (document.getElementById('filterVehicle')?.value||'');
  const fs  = (document.getElementById('filterService')?.value||'');
  const fd  = (document.getElementById('filterDate')?.value||'');

  const isActive = currentOrderTab === 'active';
  let list = isActive
    ? orders.filter(o=>o.status==='Pending'||o.status==='In Progress')
    : orders.filter(o=>o.status==='Completed'||o.status==='Cancelled');

  return list.filter(o=>{
    if(q  && !o.customerName.toLowerCase().includes(q) && !o.plateNumber.toLowerCase().includes(q)) return false;
    if(fv && o.vehicleType !== fv) return false;
    if(fs && !o.service.includes(fs)) return false;
    if(fd && !(o.timestamp||'').startsWith(fd)) return false;
    return true;
  });
}

function applyFilters(){
  const list = getFilteredOrders();
  document.getElementById('ordersCount').textContent = list.length;
  const wrap = document.getElementById('ordersTableWrap');
  if(!list.length){
    wrap.innerHTML = '<div class="empty-state"><svg width="44" height="44" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.3"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg><h3>No orders found.</h3><p>Try adjusting your search or filter criteria.</p></div>';
    return;
  }
  wrap.innerHTML = '<div class="tbl-wrap">' + buildOrdersTable(list, false) + '</div>';
}

function clearFilters(){
  document.getElementById('searchInput').value='';
  document.getElementById('filterVehicle').value='';
  document.getElementById('filterService').value='';
  document.getElementById('filterDate').value='';
  applyFilters();
}

/* ════════════════════════════════════════════
   BUILD ORDERS TABLE
════════════════════════════════════════════ */
function buildOrdersTable(list, mini){
  const showActions = !mini;
  let h = '<table class="orders-table"><thead><tr>';
  h += '<th>Ref</th><th>Customer</th><th>Plate</th><th>Vehicle</th><th>Slot</th><th>Service</th><th>Total</th><th>Status</th>';
  if(!mini){
    h += '<th>Time / Duration</th><th>Source</th><th>Actions</th>';
  }
  h += '</tr></thead><tbody>';

  list.forEach(o=>{
    const sc = statusCls(o.status);

    // Time cell
    let timeCell = '<span style="color:var(--muted)">—</span>';
    if(!mini){
      const parts = [];
      if(o.startTime)   parts.push('<strong>Start:</strong> '+fmtTime(o.startTime));
      if(o.endTime)     parts.push('<strong>End:</strong> '+fmtTime(o.endTime));
      if(o.duration)    parts.push('<span class="dur-badge">⏱ '+esc(o.duration)+'</span>');
      if(parts.length)  timeCell = '<div class="time-cell">'+parts.join('<br>')+'</div>';
    }

    // Action buttons
    let actions = '';
    if(showActions){
      if(o.status === 'Pending'){
        actions += '<button class="btn-done" onclick="quickComplete('+o.id+',\'In Progress\')">▶ Start</button>';
        actions += '<button class="btn btn-ghost btn-sm" onclick="openEditModal('+o.id+')">Edit</button>';
        actions += '<button class="btn btn-danger btn-sm" onclick="confirmDeleteOrder('+o.id+')">Delete</button>';
      } else if(o.status === 'In Progress'){
        actions += '<button class="btn-done" onclick="confirmComplete('+o.id+')">✓ Done</button>';
        actions += '<button class="btn btn-ghost btn-sm" onclick="openEditModal('+o.id+')">Edit</button>';
        actions += '<button class="btn btn-danger btn-sm" onclick="confirmDeleteOrder('+o.id+')">Delete</button>';
      } else {
        // Completed / Cancelled — view only
        actions += '<button class="btn btn-ghost btn-sm" onclick="openEditModal('+o.id+')">View</button>';
        actions += '<button class="btn btn-danger btn-sm" onclick="confirmDeleteOrder('+o.id+')">Delete</button>';
      }
    }

    h += '<tr>';
    h += '<td><span class="ref-tag">'+esc(o.refId||'–')+'</span></td>';
    h += '<td><strong>'+esc(o.customerName)+'</strong><div style="font-size:11px;color:var(--muted);">'+(o.timestamp||'')+'</div></td>';
    h += '<td><span class="plate-tag">'+esc(o.plateNumber)+'</span></td>';
    h += '<td>'+esc(o.vehicleType)+'</td>';
    h += '<td><strong>'+esc(o.slotId)+'</strong></td>';
    h += '<td style="max-width:160px;font-size:12px;color:var(--soft);">'+esc(o.service)+'</td>';
    h += '<td><span class="price-tag">₱'+(Number(o.total)||0).toLocaleString()+'</span></td>';
    h += '<td><span class="status-badge '+sc+'"><span class="bdot"></span>'+o.status+'</span></td>';
    if(!mini){
      h += '<td>'+timeCell+'</td>';
      h += '<td><span class="src-badge '+(o.source==='kiosk'?'src-kiosk':'src-admin')+'">'+(o.source==='kiosk'?'Kiosk':'Admin')+'</span></td>';
      h += '<td><div class="row-actions">'+actions+'</div></td>';
    }
    h += '</tr>';
  });
  h += '</tbody></table>';
  return h;
}

function statusCls(s){
  if(s==='Pending')     return 's-pending';
  if(s==='In Progress') return 's-inprogress';
  if(s==='Completed')   return 's-completed';
  if(s==='Cancelled')   return 's-cancelled';
  return '';
}

function fmtTime(ts){
  if(!ts) return '—';
  try{ return new Date(ts).toLocaleTimeString('en-PH',{hour:'2-digit',minute:'2-digit'}); }
  catch{ return ts; }
}

/* ════════════════════════════════════════════
   QUICK STATUS SHORTCUTS
════════════════════════════════════════════ */
async function quickComplete(id, newStatus){
  const o = orders.find(x=>x.id==id);
  if(!o) return;

  // Slot conflict check for In Progress
  if(newStatus === 'In Progress'){
    const conflict = orders.find(x=>x.id!=id && x.slotId===o.slotId && x.status==='In Progress');
    if(conflict){
      toast('error', o.slotId+' is currently occupied by another vehicle in progress.');
      return;
    }
  }

  try{
    await apiFetch('update_order_status',{ id, status:newStatus });
    toast('success', 'Order moved to '+newStatus+'.');
    await refreshAll();
  } catch(e){ toast('error','Failed: '+e.message); }
}

function confirmComplete(id){
  const o = orders.find(x=>x.id==id);
  if(!o) return;
  document.getElementById('confirmTitle').textContent = 'Mark as Completed?';
  document.getElementById('confirmTitle').style.color = 'var(--green)';
  document.getElementById('confirmBody').innerHTML =
    'Mark order <strong>'+esc(o.refId)+'</strong> for <strong>'+esc(o.customerName)+'</strong> as <strong style="color:#86efac;">Completed</strong>?<br><br>This will record the completion time and free the slot.';
  document.getElementById('confirmOkBtn').className = 'btn btn-success';
  document.getElementById('confirmOkBtn').textContent = '✓ Confirm Complete';
  document.getElementById('confirmOkBtn').onclick = ()=>doComplete(id);
  document.getElementById('confirmModal').classList.add('open');
}

async function doComplete(id){
  closeModal('confirmModal');
  try{
    await apiFetch('update_order_status',{ id, status:'Completed' });
    toast('success','Order marked as Completed. Slot released.');
    await refreshAll();
  } catch(e){ toast('error','Failed: '+e.message); }
}

/* ════════════════════════════════════════════
   ADD / EDIT MODAL
════════════════════════════════════════════ */
function openAddModal(){
  // Max capacity check
  const availSlots   = slots.filter(s=>s.isAvailable).length;
  const activeOrders = orders.filter(o=>o.status==='Pending'||o.status==='In Progress').length;
  if(availSlots > 0 && activeOrders >= availSlots){
    toast('warn','All wash slots are currently occupied.');
    showModalAlert('warn','All wash slots are currently occupied. Please wait until a slot becomes available before adding a new order.');
  }

  editingOrderId = null;
  document.getElementById('modalTitle').textContent   = 'Add New Order';
  document.getElementById('modalSub').textContent     = 'Manually create an order';
  document.getElementById('modalSaveBtn').textContent = 'Save Order';
  document.getElementById('modalSaveBtn').style.display = '';
  document.getElementById('readonlyBanner').style.display = 'none';
  resetForm(false);
  populateSlotDropdown(null);
  populateServiceDropdown('');
  document.getElementById('orderModal').classList.add('open');
}

function openEditModal(id){
  const o = orders.find(x=>x.id==id);
  if(!o) return;

  const isReadOnly = (o.status==='Completed' || o.status==='Cancelled');
  editingOrderId = id;

  document.getElementById('modalTitle').textContent   = isReadOnly ? 'View Order' : 'Edit Order';
  document.getElementById('modalSub').textContent     = 'Ref: '+o.refId;
  document.getElementById('modalSaveBtn').textContent = 'Update Order';
  document.getElementById('modalSaveBtn').style.display = isReadOnly ? 'none' : '';
  document.getElementById('readonlyBanner').style.display = isReadOnly ? '' : 'none';
  document.getElementById('modalAlert').className = 'modal-alert';
  resetForm(isReadOnly);

  document.getElementById('fCustName').value = o.customerName;
  document.getElementById('fPlate').value    = o.plateNumber;
  document.getElementById('fVehicle').value  = o.vehicleType;
  document.getElementById('fStatus').value   = o.status;

  populateSlotDropdown(id);
  document.getElementById('fSlot').value = o.slotId;
  populateServiceDropdown(o.vehicleType);
  const firstSvc = o.service.split(',')[0].trim();
  document.getElementById('fService').value = firstSvc;
  updatePriceDisplay();

  document.getElementById('orderModal').classList.add('open');
}

function closeModal(id){ document.getElementById(id).classList.remove('open'); }

function resetForm(readonly){
  ['fCustName','fPlate','fVehicle','fSlot','fService','fStatus'].forEach(id=>{
    const el = document.getElementById(id);
    if(el){ el.value=''; el.classList.remove('error'); el.disabled=readonly; }
  });
  document.getElementById('fStatus').value = 'Pending';
  document.querySelectorAll('.form-error').forEach(e=>{ e.textContent=''; e.classList.remove('visible'); });
  document.getElementById('priceDisplay').textContent = '₱0';
  document.getElementById('modalAlert').className = 'modal-alert';
}

function showModalAlert(type, msg){
  const el = document.getElementById('modalAlert');
  el.textContent = msg;
  el.className = 'modal-alert '+type+' visible';
}

function populateSlotDropdown(excludeOrderId){
  const sel = document.getElementById('fSlot');
  sel.innerHTML = '<option value="">Select slot…</option>';
  slots.forEach(s=>{
    if(isSlotAvailableForEdit(s.slotId, excludeOrderId)){
      sel.innerHTML += '<option value="'+s.slotId+'">'+s.slotId+' — '+s.location+'</option>';
    }
  });
  if(sel.options.length === 1){
    sel.innerHTML += '<option value="" disabled>No available slots</option>';
  }
}

function populateServiceDropdown(vehicleType){
  const sel = document.getElementById('fService');
  const isMotoV = isMoto(vehicleType);
  sel.innerHTML = '<option value="">Select service…</option>';
  services.filter(s=>s.isAvailable).forEach(s=>{
    if(isMotoV && MOTO_INCOMPATIBLE.includes(s.name)) return;
    sel.innerHTML += '<option value="'+s.name+'">'+s.name+'</option>';
  });
}

function onVehicleChange(){
  const v = document.getElementById('fVehicle').value;
  populateServiceDropdown(v);
  document.getElementById('fService').value = '';
  document.getElementById('priceDisplay').textContent = '₱0';
}

function onServiceChange(){ updatePriceDisplay(); }

function updatePriceDisplay(){
  const v = document.getElementById('fVehicle').value;
  const s = document.getElementById('fService').value;
  if(!v||!s){ document.getElementById('priceDisplay').textContent='₱0'; return; }
  document.getElementById('priceDisplay').textContent = '₱'+getServicePrice(s,v).toLocaleString();
}

async function saveOrder(){
  const name    = document.getElementById('fCustName').value.trim();
  const plate   = document.getElementById('fPlate').value.trim();
  const vehicle = document.getElementById('fVehicle').value;
  const slotId  = document.getElementById('fSlot').value;
  const service = document.getElementById('fService').value;
  const status  = document.getElementById('fStatus').value;

  let valid = true;
  if(!name)   { setErr('fCustName','errCustName','Customer name is required.'); valid=false; }
  if(!plate)  { setErr('fPlate','errPlate','Plate number is required.'); valid=false; }
  if(!vehicle){ setErr('fVehicle','errVehicle','Vehicle type is required.'); valid=false; }
  if(!service){ setErr('fService','errService','Please select a service.'); valid=false; }
  if(!slotId) { setErr('fSlot','errSlot','Please select an available slot.'); valid=false; }

  if(valid && slotId){
    const occupied = getOccupiedSlotIds();
    const curSlot  = editingOrderId ? orders.find(o=>o.id==editingOrderId)?.slotId : null;
    if(occupied.has(slotId) && slotId !== curSlot){
      setErr('fSlot','errSlot','This slot is already occupied by another active order.'); valid=false;
    }
  }

  // Slot conflict: In Progress → same slot
  if(valid && status==='In Progress' && slotId){
    const curId    = editingOrderId;
    const conflict = orders.find(o=>o.id!=curId && o.slotId===slotId && o.status==='In Progress');
    if(conflict){
      setErr('fSlot','errSlot',slotId+' is currently occupied by another vehicle in progress. Please select another slot or wait until the slot becomes available.');
      valid=false;
    }
  }

  // Moto incompatibility
  if(valid && service && vehicle && isMoto(vehicle) && MOTO_INCOMPATIBLE.includes(service)){
    setErr('fService','errService','This service is not available for motorcycles.'); valid=false;
  }

  // Status workflow: Pending → Completed requires In Progress first
  if(valid && editingOrderId && status==='Completed'){
    const prev = orders.find(o=>o.id==editingOrderId);
    if(prev && prev.status==='Pending'){
      setErr('fStatus','errStatus','Order must go through "In Progress" before Completed.'); valid=false;
    }
  }

  if(!valid) return;

  const price   = getServicePrice(service, vehicle);
  const payload = { customerName:name, plateNumber:plate, vehicleType:vehicle, slotId, service, total:price, status };

  try{
    if(editingOrderId){
      await apiFetch('update_order', {...payload, id:editingOrderId});
      toast('success','Order updated.');
    } else {
      await apiFetch('add_order', {...payload, source:'admin'});
      toast('success','Order added.');
    }
    closeModal('orderModal');
    await refreshAll();
  } catch(e){ toast('error','Save failed: '+e.message); }
}

/* ════════════════════════════════════════════
   DELETE
════════════════════════════════════════════ */
function confirmDeleteOrder(id){
  const o = orders.find(x=>x.id==id);
  if(!o) return;
  document.getElementById('confirmTitle').textContent = 'Confirm Delete';
  document.getElementById('confirmTitle').style.color = 'var(--red)';
  document.getElementById('confirmBody').innerHTML =
    'Delete order <strong>'+esc(o.refId)+'</strong> for <strong>'+esc(o.customerName)+'</strong>? This cannot be undone.';
  document.getElementById('confirmOkBtn').className = 'btn btn-danger';
  document.getElementById('confirmOkBtn').textContent = 'Delete';
  document.getElementById('confirmOkBtn').onclick = ()=>deleteOrder(id);
  document.getElementById('confirmModal').classList.add('open');
}

async function deleteOrder(id){
  try{
    await apiFetch('delete_order',{id});
    closeModal('confirmModal');
    toast('success','Order deleted.');
    await refreshAll();
  } catch(e){ toast('error','Delete failed: '+e.message); }
}

/* ════════════════════════════════════════════
   SLOTS SECTION
════════════════════════════════════════════ */
function renderSlotsSection(filter, btn){
  if(btn){
    document.querySelectorAll('#sec-slots .btn-sm').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
  }
  const occupied = getOccupiedSlotIds();
  let list = slots.map(s=>({...s, _eff:s.isAvailable && !occupied.has(s.slotId)}));
  if(filter==='available') list = list.filter(s=>s._eff);
  if(filter==='occupied')  list = list.filter(s=>!s._eff);

  const grid = document.getElementById('adminSlotGrid');
  grid.innerHTML = '';
  list.forEach(s=>{
    const div = document.createElement('div');
    div.className = 'slot-tile '+(s._eff?'av':'oc');
    div.innerHTML =
      '<div class="slot-id">'+s.slotId+'</div>'+
      '<div class="slot-loc">'+s.location+'</div>'+
      '<div class="slot-status-txt" style="margin-bottom:10px;">'+(s._eff?'Available':'Occupied')+'</div>'+
      '<select class="filter-select" style="width:100%;font-size:12px;padding:6px 8px;" data-slotid="'+s.slotId+'">'+
        '<option value="available"'+(s.isAvailable?' selected':'')+'>✓ Available</option>'+
        '<option value="occupied"'+(!s.isAvailable?' selected':'')+'>✗ Occupied</option>'+
      '</select>';
    div.querySelector('select').addEventListener('change', async e=>{
      const slotId = e.target.getAttribute('data-slotid');
      const avail  = e.target.value==='available' ? 1 : 0;
      try{
        await apiFetch('toggle_slot',{slotId, isAvailable:avail});
        const sl = slots.find(x=>x.slotId===slotId);
        if(sl) sl.isAvailable = !!avail;
        toast('success', slotId+' marked '+(avail?'Available':'Occupied'));
        renderSlotsSection(filter, null);
        renderDashboardSlots();
      } catch(err){ toast('error','Failed: '+err.message); }
    });
    grid.appendChild(div);
  });
}

/* ════════════════════════════════════════════
   SERVICES ADMIN
════════════════════════════════════════════ */
function renderServicesAdmin(){
  const m = document.getElementById('svcAdminMount');
  m.innerHTML = '';
  services.forEach(s=>{
    const col = document.createElement('div');
    col.innerHTML =
      '<div class="svc-admin-row" id="svcrow_'+s.id+'" style="opacity:'+(s.isAvailable?1:.45)+'">'+
        '<div class="svc-admin-name">'+esc(s.name)+'</div>'+
        '<div style="flex:1;">'+
          '<div id="priceLbls_'+s.id+'" style="display:flex;align-items:center;gap:10px;">'+
            '<div class="price-pair">'+
              '<span>Car: <strong id="carLbl_'+s.id+'">₱'+s.carPrice+'</strong></span>'+
              '<span>Moto: <strong id="motoLbl_'+s.id+'">₱'+s.motoPrice+'</strong></span>'+
            '</div>'+
            '<button class="btn-edit-price" onclick="openPriceEdit('+s.id+')">✏ Edit</button>'+
          '</div>'+
          '<div class="price-edit-inputs" id="priceInputs_'+s.id+'">'+
            '<label style="font-size:11px;color:var(--muted);">Car ₱</label>'+
            '<input class="price-input" id="carIn_'+s.id+'" type="number" min="0" value="'+s.carPrice+'">'+
            '<label style="font-size:11px;color:var(--muted);">Moto ₱</label>'+
            '<input class="price-input" id="motoIn_'+s.id+'" type="number" min="0" value="'+s.motoPrice+'">'+
            '<button class="btn-save-price" onclick="savePrice('+s.id+')">Save</button>'+
            '<button class="btn-cancel-price" onclick="closePriceEdit('+s.id+')">Cancel</button>'+
          '</div>'+
        '</div>'+
        '<label class="switch">'+
          '<input type="checkbox"'+(s.isAvailable?' checked':'')+' onchange="toggleService('+s.id+',this)">'+
          '<span class="slider"></span>'+
        '</label>'+
      '</div>';
    m.appendChild(col);
  });
}

function openPriceEdit(id){
  document.getElementById('priceLbls_'+id).style.display = 'none';
  document.getElementById('priceInputs_'+id).classList.add('open');
  document.getElementById('carIn_'+id).focus();
}
function closePriceEdit(id){
  document.getElementById('priceLbls_'+id).style.display = '';
  document.getElementById('priceInputs_'+id).classList.remove('open');
}

async function savePrice(id){
  const car  = parseFloat(document.getElementById('carIn_'+id).value);
  const moto = parseFloat(document.getElementById('motoIn_'+id).value);
  if(isNaN(car)||car<0||isNaN(moto)||moto<0){ toast('warn','Invalid prices.'); return; }
  try{
    await apiFetch('update_price',{id, carPrice:car, motoPrice:moto});
    const s = services.find(x=>x.id==id);
    if(s){ s.carPrice=car; s.motoPrice=moto; }
    document.getElementById('carLbl_'+id).textContent  = '₱'+car;
    document.getElementById('motoLbl_'+id).textContent = '₱'+moto;
    closePriceEdit(id);
    toast('success','Prices updated.');
  } catch(e){ toast('error','Failed: '+e.message); }
}

async function toggleService(id, cb){
  const avail = cb.checked?1:0;
  try{
    await apiFetch('toggle_service',{id, isAvailable:avail});
    const s = services.find(x=>x.id==id);
    if(s) s.isAvailable = !!avail;
    const row = document.getElementById('svcrow_'+id);
    if(row) row.style.opacity = cb.checked?'1':'0.45';
  } catch(e){ toast('error','Failed.'); cb.checked=!cb.checked; }
}

/* ════════════════════════════════════════════
   HELPERS
════════════════════════════════════════════ */
function setErr(inputId, errId, msg){
  document.getElementById(inputId).classList.add('error');
  const el = document.getElementById(errId);
  el.textContent=msg; el.classList.add('visible');
}
function clearErr(inputId, errId){
  document.getElementById(inputId).classList.remove('error');
  const el = document.getElementById(errId);
  if(el){ el.textContent=''; el.classList.remove('visible'); }
}
function esc(s){ return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

function toast(type, msg, dur=3500){
  const icons={
    success:'<polyline points="20 6 9 17 4 12"/>',
    error:'<path d="M18 6L6 18M6 6l12 12"/>',
    warn:'<path d="M12 9v4M12 17h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke-linecap="round"/>',
    info:'<circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01" stroke-linecap="round"/>'
  };
  const t = document.createElement('div');
  t.className = 'toast '+type;
  t.innerHTML = '<div class="toast-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">'+(icons[type]||icons.info)+'</svg></div><span class="toast-msg">'+msg+'</span>';
  document.getElementById('toastContainer').appendChild(t);
  setTimeout(()=>{ t.classList.add('leaving'); setTimeout(()=>t.remove(),300); }, dur);
}

async function refreshAll(){
  const [s, sv, o] = await Promise.all([
    apiFetch('get_slots'),
    apiFetch('get_services'),
    apiFetch('get_orders')
  ]);
  slots    = s.map(x=>({...x, isAvailable:!!Number(x.isAvailable)}));
  services = sv.map(x=>({...x, isAvailable:!!Number(x.isAvailable)}));
  orders   = o;
  if(document.getElementById('sec-dashboard').classList.contains('active')) renderDashboard();
  if(document.getElementById('sec-orders').classList.contains('active'))    renderOrdersSection();
  if(document.getElementById('sec-slots').classList.contains('active'))     renderSlotsSection('ALL',null);
  if(document.getElementById('sec-services').classList.contains('active'))  renderServicesAdmin();
}

/* Auto-refresh every 30s */
setInterval(refreshAll, 30000);
/* Init */
loadAll();
</script>
</body>
</html>