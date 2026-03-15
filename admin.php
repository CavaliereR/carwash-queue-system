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
  background:radial-gradient(ellipse 900px 600px at -10% -5%,rgba(0,212,255,0.06) 0%,transparent 55%),
    radial-gradient(ellipse 700px 500px at 110% 100%,rgba(0,184,156,0.05) 0%,transparent 55%);
  pointer-events:none;}
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
.main{margin-left:230px;padding:0 28px 60px;position:relative;z-index:1;min-height:100vh;}
.topbar{position:sticky;top:0;z-index:200;display:flex;align-items:center;justify-content:space-between;padding:14px 0;background:rgba(6,12,20,0.85);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);gap:16px;flex-wrap:wrap;}
.topbar-left{display:flex;flex-direction:column;}
.topbar-title{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;letter-spacing:-.3px;}
.topbar-sub{font-size:12px;color:var(--muted);margin-top:1px;}
.topbar-right{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
.section{display:none;padding-top:24px;animation:fadeIn .3s ease both;}
.section.active{display:block;}
@keyframes fadeIn{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}
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
.panel{background:var(--bg2);border:1px solid var(--border);border-radius:var(--r2);margin-bottom:18px;overflow:hidden;}
.panel-head{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--border);gap:12px;flex-wrap:wrap;}
.panel-head-l{display:flex;align-items:center;gap:10px;}
.panel-title{font-family:'Syne',sans-serif;font-size:15px;font-weight:700;color:var(--text);}
.panel-body{padding:20px;}
.tab-bar{display:flex;gap:4px;margin-bottom:20px;background:var(--bg3);padding:4px;border-radius:var(--r);width:fit-content;}
.tab-btn{padding:8px 18px;border-radius:8px;border:none;background:transparent;font-family:'Outfit',sans-serif;font-size:13px;font-weight:500;color:var(--muted);cursor:pointer;transition:all .18s;display:flex;align-items:center;gap:7px;}
.tab-btn.active{background:rgba(0,212,255,0.12);color:var(--cyan);}
.tab-btn:hover:not(.active){color:var(--soft);}
.tab-count{display:inline-grid;place-items:center;min-width:18px;height:18px;padding:0 5px;border-radius:999px;background:rgba(255,255,255,0.08);color:var(--soft);font-size:10px;font-weight:700;}
.tab-btn.active .tab-count{background:rgba(0,212,255,0.2);color:var(--cyan);}
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
.tbl-wrap{overflow-x:auto;}
table.orders-table{width:100%;border-collapse:collapse;}
.orders-table th{font-size:11px;font-weight:600;letter-spacing:.8px;text-transform:uppercase;color:var(--muted);padding:0 14px 12px;text-align:left;white-space:nowrap;}
.orders-table td{padding:12px 14px;font-size:13px;border-top:1px solid var(--border);vertical-align:middle;}
.orders-table tbody tr{transition:background .15s;}
.orders-table tbody tr:hover td{background:rgba(255,255,255,0.025);}
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
.time-cell{font-size:11px;color:var(--muted);line-height:1.8;}
.time-cell strong{color:var(--soft);}
.dur-badge{display:inline-flex;align-items:center;gap:4px;font-size:11px;padding:2px 8px;border-radius:999px;background:rgba(0,212,255,0.08);color:var(--cyan);font-weight:600;margin-top:2px;}
.empty-state{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;padding:56px 24px;text-align:center;}
.empty-state svg{opacity:.3;}
.empty-state h3{font-size:15px;color:var(--soft);}
.empty-state p{font-size:13px;color:var(--muted);}
.btn-done{display:inline-flex;align-items:center;gap:5px;padding:5px 10px;border-radius:8px;border:1.5px solid rgba(34,197,94,0.35);background:rgba(34,197,94,0.10);color:#86efac;font-size:11px;font-weight:700;cursor:pointer;transition:.18s;white-space:nowrap;font-family:'Outfit',sans-serif;}
.btn-done:hover{background:rgba(34,197,94,0.22);transform:translateY(-1px);}
.modal-overlay{display:none;position:fixed;inset:0;z-index:600;background:rgba(4,9,18,0.70);backdrop-filter:blur(14px);align-items:center;justify-content:center;}
.modal-overlay.open{display:flex;}
.modal{background:var(--bg2);border:1px solid var(--border2);border-radius:var(--r2);padding:28px;width:min(540px,calc(100% - 32px));box-shadow:var(--shadow);animation:fadeIn .25s ease both;max-height:90vh;overflow-y:auto;}
.modal-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:22px;gap:12px;}
.modal-title{font-family:'Syne',sans-serif;font-size:18px;font-weight:800;}
.modal-title-sub{font-size:12px;color:var(--muted);margin-top:2px;}
.modal-close{width:30px;height:30px;border-radius:8px;border:1.5px solid var(--border2);background:rgba(255,255,255,0.04);color:var(--soft);cursor:pointer;font-size:18px;display:grid;place-items:center;transition:all .15s;flex-shrink:0;}
.modal-close:hover{background:rgba(239,68,68,0.12);border-color:rgba(239,68,68,0.3);color:#fca5a5;}
.readonly-banner{background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.2);border-radius:var(--r);padding:10px 14px;font-size:12px;color:#86efac;margin-bottom:18px;}
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
.slots-summary{display:flex;align-items:center;gap:20px;padding:16px 20px;border-bottom:1px solid var(--border);flex-wrap:wrap;}
.slots-stat{display:flex;align-items:center;gap:8px;}
.slots-stat-dot{width:10px;height:10px;border-radius:999px;flex-shrink:0;}
.slots-stat-dot.av{background:var(--green);box-shadow:0 0 8px rgba(34,197,94,0.5);}
.slots-stat-dot.oc{background:var(--red);box-shadow:0 0 8px rgba(239,68,68,0.4);}
.slots-stat-label{font-size:13px;color:var(--soft);}
.slots-stat-num{font-family:'Syne',sans-serif;font-size:18px;font-weight:800;}
.slots-stat-num.av{color:var(--green);}
.slots-stat-num.oc{color:var(--red);}
.slots-divider{width:1px;height:32px;background:var(--border);}
.slot-filter-bar{display:flex;gap:6px;align-items:center;padding:14px 20px;border-bottom:1px solid var(--border);flex-wrap:wrap;}
.slot-filter-btn{padding:6px 16px;border-radius:999px;border:1.5px solid var(--border2);background:transparent;color:var(--muted);font-family:'Outfit',sans-serif;font-size:12px;font-weight:600;cursor:pointer;transition:all .18s;}
.slot-filter-btn:hover{color:var(--soft);border-color:rgba(255,255,255,0.2);}
.slot-filter-btn.active{background:rgba(0,212,255,0.10);border-color:rgba(0,212,255,0.3);color:var(--cyan);}
.slot-cards-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:14px;padding:20px;}
.slot-card{position:relative;border-radius:14px;padding:18px 16px 14px;border:1.5px solid;cursor:default;transition:transform .2s,box-shadow .2s,border-color .2s;animation:fadeIn .3s ease both;overflow:hidden;}
.slot-card::before{content:'';position:absolute;inset:0;border-radius:inherit;opacity:0;transition:opacity .2s;pointer-events:none;}
.slot-card:hover{transform:translateY(-3px);}
.slot-card.av{border-color:rgba(34,197,94,0.25);background:linear-gradient(145deg,rgba(34,197,94,0.06) 0%,rgba(0,184,156,0.04) 100%);}
.slot-card.av::before{background:linear-gradient(135deg,rgba(34,197,94,0.08),transparent);}
.slot-card.av:hover{border-color:rgba(34,197,94,0.5);box-shadow:0 10px 30px rgba(34,197,94,0.12),0 0 0 1px rgba(34,197,94,0.1);}
.slot-card.av:hover::before{opacity:1;}
.slot-card.oc{border-color:rgba(239,68,68,0.2);background:linear-gradient(145deg,rgba(239,68,68,0.05) 0%,rgba(239,68,68,0.02) 100%);opacity:.75;}
.slot-card.oc:hover{border-color:rgba(239,68,68,0.35);box-shadow:0 10px 30px rgba(239,68,68,0.08);}
.slot-card-id{font-family:'Syne',sans-serif;font-size:18px;font-weight:800;letter-spacing:-.3px;margin-bottom:2px;}
.slot-card.av .slot-card-id{color:var(--text);}
.slot-card.oc .slot-card-id{color:var(--soft);}
.slot-card-loc{font-size:11px;color:var(--muted);margin-bottom:12px;font-weight:500;}
.slot-card-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 9px;border-radius:999px;font-size:11px;font-weight:700;margin-bottom:12px;}
.slot-card.av .slot-card-badge{background:rgba(34,197,94,0.12);color:#86efac;}
.slot-card.oc .slot-card-badge{background:rgba(239,68,68,0.12);color:#fca5a5;}
.slot-badge-dot{width:5px;height:5px;border-radius:999px;background:currentColor;}
.slot-card-select{width:100%;padding:7px 10px;border-radius:8px;font-family:'Outfit',sans-serif;font-size:12px;font-weight:500;outline:none;cursor:pointer;transition:all .2s;-webkit-appearance:none;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%234a5e7a' stroke-width='2.5'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 8px center;padding-right:28px;}
.slot-card.av .slot-card-select{border:1.5px solid rgba(34,197,94,0.25);background-color:rgba(34,197,94,0.08);color:#86efac;}
.slot-card.av .slot-card-select:hover{border-color:rgba(34,197,94,0.5);background-color:rgba(34,197,94,0.14);}
.slot-card.oc .slot-card-select{border:1.5px solid rgba(239,68,68,0.2);background-color:rgba(239,68,68,0.08);color:#fca5a5;}
.slot-card.oc .slot-card-select:hover{border-color:rgba(239,68,68,0.4);background-color:rgba(239,68,68,0.14);}
.slot-card-select option{background:var(--bg2);color:var(--text);}
.btn-slot-delete{position:absolute;top:10px;right:10px;width:26px;height:26px;border-radius:7px;border:1px solid rgba(239,68,68,0.2);background:rgba(239,68,68,0.07);color:#fca5a5;cursor:pointer;display:grid;place-items:center;opacity:0;transition:all .18s;padding:0;}
.btn-slot-delete svg{width:13px;height:13px;}
.slot-card:hover .btn-slot-delete{opacity:1;}
.btn-slot-delete:hover{background:rgba(239,68,68,0.2);border-color:rgba(239,68,68,0.45);transform:scale(1.08);}
.slot-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:10px;}
.slot-tile{border-radius:var(--r);border:1.5px solid;padding:14px 12px;transition:all .18s;}
.slot-tile.av{border-color:rgba(34,197,94,0.3);background:rgba(34,197,94,0.05);}
.slot-tile.av:hover{border-color:var(--green);background:rgba(34,197,94,0.10);}
.slot-tile.oc{border-color:rgba(239,68,68,0.2);background:rgba(239,68,68,0.04);opacity:.55;}
.slot-id{font-family:'Syne',sans-serif;font-size:15px;font-weight:800;margin-bottom:3px;}
.slot-loc{font-size:11px;color:var(--muted);margin-bottom:7px;}
.slot-status-txt{font-size:11px;font-weight:600;}
.slot-tile.av .slot-status-txt{color:#86efac;}
.slot-tile.oc .slot-status-txt{color:#fca5a5;}
#svcAdminMount{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;}
.svc-card{position:relative;border-radius:14px;border:1px solid var(--border);background:var(--bg3);padding:20px;overflow:hidden;transition:transform .2s,border-color .25s,box-shadow .25s;animation:fadeIn .3s ease both;}
.svc-card::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(0,212,255,0.05) 0%,transparent 60%);opacity:0;transition:opacity .25s;pointer-events:none;}
.svc-card:hover{transform:translateY(-3px);border-color:rgba(0,212,255,0.22);box-shadow:0 14px 36px rgba(0,0,0,0.4);}
.svc-card:hover::before{opacity:1;}
.svc-card.unavailable{opacity:.5;filter:grayscale(.35);}
.svc-card-top{display:flex;align-items:center;gap:12px;margin-bottom:18px;}
.svc-card-icon{width:42px;height:42px;border-radius:12px;flex-shrink:0;background:rgba(0,212,255,0.08);border:1px solid rgba(0,212,255,0.14);display:grid;place-items:center;}
.svc-card-icon svg{width:20px;height:20px;stroke:var(--cyan);}
.svc-card-name{font-family:'Syne',sans-serif;font-size:15px;font-weight:700;color:var(--text);flex:1;}
.svc-card-prices{display:flex;gap:10px;margin-bottom:16px;}
.svc-price-pill{flex:1;padding:11px 13px;border-radius:10px;background:var(--bg2);border:1px solid var(--border);display:flex;flex-direction:column;gap:3px;transition:border-color .2s;}
.svc-price-pill:hover{border-color:var(--border2);}
.svc-price-label{font-size:10px;font-weight:600;letter-spacing:.8px;text-transform:uppercase;color:var(--muted);}
.svc-price-val{font-family:'Syne',sans-serif;font-size:18px;font-weight:800;color:var(--cyan);}
.svc-card-footer{display:flex;align-items:center;justify-content:space-between;padding-top:14px;border-top:1px solid var(--border);}
.svc-avail-label{font-size:12px;font-weight:600;color:var(--muted);display:flex;align-items:center;gap:6px;}
.svc-avail-dot{width:7px;height:7px;border-radius:999px;background:var(--muted);flex-shrink:0;}
.svc-card:not(.unavailable) .svc-avail-label{color:#86efac;}
.svc-card:not(.unavailable) .svc-avail-dot{background:var(--green);box-shadow:0 0 6px rgba(34,197,94,0.5);}
.svc-footer-btns{display:flex;gap:6px;align-items:center;}
.btn-svc-edit{display:inline-flex;align-items:center;gap:5px;padding:5px 12px;border-radius:7px;border:1px solid var(--border2);background:rgba(255,255,255,0.04);color:var(--soft);font-size:11px;font-weight:600;cursor:pointer;font-family:'Outfit',sans-serif;transition:all .15s;}
.btn-svc-edit:hover{background:rgba(0,212,255,0.08);border-color:rgba(0,212,255,0.28);color:var(--cyan);}
.btn-svc-delete{display:inline-flex;align-items:center;padding:5px 9px;border-radius:7px;border:1px solid rgba(239,68,68,0.18);background:rgba(239,68,68,0.06);color:#fca5a5;font-size:12px;cursor:pointer;font-family:'Outfit',sans-serif;transition:all .15s;line-height:1;}
.btn-svc-delete:hover{background:rgba(239,68,68,0.16);border-color:rgba(239,68,68,0.4);}
.svc-edit-row{max-height:0;overflow:hidden;display:flex;align-items:flex-end;gap:8px;flex-wrap:wrap;margin-top:0;padding-top:0;border-top:0px solid var(--border);opacity:0;transition:max-height .3s ease,opacity .25s ease,margin-top .3s ease,padding-top .3s ease;}
.svc-edit-row.open{max-height:200px;opacity:1;margin-top:14px;padding-top:14px;border-top:1px solid var(--border);}
.svc-price-input-wrap{display:flex;flex-direction:column;gap:5px;flex:1;min-width:90px;}
.svc-price-input-lbl{font-size:10px;font-weight:600;letter-spacing:.7px;text-transform:uppercase;color:var(--muted);}
.svc-price-inp{width:100%;padding:8px 10px;border-radius:8px;border:1.5px solid var(--border2);background:var(--bg2);color:var(--text);font-size:14px;font-family:'DM Mono',monospace;outline:none;transition:border-color .2s;}
.svc-price-inp:focus{border-color:var(--cyan);box-shadow:0 0 0 3px rgba(0,212,255,0.08);}
.svc-edit-actions{display:flex;gap:6px;width:100%;margin-top:2px;}
.btn-svc-save{flex:1;padding:8px 0;border-radius:8px;border:none;background:linear-gradient(90deg,var(--teal),var(--cyan));color:var(--bg0);font-size:13px;font-weight:700;cursor:pointer;font-family:'Outfit',sans-serif;transition:filter .15s,transform .15s;}
.btn-svc-save:hover{filter:brightness(1.08);transform:translateY(-1px);}
.btn-svc-cancel{padding:8px 14px;border-radius:8px;border:1px solid var(--border2);background:transparent;color:var(--muted);font-size:13px;cursor:pointer;font-family:'Outfit',sans-serif;transition:all .15s;}
.btn-svc-cancel:hover{color:var(--soft);}
.switch{position:relative;display:inline-block;width:44px;height:24px;flex-shrink:0;}
.switch input{display:none;}
.slider{position:absolute;cursor:pointer;inset:0;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.14);transition:.2s;border-radius:999px;}
.slider::before{position:absolute;content:"";height:16px;width:16px;left:4px;top:50%;transform:translateY(-50%);background:rgba(6,12,20,.95);transition:.2s;border-radius:999px;}
.switch input:checked+.slider{background:rgba(0,184,156,0.35);border-color:rgba(0,184,156,0.6);}
.switch input:checked+.slider::before{transform:translate(20px,-50%);}
.confirm-body{font-size:14px;color:var(--soft);line-height:1.6;margin-bottom:20px;}
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
.svc-dropdown-wrap{position:relative;}
.svc-dropdown-trigger{width:100%;padding:11px 13px;border-radius:var(--r);border:1.5px solid var(--border2);background:var(--bg3);color:var(--text);font-family:'Outfit',sans-serif;font-size:14px;outline:none;cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:8px;transition:all .2s;user-select:none;}
.svc-dropdown-trigger:hover{border-color:rgba(255,255,255,0.2);}
.svc-dropdown-trigger.open{border-color:var(--cyan);box-shadow:0 0 0 3px rgba(0,212,255,0.08);}
.svc-dropdown-trigger.error{border-color:var(--red)!important;box-shadow:0 0 0 3px rgba(239,68,68,0.10)!important;}
.svc-dropdown-trigger.disabled{opacity:.5;cursor:not-allowed;pointer-events:none;}
.svc-trigger-text{flex:1;text-align:left;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:var(--muted);}
.svc-trigger-text.has-val{color:var(--text);}
.svc-trigger-arrow{width:16px;height:16px;opacity:.5;transition:transform .2s;flex-shrink:0;}
.svc-dropdown-trigger.open .svc-trigger-arrow{transform:rotate(180deg);}
.svc-dropdown-panel{position:absolute;top:calc(100% + 6px);left:0;right:0;background:var(--bg2);border:1.5px solid var(--border2);border-radius:var(--r);box-shadow:0 16px 40px rgba(0,0,0,0.55);z-index:900;display:none;animation:fadeIn .15s ease both;}
.svc-dropdown-panel.open{display:block;}
.svc-panel-list{max-height:240px;overflow-y:auto;padding:6px;}
.svc-chk-item{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:8px;cursor:pointer;transition:background .15s;font-size:13px;color:var(--soft);}
.svc-chk-item:hover{background:rgba(255,255,255,0.05);color:var(--text);}
.svc-chk-item.checked{background:rgba(0,212,255,0.07);color:var(--text);}
.svc-chk-box{width:17px;height:17px;border-radius:5px;border:1.5px solid var(--border2);background:var(--bg3);display:grid;place-items:center;flex-shrink:0;transition:all .15s;}
.svc-chk-item.checked .svc-chk-box{background:var(--cyan);border-color:var(--cyan);}
.svc-chk-tick{width:10px;height:10px;stroke:var(--bg0);fill:none;opacity:0;transition:opacity .1s;}
.svc-chk-item.checked .svc-chk-tick{opacity:1;}
.svc-chk-name{flex:1;}
.svc-chk-price{font-size:11px;color:var(--muted);font-family:'DM Mono',monospace;}
.svc-chk-item.checked .svc-chk-price{color:var(--cyan);}
.svc-panel-footer{display:flex;align-items:center;justify-content:space-between;padding:8px 12px;border-top:1px solid var(--border);}
.svc-selected-count{font-size:11px;color:var(--muted);}
.svc-clear-btn{font-size:11px;color:var(--soft);background:none;border:none;cursor:pointer;padding:3px 8px;border-radius:5px;font-family:'Outfit',sans-serif;transition:color .15s;}
.svc-clear-btn:hover{color:#fca5a5;}
.svc-modal-info{background:rgba(0,212,255,0.04);border:1px solid rgba(0,212,255,0.13);border-radius:var(--r);padding:10px 14px;font-size:12px;color:var(--soft);margin-bottom:18px;line-height:1.6;}
.svc-modal-info strong{color:var(--cyan);}

/* ══ REVENUE SECTION ══ */
.svc-rev-list{display:flex;flex-direction:column;gap:12px;padding:20px;}
.svc-rev-item{display:flex;align-items:center;gap:16px;padding:16px 18px;border-radius:var(--r2);background:var(--bg3);border:1px solid var(--border);transition:border-color .2s,transform .2s;}
.svc-rev-item:hover{border-color:var(--border2);transform:translateX(3px);}
.svc-rev-rank{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;width:30px;flex-shrink:0;text-align:center;}
.svc-rev-rank.r1{color:var(--amber);}
.svc-rev-rank.r2{color:var(--soft);}
.svc-rev-rank.r3{color:#cd7c3a;}
.svc-rev-rank.rn{color:var(--muted);}
.svc-rev-info{flex:1;min-width:0;}
.svc-rev-name{font-size:14px;font-weight:600;color:var(--text);margin-bottom:8px;}
.svc-rev-bar-wrap{height:7px;background:rgba(255,255,255,0.06);border-radius:999px;overflow:hidden;}
.svc-rev-bar-fill{height:100%;border-radius:999px;background:linear-gradient(90deg,var(--teal),var(--cyan));transition:width .6s cubic-bezier(.4,0,.2,1);}
.svc-rev-right{text-align:right;flex-shrink:0;}
.svc-rev-amount{font-family:'Syne',sans-serif;font-size:18px;font-weight:800;color:var(--cyan);}
.svc-rev-count{font-size:11px;color:var(--muted);margin-top:2px;}
.rev-empty{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;padding:60px 24px;color:var(--muted);font-size:13px;text-align:center;}
.rev-empty svg{opacity:.25;}

@media(max-width:960px){.sidebar{display:none;}.main{margin-left:0;}.stats-grid{grid-template-columns:repeat(2,1fr);}.form-row{grid-template-columns:1fr;}}
@media(max-width:560px){.stats-grid{grid-template-columns:1fr 1fr;}.main{padding:0 16px 50px;}.slot-cards-grid{grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:10px;padding:14px;}}
::-webkit-scrollbar{width:6px;height:6px;}::-webkit-scrollbar-track{background:transparent;}::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.09);border-radius:99px;}
</style>
</head>
<body>

<aside class="sidebar">
  <div class="sb-logo">
    <div class="sb-logo-mark"><svg viewBox="0 0 24 24"><path d="M19 17H5v-2l1-4h12l1 4v2zm-1.5 2a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm-11 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/></svg></div>
    <div><div class="sb-logo-text">Car Wash</div><div class="sb-logo-sub">Admin Panel</div></div>
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
    <button class="nav-btn" id="navRevenue" onclick="showSection('revenue',this)">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      Revenue
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

  <!-- DASHBOARD -->
  <section class="section active" id="sec-dashboard">
    <div class="stats-grid">
      <div class="stat-card s-total">
        <div class="sc-icon"><svg fill="none" viewBox="0 0 24 24" stroke="var(--cyan)" stroke-width="1.8"><path stroke-linecap="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg></div>
        <div class="sc-val" id="statTotal">0</div><div class="sc-label">Total Orders</div><div class="sc-sub" id="statTotalSub">–</div>
      </div>
      <div class="stat-card s-pending">
        <div class="sc-icon"><svg fill="none" viewBox="0 0 24 24" stroke="var(--amber)" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg></div>
        <div class="sc-val" id="statPending">0</div><div class="sc-label">Pending / In Progress</div><div class="sc-sub">Awaiting service</div>
      </div>
      <div class="stat-card s-done">
        <div class="sc-icon"><svg fill="none" viewBox="0 0 24 24" stroke="var(--green)" stroke-width="1.8"><path stroke-linecap="round" d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
        <div class="sc-val" id="statDone">0</div><div class="sc-label">Completed Today</div><div class="sc-sub" id="statRevenue">₱0 revenue</div>
      </div>
      <div class="stat-card s-top">
        <div class="sc-icon"><svg fill="none" viewBox="0 0 24 24" stroke="var(--purple)" stroke-width="1.8"><path stroke-linecap="round" d="M5 3l14 9-14 9V3z"/></svg></div>
        <div class="sc-val" id="statTopSvc">—</div><div class="sc-label">Top Service</div><div class="sc-sub" id="statTopSvcCount">0 orders</div>
      </div>
    </div>
    <div class="panel">
      <div class="panel-head">
        <div class="panel-head-l"><div class="panel-title">Active Orders</div><span class="count-badge" id="dashActiveCount">0</span></div>
        <button class="btn btn-ghost btn-sm" onclick="showSection('orders',document.getElementById('navOrders'));switchOrderTab('active')">View All →</button>
      </div>
      <div id="dashActiveMount"></div>
    </div>
    <div class="panel">
      <div class="panel-head">
        <div class="panel-head-l"><div class="panel-title">Recently Completed</div><span class="count-badge" id="dashDoneCount">0</span></div>
        <button class="btn btn-ghost btn-sm" onclick="showSection('orders',document.getElementById('navOrders'));switchOrderTab('completed')">View All →</button>
      </div>
      <div id="dashDoneMount"></div>
    </div>
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

  <!-- ORDERS -->
  <section class="section" id="sec-orders">
    <div class="panel">
      <div class="panel-head">
        <div class="panel-head-l"><div class="panel-title">Orders</div><span class="count-badge" id="ordersCount">0</span></div>
        <button class="btn btn-primary btn-sm" onclick="openAddModal()">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>Add Order
        </button>
      </div>
      <div class="panel-body">
        <div class="tab-bar">
          <button class="tab-btn active" id="tabActive" onclick="switchOrderTab('active')">Active Orders <span class="tab-count" id="tcActive">0</span></button>
          <button class="tab-btn" id="tabCompleted" onclick="switchOrderTab('completed')">Completed / Cancelled <span class="tab-count" id="tcDone">0</span></button>
        </div>
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

  <!-- REVENUE -->
  <section class="section" id="sec-revenue">
    <div class="panel">
      <div class="panel-head">
        <div class="panel-head-l">
          <div class="panel-title">Most Profitable Services</div>
          <span class="count-badge" id="revSvcCount">0</span>
        </div>
        <div style="font-size:12px;color:var(--muted);">Based on all completed orders</div>
      </div>
      <div class="svc-rev-list" id="revSvcList"></div>
    </div>
  </section>

  <!-- SLOTS -->
  <section class="section" id="sec-slots">
    <div class="panel" style="overflow:visible;">
      <div class="panel-head">
        <div class="panel-head-l">
          <div class="panel-title">Slots / Bays</div>
          <span class="count-badge" id="slotPanelCount">0</span>
        </div>
        <button class="btn btn-primary btn-sm" onclick="openAddSlotModal()">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          Add Slot
        </button>
      </div>
      <div class="slots-summary">
        <div class="slots-stat">
          <span class="slots-stat-dot av"></span>
          <span class="slots-stat-label">Available</span>
          <span class="slots-stat-num av" id="slotAvailNum">0</span>
        </div>
        <div class="slots-divider"></div>
        <div class="slots-stat">
          <span class="slots-stat-dot oc"></span>
          <span class="slots-stat-label">Occupied</span>
          <span class="slots-stat-num oc" id="slotOccNum">0</span>
        </div>
        <div class="slots-divider"></div>
        <div class="slots-stat">
          <span style="font-size:12px;color:var(--muted);">Total Bays</span>
          <span class="slots-stat-num" style="color:var(--soft);margin-left:6px;" id="slotTotalNum">0</span>
        </div>
      </div>
      <div class="slot-filter-bar">
        <button class="slot-filter-btn active" id="sfAll" onclick="renderSlotsSection('ALL',this)">All Bays</button>
        <button class="slot-filter-btn" id="sfAv" onclick="renderSlotsSection('available',this)">
          <span style="display:inline-flex;align-items:center;gap:5px;"><span style="width:7px;height:7px;border-radius:999px;background:var(--green);display:inline-block;"></span>Available</span>
        </button>
        <button class="slot-filter-btn" id="sfOc" onclick="renderSlotsSection('occupied',this)">
          <span style="display:inline-flex;align-items:center;gap:5px;"><span style="width:7px;height:7px;border-radius:999px;background:var(--red);display:inline-block;"></span>Occupied</span>
        </button>
      </div>
      <div class="slot-cards-grid" id="adminSlotGrid"></div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="section" id="sec-services">
    <div class="panel">
      <div class="panel-head">
        <div class="panel-head-l">
          <div class="panel-title">Service Configuration</div>
          <span class="count-badge" id="svcCount">0</span>
        </div>
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
          <div style="font-size:12px;color:var(--muted);">Toggle availability · Edit Car &amp; Moto prices</div>
          <button class="btn btn-primary btn-sm" onclick="openAddServiceModal()">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            Add Service
          </button>
        </div>
      </div>
      <div class="panel-body"><div id="svcAdminMount"></div></div>
    </div>
  </section>
</main>

<!-- ORDER MODAL -->
<div class="modal-overlay" id="orderModal">
  <div class="modal">
    <div class="modal-header">
      <div><div class="modal-title" id="modalTitle">Add New Order</div><div class="modal-title-sub" id="modalSub">Fill in the details below</div></div>
      <button class="modal-close" onclick="closeModal('orderModal')">✕</button>
    </div>
    <div class="readonly-banner" id="readonlyBanner" style="display:none;">✓ This order is completed and cannot be modified.</div>
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
    <div class="form-row single">
      <div class="form-group">
        <label class="form-label">Service *</label>
        <div class="svc-dropdown-wrap" id="svcDropdownWrap">
          <div class="svc-dropdown-trigger" id="svcDropdownTrigger" onclick="toggleSvcDropdown()">
            <span class="svc-trigger-text" id="svcTriggerText">Select service…</span>
            <svg class="svc-trigger-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M19 9l-7 7-7-7"/></svg>
          </div>
          <div class="svc-dropdown-panel" id="svcDropdownPanel">
            <div class="svc-panel-list" id="svcPanelList"></div>
            <div class="svc-panel-footer">
              <span class="svc-selected-count" id="svcSelectedCount">0 selected</span>
              <button class="svc-clear-btn" onclick="clearSvcSelection();event.stopPropagation();">Clear all</button>
            </div>
          </div>
        </div>
        <div class="form-error" id="errService"></div>
      </div>
    </div>
    <div class="form-row single">
      <div class="form-group">
        <label class="form-label">Total Price (auto-calculated)</label>
        <div class="price-display" id="priceDisplay">₱0</div>
        <div class="form-hint">Price updates automatically based on selected services and vehicle type.</div>
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn btn-ghost" onclick="closeModal('orderModal')">Cancel</button>
      <button class="btn btn-primary" id="modalSaveBtn" onclick="saveOrder()">Save Order</button>
    </div>
  </div>
</div>

<!-- ADD SERVICE MODAL -->
<div class="modal-overlay" id="addServiceModal">
  <div class="modal">
    <div class="modal-header">
      <div><div class="modal-title">Add New Service</div><div class="modal-title-sub">Create a new wash or detailing service</div></div>
      <button class="modal-close" onclick="closeModal('addServiceModal')">✕</button>
    </div>
    <div class="svc-modal-info">The new service will appear in the order form immediately. You can toggle availability or adjust prices at any time from the Services panel.</div>
    <div class="modal-alert" id="svcModalAlert"></div>
    <div class="form-row single">
      <div class="form-group">
        <label class="form-label">Service Name *</label>
        <input class="form-input" id="fSvcName" placeholder="e.g. Full Detail, Undercarriage Wash…" oninput="clearErr('fSvcName','errSvcName')">
        <div class="form-error" id="errSvcName"></div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">🚗 Car Price (₱) *</label>
        <input class="form-input" id="fSvcCarPrice" type="number" min="0" step="0.01" placeholder="0" style="font-family:'DM Mono',monospace;" oninput="clearErr('fSvcCarPrice','errSvcCarPrice')">
        <div class="form-error" id="errSvcCarPrice"></div>
      </div>
      <div class="form-group">
        <label class="form-label">🏍 Motorcycle Price (₱) *</label>
        <input class="form-input" id="fSvcMotoPrice" type="number" min="0" step="0.01" placeholder="0" style="font-family:'DM Mono',monospace;" oninput="clearErr('fSvcMotoPrice','errSvcMotoPrice')">
        <div class="form-error" id="errSvcMotoPrice"></div>
      </div>
    </div>
    <div class="form-row single">
      <div class="form-group">
        <label class="form-label">Initial Availability</label>
        <select class="form-select" id="fSvcAvail">
          <option value="1">✓ Available — show in kiosk &amp; order form</option>
          <option value="0">✗ Unavailable — hidden from customers</option>
        </select>
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn btn-ghost" onclick="closeModal('addServiceModal')">Cancel</button>
      <button class="btn btn-primary" onclick="saveNewService()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>Create Service
      </button>
    </div>
  </div>
</div>

<!-- ADD SLOT MODAL -->
<div class="modal-overlay" id="addSlotModal">
  <div class="modal" style="max-width:420px;">
    <div class="modal-header">
      <div><div class="modal-title">Add New Slot</div><div class="modal-title-sub">Create a new washing bay</div></div>
      <button class="modal-close" onclick="closeModal('addSlotModal')">✕</button>
    </div>
    <div class="svc-modal-info">The new slot will be immediately available for orders. You can toggle its availability at any time from the slots panel.</div>
    <div class="modal-alert" id="slotModalAlert"></div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Slot ID *</label>
        <input class="form-input" id="fSlotId" placeholder="e.g. A011" style="font-family:'DM Mono',monospace;text-transform:uppercase;" oninput="clearErr('fSlotId','errSlotId');this.value=this.value.toUpperCase()">
        <div class="form-error" id="errSlotId"></div>
        <div class="form-hint">Unique ID like A011, B001…</div>
      </div>
      <div class="form-group">
        <label class="form-label">Location / Label *</label>
        <input class="form-input" id="fSlotLocation" placeholder="e.g. Bay 11" oninput="clearErr('fSlotLocation','errSlotLocation')">
        <div class="form-error" id="errSlotLocation"></div>
      </div>
    </div>
    <div class="form-row single">
      <div class="form-group">
        <label class="form-label">Initial Status</label>
        <select class="form-select" id="fSlotAvail">
          <option value="1">✓ Available — open for orders</option>
          <option value="0">✗ Unavailable — closed / under maintenance</option>
        </select>
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn btn-ghost" onclick="closeModal('addSlotModal')">Cancel</button>
      <button class="btn btn-primary" onclick="saveNewSlot()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>Create Slot
      </button>
    </div>
  </div>
</div>

<!-- CONFIRM MODAL -->
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
const API='api.php';
async function apiFetch(action,data=null){
  const opts=data?{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(data)}:{method:'GET'};
  const res=await fetch(`${API}?action=${action}`,opts);
  if(!res.ok)throw new Error(await res.text());
  return res.json();
}

let slots=[],services=[],orders=[];
let editingOrderId=null,currentOrderTab='active';
let svcSelected=[],svcDropOpen=false;
let currentSlotFilter='ALL';

const MOTO_INCOMPATIBLE=['Premium Wash'];
function isMoto(v){return['Scooter','Underbone','Big Bike'].includes(v);}
function getServicePrice(n,v){const s=services.find(x=>x.name===n);if(!s)return 0;return isMoto(v)?Number(s.motoPrice):Number(s.carPrice);}
function getOccupiedSlotIds(){return new Set(orders.filter(o=>o.status==='Pending'||o.status==='In Progress').map(o=>o.slotId));}
function isSlotAvailableForEdit(slotId,excludeOrderId){
  const slot=slots.find(s=>s.slotId===slotId);if(!slot||!Number(slot.isAvailable))return false;
  if(excludeOrderId){const e=orders.find(o=>o.id==excludeOrderId);if(e&&e.slotId===slotId)return true;}
  return!getOccupiedSlotIds().has(slotId);
}

async function loadAll(){
  const[s,sv,o]=await Promise.all([apiFetch('get_slots'),apiFetch('get_services'),apiFetch('get_orders')]);
  slots=s.map(x=>({...x,isAvailable:!!Number(x.isAvailable)}));
  services=sv.map(x=>({...x,isAvailable:!!Number(x.isAvailable)}));
  orders=o;renderAll();
}
function renderAll(){renderDashboard();renderOrdersSection();renderSlotsSection(currentSlotFilter,null);renderServicesAdmin();renderRevenue();}

const SECTIONS={
  dashboard:{el:'sec-dashboard',title:'Dashboard',sub:'Overview of all operations'},
  orders:{el:'sec-orders',title:'Orders',sub:'Manage all car wash orders'},
  revenue:{el:'sec-revenue',title:'Revenue',sub:'Track earnings and financial performance'},
  slots:{el:'sec-slots',title:'Slots / Bays',sub:'Manage washing bay availability'},
  services:{el:'sec-services',title:'Services',sub:'Configure service availability and pricing'},
};
function showSection(key,btn){
  Object.values(SECTIONS).forEach(s=>document.getElementById(s.el).classList.remove('active'));
  document.querySelectorAll('.nav-btn').forEach(b=>b.classList.remove('active'));
  const sec=SECTIONS[key];document.getElementById(sec.el).classList.add('active');
  if(btn)btn.classList.add('active');
  document.getElementById('topbarTitle').textContent=sec.title;
  document.getElementById('topbarSub').textContent=sec.sub;
  if(key==='revenue')renderRevenue();
}

/* ══ DASHBOARD ══ */
function renderDashboard(){
  const today=new Date().toISOString().slice(0,10);
  const active=orders.filter(o=>o.status==='Pending'||o.status==='In Progress');
  const completed=orders.filter(o=>o.status==='Completed');
  const todayDone=completed.filter(o=>(o.timestamp||'').startsWith(today));
  const revenue=todayDone.reduce((s,o)=>s+(Number(o.total)||0),0);
  document.getElementById('statTotal').textContent=orders.length;
  document.getElementById('statTotalSub').textContent=orders.filter(o=>o.source==='kiosk').length+' from kiosk';
  document.getElementById('statPending').textContent=active.length;
  document.getElementById('statDone').textContent=todayDone.length;
  document.getElementById('statRevenue').textContent='₱'+revenue.toLocaleString()+' revenue today';
  const svcCount={};
  orders.forEach(o=>{if(!o.service)return;o.service.split(',').forEach(s=>{const t=s.trim();svcCount[t]=(svcCount[t]||0)+1;});});
  const topSvc=Object.entries(svcCount).sort((a,b)=>b[1]-a[1])[0];
  document.getElementById('statTopSvc').textContent=topSvc?topSvc[0].split(' ')[0]:'—';
  document.getElementById('statTopSvcCount').textContent=topSvc?topSvc[1]+' orders':'No data';
  document.getElementById('dashActiveCount').textContent=active.length;
  document.getElementById('dashActiveMount').innerHTML=active.length?'<div class="tbl-wrap">'+buildOrdersTable(active.slice(0,5),true)+'</div>':emptyState('No active orders right now.','Orders from kiosk or manually added will appear here.');
  document.getElementById('dashDoneCount').textContent=completed.length;
  document.getElementById('dashDoneMount').innerHTML=completed.length?'<div class="tbl-wrap">'+buildOrdersTable(completed.slice(0,5),true)+'</div>':emptyState('No completed orders yet.','Completed orders will appear here.');
  renderDashboardSlots();
}
function renderDashboardSlots(){
  const occupied=getOccupiedSlotIds();let avail=0,occ=0;
  const grid=document.getElementById('dashSlotGrid');grid.innerHTML='';
  slots.forEach(s=>{
    const eff=s.isAvailable&&!occupied.has(s.slotId);if(eff)avail++;else occ++;
    const div=document.createElement('div');div.className='slot-tile '+(eff?'av':'oc');
    div.innerHTML='<div class="slot-id">'+s.slotId+'</div><div class="slot-loc">'+s.location+'</div><div class="slot-status-txt">'+(eff?'Available':'Occupied')+'</div>';
    grid.appendChild(div);
  });
  document.getElementById('availCount').textContent=avail;document.getElementById('occCount').textContent=occ;
}
function emptyState(h,p){return'<div class="empty-state"><svg width="44" height="44" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.3"><path stroke-linecap="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg><h3>'+h+'</h3><p>'+p+'</p></div>';}

/* ══ ORDERS ══ */
function switchOrderTab(tab){
  currentOrderTab=tab;
  document.getElementById('tabActive').classList.toggle('active',tab==='active');
  document.getElementById('tabCompleted').classList.toggle('active',tab==='completed');
  applyFilters();
}
function renderOrdersSection(){
  document.getElementById('tcActive').textContent=orders.filter(o=>o.status==='Pending'||o.status==='In Progress').length;
  document.getElementById('tcDone').textContent=orders.filter(o=>o.status==='Completed'||o.status==='Cancelled').length;
  applyFilters();
}
function getFilteredOrders(){
  const q=(document.getElementById('searchInput')?.value||'').trim().toLowerCase();
  const fv=(document.getElementById('filterVehicle')?.value||'');
  const fs=(document.getElementById('filterService')?.value||'');
  const fd=(document.getElementById('filterDate')?.value||'');
  let list=currentOrderTab==='active'?orders.filter(o=>o.status==='Pending'||o.status==='In Progress'):orders.filter(o=>o.status==='Completed'||o.status==='Cancelled');
  return list.filter(o=>{
    if(q&&!o.customerName.toLowerCase().includes(q)&&!o.plateNumber.toLowerCase().includes(q))return false;
    if(fv&&o.vehicleType!==fv)return false;if(fs&&!o.service.includes(fs))return false;
    if(fd&&!(o.timestamp||'').startsWith(fd))return false;return true;
  });
}
function applyFilters(){
  const list=getFilteredOrders();document.getElementById('ordersCount').textContent=list.length;
  const wrap=document.getElementById('ordersTableWrap');
  if(!list.length){wrap.innerHTML='<div class="empty-state"><svg width="44" height="44" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.3"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg><h3>No orders found.</h3><p>Try adjusting your search or filter criteria.</p></div>';return;}
  wrap.innerHTML='<div class="tbl-wrap">'+buildOrdersTable(list,false)+'</div>';
}
function clearFilters(){document.getElementById('searchInput').value='';document.getElementById('filterVehicle').value='';document.getElementById('filterService').value='';document.getElementById('filterDate').value='';applyFilters();}

function buildOrdersTable(list,mini){
  let h='<table class="orders-table"><thead><tr><th>Ref</th><th>Customer</th><th>Plate</th><th>Vehicle</th><th>Slot</th><th>Service</th><th>Total</th><th>Status</th>';
  if(!mini)h+='<th>Time / Duration</th><th>Source</th><th>Actions</th>';
  h+='</tr></thead><tbody>';
  list.forEach(o=>{
    const sc=statusCls(o.status);
    let timeCell='<span style="color:var(--muted)">—</span>';
    if(!mini){const p=[];if(o.startTime||o.start_time)p.push('<strong>Start:</strong> '+fmtTime(o.startTime||o.start_time));if(o.endTime||o.end_time)p.push('<strong>End:</strong> '+fmtTime(o.endTime||o.end_time));if(o.duration)p.push('<span class="dur-badge">⏱ '+esc(o.duration)+'</span>');if(p.length)timeCell='<div class="time-cell">'+p.join('<br>')+'</div>';}
    let actions='';
    if(!mini){
      if(o.status==='Pending'){actions='<button class="btn-done" onclick="quickComplete('+o.id+',\'In Progress\')">▶ Start</button><button class="btn btn-ghost btn-sm" onclick="openEditModal('+o.id+')">Edit</button><button class="btn btn-danger btn-sm" onclick="confirmDeleteOrder('+o.id+')">Delete</button>';}
      else if(o.status==='In Progress'){actions='<button class="btn-done" onclick="confirmComplete('+o.id+')">✓ Done</button><button class="btn btn-ghost btn-sm" onclick="openEditModal('+o.id+')">Edit</button><button class="btn btn-danger btn-sm" onclick="confirmDeleteOrder('+o.id+')">Delete</button>';}
      else{actions='<button class="btn btn-ghost btn-sm" onclick="openEditModal('+o.id+')">View</button><button class="btn btn-danger btn-sm" onclick="confirmDeleteOrder('+o.id+')">Delete</button>';}
    }
    h+='<tr><td><span class="ref-tag">'+esc(o.refId||'–')+'</span></td><td><strong>'+esc(o.customerName)+'</strong><div style="font-size:11px;color:var(--muted);">'+(o.timestamp||'')+'</div></td><td><span class="plate-tag">'+esc(o.plateNumber)+'</span></td><td>'+esc(o.vehicleType)+'</td><td><strong>'+esc(o.slotId)+'</strong></td><td style="max-width:160px;font-size:12px;color:var(--soft);">'+esc(o.service)+'</td><td><span class="price-tag">₱'+(Number(o.total)||0).toLocaleString()+'</span></td><td><span class="status-badge '+sc+'"><span class="bdot"></span>'+o.status+'</span></td>';
    if(!mini)h+='<td>'+timeCell+'</td><td><span class="src-badge '+(o.source==='kiosk'?'src-kiosk':'src-admin')+'">'+(o.source==='kiosk'?'Kiosk':'Admin')+'</span></td><td><div class="row-actions">'+actions+'</div></td>';
    h+='</tr>';
  });
  return h+'</tbody></table>';
}
function statusCls(s){if(s==='Pending')return 's-pending';if(s==='In Progress')return 's-inprogress';if(s==='Completed')return 's-completed';if(s==='Cancelled')return 's-cancelled';return'';}
function fmtTime(ts){if(!ts)return'—';try{return new Date(ts).toLocaleTimeString('en-PH',{hour:'2-digit',minute:'2-digit'});}catch{return ts;}}

async function quickComplete(id,newStatus){
  const o=orders.find(x=>x.id==id);if(!o)return;
  if(newStatus==='In Progress'){const c=orders.find(x=>x.id!=id&&x.slotId===o.slotId&&x.status==='In Progress');if(c){toast('error',o.slotId+' is currently occupied.');return;}}
  try{await apiFetch('update_order_status',{id,status:newStatus});toast('success','Order moved to '+newStatus+'.');await refreshAll();}catch(e){toast('error','Failed: '+e.message);}
}
function confirmComplete(id){
  const o=orders.find(x=>x.id==id);if(!o)return;
  document.getElementById('confirmTitle').textContent='Mark as Completed?';document.getElementById('confirmTitle').style.color='var(--green)';
  document.getElementById('confirmBody').innerHTML='Mark order <strong>'+esc(o.refId)+'</strong> for <strong>'+esc(o.customerName)+'</strong> as <strong style="color:#86efac;">Completed</strong>?<br><br>This will record the completion time and free the slot.';
  document.getElementById('confirmOkBtn').className='btn btn-success';document.getElementById('confirmOkBtn').textContent='✓ Confirm Complete';
  document.getElementById('confirmOkBtn').onclick=()=>doComplete(id);document.getElementById('confirmModal').classList.add('open');
}
async function doComplete(id){closeModal('confirmModal');try{await apiFetch('update_order_status',{id,status:'Completed'});toast('success','Order marked as Completed. Slot released.');await refreshAll();}catch(e){toast('error','Failed: '+e.message);}}

/* ══ REVENUE ══ */
function renderRevenue(){
  const completed=orders.filter(o=>o.status==='Completed');
  const svcRev={};
  const svcCount={};
  completed.forEach(o=>{
    if(!o.service)return;
    const svcs=o.service.split(',').map(s=>s.trim()).filter(Boolean);
    const perSvc=(Number(o.total)||0)/svcs.length;
    svcs.forEach(s=>{
      svcRev[s]=(svcRev[s]||0)+perSvc;
      svcCount[s]=(svcCount[s]||0)+1;
    });
  });

  const sorted=Object.entries(svcRev).sort((a,b)=>b[1]-a[1]);
  const maxRev=sorted[0]?sorted[0][1]:1;
  const mount=document.getElementById('revSvcList');
  document.getElementById('revSvcCount').textContent=sorted.length;

  if(!sorted.length){
    mount.innerHTML='<div class="rev-empty"><svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.3"><path stroke-linecap="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><span>No completed orders yet. Revenue will appear here once orders are completed.</span></div>';
    return;
  }

  const rankClass=['r1','r2','r3'];
  mount.innerHTML=sorted.map(([name,rev],i)=>{
    const pct=maxRev>0?(rev/maxRev*100):0;
    const rc=rankClass[i]||'rn';
    const medal=i===0?'🥇':i===1?'🥈':i===2?'🥉':(i+1);
    return `<div class="svc-rev-item">
      <div class="svc-rev-rank ${rc}">${medal}</div>
      <div class="svc-rev-info">
        <div class="svc-rev-name">${esc(name)}</div>
        <div class="svc-rev-bar-wrap"><div class="svc-rev-bar-fill" style="width:${pct}%"></div></div>
      </div>
      <div class="svc-rev-right">
        <div class="svc-rev-amount">₱${Math.round(rev).toLocaleString()}</div>
        <div class="svc-rev-count">${svcCount[name]} order${svcCount[name]!==1?'s':''}</div>
      </div>
    </div>`;
  }).join('');
}

/* ══ SERVICE DROPDOWN ══ */
function toggleSvcDropdown(){const t=document.getElementById('svcDropdownTrigger');if(t.classList.contains('disabled'))return;svcDropOpen=!svcDropOpen;t.classList.toggle('open',svcDropOpen);document.getElementById('svcDropdownPanel').classList.toggle('open',svcDropOpen);}
function closeSvcDropdown(){svcDropOpen=false;document.getElementById('svcDropdownTrigger').classList.remove('open');document.getElementById('svcDropdownPanel').classList.remove('open');}
function buildSvcDropdownItems(vehicleType){
  const isMotoV=isMoto(vehicleType);const list=document.getElementById('svcPanelList');list.innerHTML='';
  services.filter(s=>s.isAvailable).forEach(s=>{
    if(isMotoV&&MOTO_INCOMPATIBLE.includes(s.name))return;
    const price=isMotoV?s.motoPrice:s.carPrice;const isChk=svcSelected.includes(s.name);
    const item=document.createElement('div');item.className='svc-chk-item'+(isChk?' checked':'');item.dataset.name=s.name;
    item.innerHTML='<div class="svc-chk-box"><svg class="svc-chk-tick" viewBox="0 0 10 10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1.5,5 4,7.5 8.5,2.5"/></svg></div><span class="svc-chk-name">'+esc(s.name)+'</span><span class="svc-chk-price">₱'+Number(price).toLocaleString()+'</span>';
    item.addEventListener('click',()=>toggleSvcItem(s.name,item));list.appendChild(item);
  });updateSvcTrigger();
}
function toggleSvcItem(name,item){
  const idx=svcSelected.indexOf(name);if(idx===-1){svcSelected.push(name);item.classList.add('checked');}else{svcSelected.splice(idx,1);item.classList.remove('checked');}
  updateSvcTrigger();updatePriceDisplay();
  document.getElementById('svcDropdownTrigger').classList.remove('error');const err=document.getElementById('errService');err.textContent='';err.classList.remove('visible');
}
function updateSvcTrigger(){
  const txt=document.getElementById('svcTriggerText');document.getElementById('svcSelectedCount').textContent=svcSelected.length+' selected';
  if(!svcSelected.length){txt.textContent='Select service…';txt.classList.remove('has-val');}
  else if(svcSelected.length===1){txt.textContent=svcSelected[0];txt.classList.add('has-val');}
  else{txt.textContent=svcSelected.length+' services selected';txt.classList.add('has-val');}
}
function clearSvcSelection(){svcSelected=[];document.querySelectorAll('#svcPanelList .svc-chk-item').forEach(i=>i.classList.remove('checked'));updateSvcTrigger();updatePriceDisplay();}
function setSvcDropdownDisabled(d){const t=document.getElementById('svcDropdownTrigger');if(d){t.classList.add('disabled');closeSvcDropdown();}else t.classList.remove('disabled');}
document.addEventListener('click',e=>{if(svcDropOpen&&!document.getElementById('svcDropdownWrap').contains(e.target))closeSvcDropdown();});

/* ══ ORDER MODAL ══ */
function openAddModal(){
  const av=slots.filter(s=>s.isAvailable).length,ao=orders.filter(o=>o.status==='Pending'||o.status==='In Progress').length;
  if(av>0&&ao>=av){toast('warn','All wash slots are currently occupied.');showModalAlert('warn','All wash slots are currently occupied.');}
  editingOrderId=null;document.getElementById('modalTitle').textContent='Add New Order';document.getElementById('modalSub').textContent='Manually create an order';
  document.getElementById('modalSaveBtn').textContent='Save Order';document.getElementById('modalSaveBtn').style.display='';document.getElementById('readonlyBanner').style.display='none';
  resetForm(false);populateSlotDropdown(null);document.getElementById('orderModal').classList.add('open');
}
function openEditModal(id){
  const o=orders.find(x=>x.id==id);if(!o)return;
  const ro=(o.status==='Completed'||o.status==='Cancelled');editingOrderId=id;
  document.getElementById('modalTitle').textContent=ro?'View Order':'Edit Order';document.getElementById('modalSub').textContent='Ref: '+o.refId;
  document.getElementById('modalSaveBtn').textContent='Update Order';document.getElementById('modalSaveBtn').style.display=ro?'none':'';
  document.getElementById('readonlyBanner').style.display=ro?'':'none';document.getElementById('modalAlert').className='modal-alert';
  resetForm(ro);
  document.getElementById('fCustName').value=o.customerName;document.getElementById('fPlate').value=o.plateNumber;document.getElementById('fVehicle').value=o.vehicleType;
  populateSlotDropdown(id);document.getElementById('fSlot').value=o.slotId;
  svcSelected=o.service.split(',').map(s=>s.trim()).filter(Boolean);buildSvcDropdownItems(o.vehicleType);updatePriceDisplay();
  document.getElementById('orderModal').classList.add('open');
}
function closeModal(id){document.getElementById(id).classList.remove('open');if(id==='orderModal')closeSvcDropdown();}
function resetForm(ro){
  ['fCustName','fPlate','fVehicle','fSlot'].forEach(id=>{const el=document.getElementById(id);if(el){el.value='';el.classList.remove('error');el.disabled=ro;}});
  document.querySelectorAll('.form-error').forEach(e=>{e.textContent='';e.classList.remove('visible');});
  document.getElementById('priceDisplay').textContent='₱0';document.getElementById('modalAlert').className='modal-alert';
  svcSelected=[];closeSvcDropdown();buildSvcDropdownItems('');setSvcDropdownDisabled(ro);
}
function showModalAlert(type,msg){const el=document.getElementById('modalAlert');el.textContent=msg;el.className='modal-alert '+type+' visible';}
function populateSlotDropdown(ex){
  const sel=document.getElementById('fSlot');sel.innerHTML='<option value="">Select slot…</option>';
  slots.forEach(s=>{if(isSlotAvailableForEdit(s.slotId,ex))sel.innerHTML+='<option value="'+s.slotId+'">'+s.slotId+' — '+s.location+'</option>';});
  if(sel.options.length===1)sel.innerHTML+='<option value="" disabled>No available slots</option>';
}
function onVehicleChange(){const v=document.getElementById('fVehicle').value;if(isMoto(v))svcSelected=svcSelected.filter(s=>!MOTO_INCOMPATIBLE.includes(s));buildSvcDropdownItems(v);updatePriceDisplay();clearErr('fVehicle','errVehicle');}
function updatePriceDisplay(){const v=document.getElementById('fVehicle').value;if(!v||!svcSelected.length){document.getElementById('priceDisplay').textContent='₱0';return;}document.getElementById('priceDisplay').textContent='₱'+svcSelected.reduce((sum,s)=>sum+getServicePrice(s,v),0).toLocaleString();}
async function saveOrder(){
  const name=document.getElementById('fCustName').value.trim(),plate=document.getElementById('fPlate').value.trim(),vehicle=document.getElementById('fVehicle').value,slotId=document.getElementById('fSlot').value,service=svcSelected.join(', ');
  let valid=true;
  if(!name){setErr('fCustName','errCustName','Customer name is required.');valid=false;}
  if(!plate){setErr('fPlate','errPlate','Plate number is required.');valid=false;}
  if(!vehicle){setErr('fVehicle','errVehicle','Vehicle type is required.');valid=false;}
  if(!svcSelected.length){document.getElementById('svcDropdownTrigger').classList.add('error');setErr('svcDropdownTrigger','errService','Please select at least one service.');valid=false;}
  if(!slotId){setErr('fSlot','errSlot','Please select an available slot.');valid=false;}
  if(valid&&slotId){const occ=getOccupiedSlotIds();const cur=editingOrderId?orders.find(o=>o.id==editingOrderId)?.slotId:null;if(occ.has(slotId)&&slotId!==cur){setErr('fSlot','errSlot','This slot is already occupied.');valid=false;}}
  if(valid&&svcSelected.length&&vehicle&&isMoto(vehicle)){const bad=svcSelected.filter(s=>MOTO_INCOMPATIBLE.includes(s));if(bad.length){document.getElementById('svcDropdownTrigger').classList.add('error');setErr('svcDropdownTrigger','errService',bad.join(', ')+' not available for motorcycles.');valid=false;}}
  if(!valid)return;
  const price=svcSelected.reduce((sum,s)=>sum+getServicePrice(s,vehicle),0);
  const payload={customerName:name,plateNumber:plate,vehicleType:vehicle,slotId,service,total:price,status:'Pending'};
  try{if(editingOrderId){await apiFetch('update_order',{...payload,id:editingOrderId});toast('success','Order updated.');}else{await apiFetch('add_order',{...payload,source:'admin'});toast('success','Order added.');}closeModal('orderModal');await refreshAll();}catch(e){toast('error','Save failed: '+e.message);}
}

function confirmDeleteOrder(id){
  const o=orders.find(x=>x.id==id);if(!o)return;
  document.getElementById('confirmTitle').textContent='Confirm Delete';document.getElementById('confirmTitle').style.color='var(--red)';
  document.getElementById('confirmBody').innerHTML='Delete order <strong>'+esc(o.refId)+'</strong> for <strong>'+esc(o.customerName)+'</strong>? This cannot be undone.';
  document.getElementById('confirmOkBtn').className='btn btn-danger';document.getElementById('confirmOkBtn').textContent='Delete';
  document.getElementById('confirmOkBtn').onclick=()=>deleteOrder(id);document.getElementById('confirmModal').classList.add('open');
}
async function deleteOrder(id){try{await apiFetch('delete_order',{id});closeModal('confirmModal');toast('success','Order deleted.');await refreshAll();}catch(e){toast('error','Delete failed: '+e.message);}}

/* ══ ADD SERVICE MODAL ══ */
function openAddServiceModal(){
  ['fSvcName','fSvcCarPrice','fSvcMotoPrice'].forEach(id=>{const el=document.getElementById(id);if(el){el.value='';el.classList.remove('error');}});
  document.getElementById('fSvcAvail').value='1';
  document.getElementById('svcModalAlert').className='modal-alert';
  document.querySelectorAll('#addServiceModal .form-error').forEach(e=>{e.textContent='';e.classList.remove('visible');});
  document.getElementById('addServiceModal').classList.add('open');
  setTimeout(()=>document.getElementById('fSvcName').focus(),100);
}
async function saveNewService(){
  const name=document.getElementById('fSvcName').value.trim();
  const carPriceRaw=document.getElementById('fSvcCarPrice').value;
  const motoPriceRaw=document.getElementById('fSvcMotoPrice').value;
  const isAvailable=parseInt(document.getElementById('fSvcAvail').value);
  let valid=true;
  if(!name){setErr('fSvcName','errSvcName','Service name is required.');valid=false;}
  else if(services.some(s=>s.name.toLowerCase()===name.toLowerCase())){setErr('fSvcName','errSvcName','A service with this name already exists.');valid=false;}
  const carPrice=parseFloat(carPriceRaw);
  if(carPriceRaw===''||isNaN(carPrice)||carPrice<0){setErr('fSvcCarPrice','errSvcCarPrice','Enter a valid price (0 or more).');valid=false;}
  const motoPrice=parseFloat(motoPriceRaw);
  if(motoPriceRaw===''||isNaN(motoPrice)||motoPrice<0){setErr('fSvcMotoPrice','errSvcMotoPrice','Enter a valid price (0 or more).');valid=false;}
  if(!valid)return;
  try{
    await apiFetch('add_service',{name,carPrice,motoPrice,isAvailable});
    toast('success','"'+name+'" added to services.');closeModal('addServiceModal');await refreshAll();
  }catch(e){const el=document.getElementById('svcModalAlert');el.textContent='Failed to create service: '+e.message;el.className='modal-alert error visible';}
}

/* ══ DELETE SERVICE ══ */
function confirmDeleteService(id){
  const s=services.find(x=>x.id==id);if(!s)return;
  document.getElementById('confirmTitle').textContent='Delete Service?';document.getElementById('confirmTitle').style.color='var(--red)';
  document.getElementById('confirmBody').innerHTML='Permanently delete <strong>'+esc(s.name)+'</strong>?<br><br>This removes it from all menus. Existing orders using this service are unaffected.';
  document.getElementById('confirmOkBtn').className='btn btn-danger';document.getElementById('confirmOkBtn').textContent='Delete Service';
  document.getElementById('confirmOkBtn').onclick=()=>doDeleteService(id);document.getElementById('confirmModal').classList.add('open');
}
async function doDeleteService(id){
  try{await apiFetch('delete_service',{id});closeModal('confirmModal');toast('success','Service deleted.');await refreshAll();}
  catch(e){toast('error','Delete failed: '+e.message);}
}

/* ══ ADD SLOT MODAL ══ */
function openAddSlotModal(){
  ['fSlotId','fSlotLocation'].forEach(id=>{const el=document.getElementById(id);if(el){el.value='';el.classList.remove('error');}});
  document.getElementById('fSlotAvail').value='1';
  document.getElementById('slotModalAlert').className='modal-alert';
  document.querySelectorAll('#addSlotModal .form-error').forEach(e=>{e.textContent='';e.classList.remove('visible');});
  document.getElementById('addSlotModal').classList.add('open');
  setTimeout(()=>document.getElementById('fSlotId').focus(),100);
}
async function saveNewSlot(){
  const slotId=document.getElementById('fSlotId').value.trim().toUpperCase();
  const location=document.getElementById('fSlotLocation').value.trim();
  const isAvailable=parseInt(document.getElementById('fSlotAvail').value);
  let valid=true;
  if(!slotId){setErr('fSlotId','errSlotId','Slot ID is required.');valid=false;}
  else if(slots.some(s=>s.slotId.toUpperCase()===slotId)){setErr('fSlotId','errSlotId','A slot with this ID already exists.');valid=false;}
  if(!location){setErr('fSlotLocation','errSlotLocation','Location label is required.');valid=false;}
  if(!valid)return;
  try{
    await apiFetch('add_slot',{slotId,location,isAvailable});
    toast('success','Slot "'+slotId+'" added successfully.');closeModal('addSlotModal');await refreshAll();
  }catch(e){const el=document.getElementById('slotModalAlert');el.textContent='Failed to create slot: '+e.message;el.className='modal-alert error visible';}
}

/* ══ DELETE SLOT ══ */
function confirmDeleteSlot(slotId){
  const s=slots.find(x=>x.slotId===slotId);if(!s)return;
  const hasActive=orders.some(o=>o.slotId===slotId&&(o.status==='Pending'||o.status==='In Progress'));
  document.getElementById('confirmTitle').textContent='Delete Slot?';document.getElementById('confirmTitle').style.color='var(--red)';
  let body='Permanently delete slot <strong>'+esc(slotId)+'</strong> ('+esc(s.location)+')?<br><br>This removes it from all slot dropdowns.';
  if(hasActive)body+='<br><br><span style="color:#fca5a5;font-weight:600;">⚠ This slot has active orders!</span>';
  document.getElementById('confirmBody').innerHTML=body;
  document.getElementById('confirmOkBtn').className='btn btn-danger';document.getElementById('confirmOkBtn').textContent='Delete Slot';
  document.getElementById('confirmOkBtn').onclick=()=>doDeleteSlot(slotId);document.getElementById('confirmModal').classList.add('open');
}
async function doDeleteSlot(slotId){
  try{await apiFetch('delete_slot',{slotId});closeModal('confirmModal');toast('success','Slot "'+slotId+'" deleted.');await refreshAll();}
  catch(e){toast('error','Delete failed: '+e.message);}
}

/* ══ SLOTS SECTION ══ */
function renderSlotsSection(filter,btn){
  currentSlotFilter=filter;
  if(btn){document.querySelectorAll('.slot-filter-btn').forEach(b=>b.classList.remove('active'));btn.classList.add('active');}
  const occupied=getOccupiedSlotIds();
  let list=slots.map(s=>({...s,_eff:s.isAvailable&&!occupied.has(s.slotId)}));
  if(filter==='available')list=list.filter(s=>s._eff);
  if(filter==='occupied')list=list.filter(s=>!s._eff);
  const allList=slots.map(s=>({...s,_eff:s.isAvailable&&!occupied.has(s.slotId)}));
  document.getElementById('slotAvailNum').textContent=allList.filter(s=>s._eff).length;
  document.getElementById('slotOccNum').textContent=allList.filter(s=>!s._eff).length;
  document.getElementById('slotTotalNum').textContent=slots.length;
  document.getElementById('slotPanelCount').textContent=slots.length;
  const grid=document.getElementById('adminSlotGrid');grid.innerHTML='';
  list.forEach((s,i)=>{
    const card=document.createElement('div');
    card.className='slot-card '+(s._eff?'av':'oc');
    card.style.animationDelay=(i*0.04)+'s';
    card.innerHTML=
      '<div class="slot-card-id">'+esc(s.slotId)+'</div>'+
      '<div class="slot-card-loc">'+esc(s.location)+'</div>'+
      '<div class="slot-card-badge"><span class="slot-badge-dot"></span>'+(s._eff?'Available':'Occupied')+'</div>'+
      '<select class="slot-card-select" data-slotid="'+s.slotId+'">'+
        '<option value="available"'+(s.isAvailable?' selected':'')+'>✓ Available</option>'+
        '<option value="occupied"'+(!s.isAvailable?' selected':'')+'>✗ Occupied</option>'+
      '</select>'+
      '<button class="btn-slot-delete" onclick="confirmDeleteSlot(\''+s.slotId+'\')" title="Delete slot">'+
        '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14H6L5 6m5 0V4h4v2"/></svg>'+
      '</button>';
    card.querySelector('select').addEventListener('change',async e=>{
      const slotId=e.target.getAttribute('data-slotid'),avail=e.target.value==='available'?1:0;
      try{await apiFetch('toggle_slot',{slotId,isAvailable:avail});const sl=slots.find(x=>x.slotId===slotId);if(sl)sl.isAvailable=!!avail;toast('success',slotId+' marked '+(avail?'Available':'Occupied'));renderSlotsSection(currentSlotFilter,null);renderDashboardSlots();}
      catch(err){toast('error','Failed: '+err.message);}
    });
    grid.appendChild(card);
  });
}

/* ══ SERVICES ADMIN ══ */
function renderServicesAdmin(){
  document.getElementById('svcCount').textContent=services.length;
  const m=document.getElementById('svcAdminMount');m.innerHTML='';
  const icons={
    'Basic Wash':'<path stroke-linecap="round" stroke-linejoin="round" d="M3 15s1-4 9-4 9 4 9 4M7 19h10M5 11c0-5 3-8 7-8s7 3 7 8"/>',
    'Premium Wash':'<path stroke-linecap="round" stroke-linejoin="round" d="M12 2l1.8 5.4H19l-4.6 3.4 1.8 5.4L12 13l-4.2 3.2 1.8-5.4L5 7.4h5.2z"/>',
    'Interior Cleaning':'<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10M4 18h6"/>',
    'Wax & Polish':'<path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
    'Engine Cleaning':'<path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/>',
    'Valet Service':'<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
    'Overnight Parking':'<path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>',
    'Tire Cleaning':'<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path stroke-linecap="round" d="M12 3v2M12 19v2M3 12h2M19 12h2"/>',
  };
  const defIcon='<circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 8v4l3 3"/>';
  if(!services.length){m.innerHTML='<div class="empty-state" style="grid-column:1/-1;padding:60px 24px;"><svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2"><circle cx="12" cy="12" r="9"/></svg><h3>No services yet.</h3><p>Click "Add Service" to create your first service.</p></div>';return;}
  services.forEach((s,i)=>{
    const card=document.createElement('div');
    card.className='svc-card'+(s.isAvailable?'':' unavailable');
    card.id='svccard_'+s.id;card.style.animationDelay=(i*0.06)+'s';
    card.innerHTML=
      '<div class="svc-card-top">'+
        '<div class="svc-card-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">'+(icons[s.name]||defIcon)+'</svg></div>'+
        '<div class="svc-card-name">'+esc(s.name)+'</div>'+
        '<label class="switch"><input type="checkbox"'+(s.isAvailable?' checked':'')+' onchange="toggleService('+s.id+',this)"><span class="slider"></span></label>'+
      '</div>'+
      '<div class="svc-card-prices">'+
        '<div class="svc-price-pill"><span class="svc-price-label">🚗 Car</span><span class="svc-price-val" id="carLbl_'+s.id+'">₱'+Number(s.carPrice).toLocaleString()+'</span></div>'+
        '<div class="svc-price-pill"><span class="svc-price-label">🏍 Moto</span><span class="svc-price-val" id="motoLbl_'+s.id+'">₱'+Number(s.motoPrice).toLocaleString()+'</span></div>'+
      '</div>'+
      '<div class="svc-card-footer">'+
        '<span class="svc-avail-label"><span class="svc-avail-dot"></span>'+(s.isAvailable?'Available':'Unavailable')+'</span>'+
        '<div class="svc-footer-btns">'+
          '<button class="btn-svc-edit" onclick="openPriceEdit('+s.id+')">✏ Edit</button>'+
          '<button class="btn-svc-delete" title="Delete service" onclick="confirmDeleteService('+s.id+')">🗑</button>'+
        '</div>'+
      '</div>'+
      '<div class="svc-edit-row" id="priceInputs_'+s.id+'">'+
        '<div class="svc-price-input-wrap"><span class="svc-price-input-lbl">Car ₱</span><input class="svc-price-inp" id="carIn_'+s.id+'" type="number" min="0" value="'+s.carPrice+'"></div>'+
        '<div class="svc-price-input-wrap"><span class="svc-price-input-lbl">Moto ₱</span><input class="svc-price-inp" id="motoIn_'+s.id+'" type="number" min="0" value="'+s.motoPrice+'"></div>'+
        '<div class="svc-edit-actions"><button class="btn-svc-save" onclick="savePrice('+s.id+')">Save</button><button class="btn-svc-cancel" onclick="closePriceEdit('+s.id+')">Cancel</button></div>'+
      '</div>';
    m.appendChild(card);
  });
}
function openPriceEdit(id){document.querySelectorAll('.svc-edit-row.open').forEach(el=>{if(el.id!=='priceInputs_'+id)el.classList.remove('open');});document.getElementById('priceInputs_'+id).classList.toggle('open');}
function closePriceEdit(id){document.getElementById('priceInputs_'+id).classList.remove('open');}
async function savePrice(id){
  const car=parseFloat(document.getElementById('carIn_'+id).value),moto=parseFloat(document.getElementById('motoIn_'+id).value);
  if(isNaN(car)||car<0||isNaN(moto)||moto<0){toast('warn','Invalid prices.');return;}
  try{
    await apiFetch('update_price',{id,carPrice:car,motoPrice:moto});
    const s=services.find(x=>x.id==id);if(s){s.carPrice=car;s.motoPrice=moto;}
    document.getElementById('carLbl_'+id).textContent='₱'+car.toLocaleString();
    document.getElementById('motoLbl_'+id).textContent='₱'+moto.toLocaleString();
    closePriceEdit(id);toast('success','Prices updated.');
  }catch(e){toast('error','Failed: '+e.message);}
}
async function toggleService(id,cb){
  const avail=cb.checked?1:0;
  try{
    await apiFetch('toggle_service',{id,isAvailable:avail});
    const s=services.find(x=>x.id==id);if(s)s.isAvailable=!!avail;
    const card=document.getElementById('svccard_'+id);
    if(card){card.classList.toggle('unavailable',!avail);const lbl=card.querySelector('.svc-avail-label');if(lbl)lbl.lastChild.textContent=avail?'Available':'Unavailable';}
  }catch(e){toast('error','Failed.');cb.checked=!cb.checked;}
}

/* ══ UTILITIES ══ */
function setErr(a,b,msg){const i=document.getElementById(a);if(i)i.classList.add('error');const e=document.getElementById(b);if(e){e.textContent=msg;e.classList.add('visible');}}
function clearErr(a,b){const i=document.getElementById(a);if(i)i.classList.remove('error');const e=document.getElementById(b);if(e){e.textContent='';e.classList.remove('visible');}}
function esc(s){return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');}
function toast(type,msg,dur=3500){
  const icons={success:'<polyline points="20 6 9 17 4 12"/>',error:'<path d="M18 6L6 18M6 6l12 12"/>',warn:'<path d="M12 9v4M12 17h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke-linecap="round"/>',info:'<circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01" stroke-linecap="round"/>'};
  const t=document.createElement('div');t.className='toast '+type;
  t.innerHTML='<div class="toast-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">'+(icons[type]||icons.info)+'</svg></div><span class="toast-msg">'+msg+'</span>';
  document.getElementById('toastContainer').appendChild(t);
  setTimeout(()=>{t.classList.add('leaving');setTimeout(()=>t.remove(),300);},dur);
}
async function refreshAll(){
  const[s,sv,o]=await Promise.all([apiFetch('get_slots'),apiFetch('get_services'),apiFetch('get_orders')]);
  slots=s.map(x=>({...x,isAvailable:!!Number(x.isAvailable)}));
  services=sv.map(x=>({...x,isAvailable:!!Number(x.isAvailable)}));
  orders=o;
  if(document.getElementById('sec-dashboard').classList.contains('active'))renderDashboard();
  if(document.getElementById('sec-orders').classList.contains('active'))renderOrdersSection();
  if(document.getElementById('sec-revenue').classList.contains('active'))renderRevenue();
  if(document.getElementById('sec-slots').classList.contains('active'))renderSlotsSection(currentSlotFilter,null);
  if(document.getElementById('sec-services').classList.contains('active'))renderServicesAdmin();
}
setInterval(refreshAll,30000);
loadAll();
</script>
</body>
</html>