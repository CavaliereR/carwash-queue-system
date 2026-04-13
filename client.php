<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Car Wash — Self Service</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
:root {
  --bg:        #080f1a;
  --surface:   #0d1829;
  --card:      #111e33;
  --border:    rgba(255,255,255,0.07);
  --border-hi: rgba(255,255,255,0.14);
  --cyan:      #00d4ff;
  --teal:      #00b89c;
  --amber:     #f59e0b;
  --red:       #ef4444;
  --green:     #22c55e;
  --text:      #f0f6ff;
  --muted:     #6b7fa3;
  --soft:      #a8b8d4;
  --r:         18px;
  --r-lg:      24px;
  --shadow:    0 24px 64px rgba(0,0,0,0.5);
}
* { margin:0; padding:0; box-sizing:border-box; }
body {
  font-family: 'DM Sans', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  overflow-x: hidden;
}
body::before {
  content: '';
  position: fixed; inset: 0; z-index: 0;
  background:
    radial-gradient(ellipse 800px 500px at -10% 10%, rgba(0,212,255,0.08) 0%, transparent 60%),
    radial-gradient(ellipse 600px 400px at 110% 80%, rgba(0,184,156,0.07) 0%, transparent 60%),
    radial-gradient(ellipse 400px 300px at 50% 50%, rgba(0,212,255,0.03) 0%, transparent 70%);
  pointer-events: none;
}

/* ══ Header ══ */
header {
  position: sticky; top: 0; z-index: 100;
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 28px; height: 64px;
  background: rgba(8,15,26,0.88);
  backdrop-filter: blur(16px);
  border-bottom: 1px solid var(--border);
}
.logo {
  font-family: 'Syne', sans-serif;
  font-weight: 800; font-size: 17px; letter-spacing: 0.3px;
  background: linear-gradient(90deg, var(--cyan), var(--teal));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  display: flex; align-items: center; gap: 9px;
}
.logo-icon {
  width: 30px; height: 30px;
  background: linear-gradient(135deg, var(--cyan), var(--teal));
  border-radius: 8px; display: grid; place-items: center; flex-shrink: 0;
}
.logo-icon svg { width:18px; height:18px; fill: #080f1a; }
.back-btn {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 14px; border-radius: 10px;
  border: 1px solid var(--border-hi);
  background: rgba(255,255,255,0.04); color: var(--soft);
  font-size: 13px; font-weight: 500; text-decoration: none; transition: all .2s;
}
.back-btn:hover { background: rgba(0,212,255,0.08); border-color: rgba(0,212,255,0.3); color: var(--cyan); }

/* ══ Stepper ══ */
.stepper-wrap { position: relative; z-index: 1; padding: 28px 28px 0; display: flex; justify-content: center; }
.stepper {
  display: flex; align-items: center;
  background: var(--surface); border: 1px solid var(--border);
  border-radius: 999px; padding: 6px 10px; gap: 4px;
}
.step-item {
  display: flex; align-items: center; gap: 8px; padding: 8px 14px;
  border-radius: 999px; font-size: 13px; font-weight: 500;
  color: var(--muted); transition: all .3s; white-space: nowrap; cursor: default; user-select: none;
}
.step-item .num {
  width: 24px; height: 24px; border-radius: 999px;
  background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.10);
  display: grid; place-items: center;
  font-family: 'Syne', sans-serif; font-size: 12px; font-weight: 700;
  flex-shrink: 0; transition: all .3s;
}
.step-item.active { background: rgba(0,212,255,0.10); color: var(--cyan); }
.step-item.active .num { background: var(--cyan); border-color: var(--cyan); color: #080f1a; }
.step-item.done { color: var(--teal); }
.step-item.done .num { background: rgba(0,184,156,0.2); border-color: var(--teal); color: var(--teal); }
.step-div { width: 24px; height: 1px; background: var(--border); flex-shrink: 0; }

/* ══ Screens ══ */
.screen { position: relative; z-index: 1; display: none; animation: fadeUp .35s ease both; }
.screen.visible { display: block; }
@keyframes fadeUp { from { opacity:0; transform: translateY(18px); } to { opacity:1; transform: translateY(0); } }

/* ══════════════════════════════════════
   SCREEN 1
══════════════════════════════════════ */
#s1 .inner {
  max-width: 720px; margin: 0 auto;
  padding: 48px 24px 28px; text-align: center;
}
.screen-heading {
  font-family: 'Syne', sans-serif;
  font-size: clamp(26px, 5vw, 38px); font-weight: 800;
  margin-bottom: 10px; letter-spacing: -0.5px;
}
.screen-sub { color: var(--muted); font-size: 15px; margin-bottom: 40px; }
.type-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; max-width: 560px; margin: 0 auto 40px; }
.type-card {
  background: var(--card); border: 2px solid var(--border);
  border-radius: var(--r-lg); padding: 36px 24px;
  cursor: pointer; transition: all .25s;
  display: flex; flex-direction: column; align-items: center; gap: 16px;
}
.type-card:hover { border-color: rgba(0,212,255,0.4); background: rgba(0,212,255,0.05); transform: translateY(-3px); }
.type-card.selected { border-color: var(--cyan); background: rgba(0,212,255,0.08); box-shadow: 0 0 0 4px rgba(0,212,255,0.12), var(--shadow); }
.type-icon {
  width: 80px; height: 80px; border-radius: 20px;
  background: rgba(255,255,255,0.04); border: 1px solid var(--border-hi);
  display: grid; place-items: center; transition: all .25s;
}
.type-card:hover .type-icon, .type-card.selected .type-icon { background: rgba(0,212,255,0.12); border-color: rgba(0,212,255,0.35); }
.type-icon svg { width:40px; height:40px; }
.type-label { font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 800; color: var(--text); }
.type-sub { font-size: 13px; color: var(--muted); }
.variant-section { display: none; max-width: 560px; margin: 0 auto; animation: fadeUp .3s ease both; }
.variant-section.visible { display: block; }
.variant-title { font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 700; color: var(--soft); margin-bottom: 14px; text-align: left; }
.variant-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 28px; }
.variant-btn {
  padding: 14px 10px; border-radius: var(--r); border: 1.5px solid var(--border);
  background: var(--card); color: var(--soft); font-size: 13px; font-weight: 500;
  cursor: pointer; transition: all .2s;
  display: flex; flex-direction: column; align-items: center; gap: 8px;
  font-family: 'DM Sans', sans-serif;
}
.variant-btn svg { width:28px; height:28px; opacity: 0.7; transition: opacity .2s; }
.variant-btn:hover { border-color: rgba(0,212,255,0.35); color: var(--cyan); background: rgba(0,212,255,0.05); }
.variant-btn.selected { border-color: var(--cyan); color: var(--cyan); background: rgba(0,212,255,0.10); }
.variant-btn.selected svg { opacity: 1; }

/* BONUS: S1 info strip */
.s1-info-strip {
  max-width: 720px; margin: 0 auto;
  padding: 4px 24px 48px;
  display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
}
.info-strip-card {
  background: var(--card); border: 1px solid var(--border);
  border-radius: 14px; padding: 16px;
  display: flex; align-items: center; gap: 12px;
  transition: border-color .2s;
}
.info-strip-card:hover { border-color: var(--border-hi); }
.info-strip-icon {
  width: 38px; height: 38px; border-radius: 10px;
  display: grid; place-items: center; flex-shrink: 0;
}
.info-strip-icon svg { width: 20px; height: 20px; }
.info-strip-title { font-family: 'Syne', sans-serif; font-size: 13px; font-weight: 700; margin-bottom: 2px; }
.info-strip-sub { font-size: 11px; color: var(--muted); }

/* ══════════════════════════════════════
   SCREEN 2 & 3 — two-column layout
══════════════════════════════════════ */
.screen-cols {
  display: grid;
  grid-template-columns: 1fr 296px;
  gap: 24px;
  max-width: 1080px; margin: 0 auto;
  padding: 0 24px 48px;
  align-items: start;
}
.screen-col-main { min-width: 0; }

/* ══ Order Summary Panel (FEATURE 1) ══ */
.osp {
  position: sticky; top: 80px;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--r-lg);
  overflow: hidden;
  box-shadow: 0 12px 40px rgba(0,0,0,0.35);
}
.osp-progress { padding: 14px 18px 0; }
.osp-prog-track { display: flex; gap: 4px; margin-bottom: 5px; }
.osp-prog-seg {
  flex: 1; height: 3px; border-radius: 99px;
  background: rgba(255,255,255,0.07); transition: background .35s;
}
.osp-prog-seg.done   { background: var(--teal); }
.osp-prog-seg.active { background: var(--cyan); }
.osp-prog-label { font-size: 10px; color: var(--muted); text-align: right; padding-bottom: 2px; }
.osp-head {
  padding: 14px 18px; border-bottom: 1px solid var(--border);
  background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,184,156,0.05));
  display: flex; align-items: center; gap: 9px;
}
.osp-head-icon {
  width: 28px; height: 28px; border-radius: 8px;
  background: rgba(0,212,255,0.12);
  display: grid; place-items: center; flex-shrink: 0;
}
.osp-head-icon svg { width: 14px; height: 14px; }
.osp-head-title {
  font-family: 'Syne', sans-serif; font-size: 11px; font-weight: 800;
  color: var(--cyan); text-transform: uppercase; letter-spacing: 1px;
}
.osp-body { padding: 14px 18px 4px; }
.osp-row {
  display: flex; justify-content: space-between; align-items: flex-start;
  padding: 7px 0; border-bottom: 1px solid var(--border); gap: 10px; font-size: 13px;
}
.osp-row:last-child { border-bottom: none; }
.osp-k { color: var(--muted); font-size: 11.5px; font-weight: 600; white-space: nowrap; flex-shrink: 0; padding-top: 1px; }
.osp-v { color: var(--text); font-weight: 600; text-align: right; word-break: break-word; line-height: 1.4; }
.osp-v.empty { color: var(--muted); font-weight: 400; font-style: italic; font-size: 12px; }
.osp-svc-list { list-style: none; text-align: right; }
.osp-svc-list li { font-size: 12px; color: var(--soft); padding: 2px 0; display: flex; align-items: center; justify-content: flex-end; gap: 5px; }
.osp-svc-list li::before { content: '·'; color: var(--cyan); font-size: 16px; line-height: 1; }
.osp-total-row {
  margin: 10px 18px 16px;
  padding: 12px 14px;
  background: rgba(0,212,255,0.06); border: 1px solid rgba(0,212,255,0.13);
  border-radius: 12px;
  display: flex; justify-content: space-between; align-items: center;
}
.osp-total-label { font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.6px; }
.osp-total-amount {
  font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 800;
  background: linear-gradient(90deg, var(--teal), var(--cyan));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}

/* ══════════════════════════════════════
   Shared form styles
══════════════════════════════════════ */
.field-group { margin-bottom: 18px; }
.field-group label {
  display: block; font-size: 12px; font-weight: 600;
  text-transform: uppercase; letter-spacing: 0.8px; color: var(--muted); margin-bottom: 8px;
}
.field-group input {
  width: 100%; padding: 14px 16px; border-radius: var(--r);
  border: 1.5px solid var(--border); background: var(--card);
  color: var(--text); font-family: 'DM Sans', sans-serif; font-size: 15px;
  outline: none; transition: all .2s;
}
.field-group input::placeholder { color: var(--muted); }
.field-group input:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(0,212,255,0.12); }
.field-hint { font-size: 12px; color: var(--muted); margin-top: 6px; }
.info-bar { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 28px; }
.chip {
  display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px;
  border-radius: 999px; background: rgba(0,212,255,0.08); border: 1px solid rgba(0,212,255,0.2);
  font-size: 12px; color: var(--cyan); font-weight: 500;
}

/* ── Screen 2 ── */
.top-info { padding: 40px 0 0; }
.avail-section { padding: 0; }
.avail-heading {
  font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700;
  margin-bottom: 14px; display: flex; align-items: center; gap: 10px;
}
.slot-grid {
  display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
  gap: 12px; margin-bottom: 28px;
}
.slot-tile {
  border-radius: var(--r); border: 1.5px solid;
  padding: 18px 14px; text-align: center; cursor: pointer; transition: all .2s; position: relative;
}
.slot-tile.available { border-color: rgba(34,197,94,0.3); background: rgba(34,197,94,0.06); }
.slot-tile.available:hover { border-color: var(--green); background: rgba(34,197,94,0.12); transform: translateY(-2px); }
.slot-tile.available.selected { border-color: var(--green); background: rgba(34,197,94,0.15); box-shadow: 0 0 0 3px rgba(34,197,94,0.2); }
.slot-tile.occupied { border-color: rgba(239,68,68,0.2); background: rgba(239,68,68,0.04); cursor: not-allowed; opacity: 0.55; }
.slot-id { font-family: 'Syne', sans-serif; font-size: 17px; font-weight: 800; margin-bottom: 4px; }
.slot-loc { font-size: 11px; color: var(--muted); margin-bottom: 8px; }
.slot-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 600; padding: 3px 8px; border-radius: 999px; }
.slot-badge.av { background: rgba(34,197,94,0.15); color: #86efac; }
.slot-badge.oc { background: rgba(239,68,68,0.12); color: #fca5a5; }
.slot-check { position: absolute; top: 8px; right: 8px; width: 18px; height: 18px; border-radius: 999px; background: var(--green); display: grid; place-items: center; opacity: 0; transition: opacity .2s; }
.slot-tile.selected .slot-check { opacity: 1; }
.slot-check svg { width:11px; height:11px; stroke: #fff; stroke-width: 2.5; }

/* ── Screen 3 ── */
#s3 .inner { padding: 40px 0; }
.services-list { display: flex; flex-direction: column; gap: 10px; margin-bottom: 28px; }
.svc-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 18px; border-radius: var(--r);
  border: 1.5px solid var(--border); background: var(--card);
  cursor: pointer; transition: all .2s; gap: 14px;
}
.svc-row:hover { border-color: rgba(0,212,255,0.3); background: rgba(0,212,255,0.04); }
.svc-row.selected { border-color: var(--cyan); background: rgba(0,212,255,0.07); }
.svc-info { flex: 1; }
.svc-name { font-size: 15px; font-weight: 600; margin-bottom: 2px; }
.svc-price { font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 800; color: var(--cyan); white-space: nowrap; }
.svc-check {
  width: 24px; height: 24px; border-radius: 999px;
  border: 1.5px solid var(--border-hi); background: rgba(255,255,255,0.04);
  display: grid; place-items: center; flex-shrink: 0; transition: all .2s;
}
.svc-row.selected .svc-check { background: var(--cyan); border-color: var(--cyan); }
.svc-check svg { width:13px; height:13px; stroke: #080f1a; stroke-width: 2.5; opacity:0; transition: opacity .15s; }
.svc-row.selected .svc-check svg { opacity:1; }
.total-bar {
  display: flex; align-items: center; justify-content: space-between;
  padding: 18px 20px; border-radius: var(--r);
  background: rgba(0,212,255,0.06); border: 1.5px solid rgba(0,212,255,0.2); margin-bottom: 20px;
}
.total-label { font-size: 14px; color: var(--soft); font-weight: 500; }
.total-amount { font-family: 'Syne', sans-serif; font-size: 26px; font-weight: 800; color: var(--cyan); }

/* ══════════════════════════════════════
   SCREEN 4 — Receipt
══════════════════════════════════════ */
#s4 .inner { max-width: 520px; margin: 0 auto; padding: 40px 24px 60px; }
.receipt-card {
  background: var(--card); border: 1px solid var(--border);
  border-radius: var(--r-lg); overflow: hidden; box-shadow: var(--shadow);
}
.receipt-header {
  padding: 28px 28px 24px;
  background: linear-gradient(135deg, rgba(0,212,255,0.12), rgba(0,184,156,0.10));
  border-bottom: 1px solid var(--border); text-align: center;
}
.receipt-icon {
  width: 56px; height: 56px; border-radius: 16px;
  background: linear-gradient(135deg, var(--cyan), var(--teal));
  display: grid; place-items: center; margin: 0 auto 14px;
}
.receipt-icon svg { width:28px; height:28px; fill: #080f1a; }
.receipt-title { font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 800; margin-bottom: 4px; }
.receipt-sub { font-size: 13px; color: var(--muted); }
.receipt-body { padding: 24px 28px; }
.receipt-row { display: flex; justify-content: space-between; align-items: baseline; padding: 10px 0; border-bottom: 1px solid var(--border); font-size: 14px; }
.receipt-row:last-child { border-bottom: none; }
.r-key { color: var(--muted); font-weight: 500; }
.r-val { color: var(--text); font-weight: 600; text-align: right; }
.receipt-svc-list { list-style: none; text-align: right; }
.receipt-svc-list li { font-size: 13px; color: var(--soft); }
.receipt-total-row {
  display: flex; justify-content: space-between; align-items: baseline;
  padding: 18px 28px; background: rgba(0,212,255,0.06); border-top: 1px solid rgba(0,212,255,0.15);
}
.rt-label { font-family: 'Syne', sans-serif; font-size: 14px; font-weight: 700; color: var(--soft); text-transform: uppercase; letter-spacing: 0.5px; }
.rt-amount { font-family: 'Syne', sans-serif; font-size: 28px; font-weight: 800; color: var(--cyan); }
.receipt-note { text-align: center; font-size: 13px; color: var(--muted); margin: 20px 0 0; padding: 0 8px; }

/* FEATURE 2: Print & Download buttons */
.receipt-actions {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 10px; margin-top: 18px;
}
.btn-receipt {
  display: flex; align-items: center; justify-content: center; gap: 8px;
  padding: 13px 16px; border-radius: var(--r); border: none;
  font-family: 'Syne', sans-serif; font-size: 13px; font-weight: 700;
  letter-spacing: 0.3px; cursor: pointer; transition: all .2s;
}
.btn-receipt svg { width: 15px; height: 15px; flex-shrink: 0; }
.btn-print {
  background: rgba(255,255,255,0.05);
  border: 1.5px solid var(--border-hi) !important;
  color: var(--soft);
}
.btn-print:hover { background: rgba(255,255,255,0.09); color: var(--text); transform: translateY(-1px); }
.btn-download {
  background: linear-gradient(135deg, rgba(0,184,156,0.18), rgba(0,212,255,0.13));
  border: 1.5px solid rgba(0,212,255,0.22) !important;
  color: var(--cyan);
}
.btn-download:hover { filter: brightness(1.1); transform: translateY(-1px); }

/* ══ Shared buttons ══ */
.cta {
  width: 100%; padding: 15px; border-radius: var(--r); border: none;
  cursor: pointer; font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 800;
  letter-spacing: 0.3px; transition: all .2s;
}
.cta-primary { background: linear-gradient(90deg, var(--teal), var(--cyan)); color: #080f1a; box-shadow: 0 8px 24px rgba(0,212,255,0.18); }
.cta-primary:hover { filter: brightness(1.06); transform: translateY(-1px); }
.cta-primary:active { transform: translateY(0); }
.cta-primary:disabled { opacity:.4; cursor:not-allowed; filter:none; transform:none; box-shadow:none; }
.cta-ghost { background: rgba(255,255,255,0.04); border: 1.5px solid var(--border-hi) !important; color: var(--soft); }
.cta-ghost:hover { background: rgba(255,255,255,0.07); }
.btn-row { display: flex; gap: 12px; }
.btn-row .cta { flex: 1; }
.section-label { font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 800; margin-bottom: 6px; }
.section-desc { font-size: 14px; color: var(--muted); margin-bottom: 28px; }

/* BONUS: Toast notification */
.toast-container {
  position: fixed; bottom: 26px; left: 50%; transform: translateX(-50%);
  z-index: 999; pointer-events: none;
  display: flex; flex-direction: column; align-items: center; gap: 8px;
}
.toast {
  display: inline-flex; align-items: center; gap: 9px;
  padding: 10px 18px; border-radius: 999px;
  background: var(--card); border: 1px solid var(--border-hi);
  font-size: 13px; color: var(--text); font-weight: 500;
  box-shadow: 0 8px 28px rgba(0,0,0,0.45); white-space: nowrap;
  animation: toastIn .28s ease both;
}
.toast.out { animation: toastOut .28s ease both; }
@keyframes toastIn  { from { opacity:0; transform: translateY(8px); } to { opacity:1; transform: translateY(0); } }
@keyframes toastOut { from { opacity:1; } to { opacity:0; transform: translateY(8px); } }
.toast-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
.toast-dot.success { background: var(--green); }
.toast-dot.info    { background: var(--cyan); }
.toast-dot.warn    { background: var(--amber); }

/* Print-only area */
#printArea { display: none; }
@media print {
  body > *:not(#printArea) { display: none !important; }
  #printArea {
    display: block !important; position: fixed; inset: 0;
    background: #fff; color: #111; padding: 40px;
    font-family: Arial, sans-serif; font-size: 14px;
  }
  .pr-logo { font-size: 22px; font-weight: 800; margin-bottom: 3px; }
  .pr-sub  { font-size: 12px; color: #9ca3af; margin-bottom: 24px; }
  .pr-ref  { font-size: 12px; color: #6b7280; margin-bottom: 20px; border-bottom: 1px solid #e5e7eb; padding-bottom: 16px; }
  .pr-section { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.7px; color: #9ca3af; margin: 18px 0 8px; }
  .pr-row { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #f3f4f6; }
  .pr-key { color: #6b7280; }
  .pr-val { font-weight: 600; color: #111; text-align: right; }
  .pr-svc { display: flex; justify-content: space-between; padding: 5px 0; font-size: 13px; border-bottom: 1px solid #f9fafb; }
  .pr-total { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding: 16px 20px; background: #f9fafb; border-radius: 10px; }
  .pr-total-lbl { font-size: 12px; font-weight: 700; text-transform: uppercase; color: #6b7280; letter-spacing: 0.5px; }
  .pr-total-amt { font-size: 28px; font-weight: 800; color: #111; }
  .pr-footer { text-align: center; margin-top: 28px; font-size: 12px; color: #9ca3af; }
}

/* ══ Responsive ══ */
@media (max-width: 820px) {
  .screen-cols { grid-template-columns: 1fr; padding: 0 16px 40px; }
  .osp { position: static; order: -1; }
  .osp-progress { display: none; }
}
@media (max-width: 580px) {
  .type-cards { grid-template-columns: 1fr 1fr; }
  .variant-grid { grid-template-columns: repeat(2,1fr); }
  .stepper .step-item span:not(.num) { display: none; }
  .slot-grid { grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); }
  .s1-info-strip { grid-template-columns: 1fr; }
  .receipt-actions { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<!-- Hidden print target -->
<div id="printArea"></div>

<!-- Toast container -->
<div class="toast-container" id="toastContainer"></div>

<header>
  <div class="logo">
    <div class="logo-icon">
      <svg viewBox="0 0 24 24"><path d="M19 17H5v-2l1-4h12l1 4v2zm-1.5 2a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm-11 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3zM3 9l2-4h14l2 4"/></svg>
    </div>
    Car Wash
  </div>
  <a class="back-btn" href="login.html">← Back</a>
</header>

<!-- Stepper -->
<div class="stepper-wrap">
  <div class="stepper">
    <div class="step-item active" id="st1"><span class="num">1</span><span>Vehicle</span></div>
    <div class="step-div"></div>
    <div class="step-item" id="st2"><span class="num">2</span><span>Your Info</span></div>
    <div class="step-div"></div>
    <div class="step-item" id="st3"><span class="num">3</span><span>Services</span></div>
    <div class="step-div"></div>
    <div class="step-item" id="st4"><span class="num">4</span><span>Receipt</span></div>
  </div>
</div>

<!-- ═════════════════════════════════════════
     SCREEN 1 — Vehicle Type  (original + bonus strip)
═════════════════════════════════════════ -->
<div class="screen visible" id="s1">
  <div class="inner">
    <p class="screen-heading">What are you bringing in?</p>
    <p class="screen-sub">Select your vehicle category to get started.</p>

    <div class="type-cards">
      <div class="type-card" id="tcCar" onclick="selectVehicleCategory('car')">
        <div class="type-icon">
          <svg viewBox="0 0 40 40" fill="none">
            <path d="M8 24H6v-4l3.5-8h21L34 20v4h-2" stroke="var(--cyan)" stroke-width="2" stroke-linecap="round"/>
            <rect x="7" y="20" width="26" height="8" rx="2" stroke="var(--cyan)" stroke-width="2"/>
            <circle cx="11" cy="30" r="3" stroke="var(--cyan)" stroke-width="2"/>
            <circle cx="29" cy="30" r="3" stroke="var(--cyan)" stroke-width="2"/>
            <path d="M14 12h12" stroke="var(--cyan)" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="type-label">Car</div>
        <div class="type-sub">Sedan, SUV &amp; more</div>
      </div>
      <div class="type-card" id="tcMoto" onclick="selectVehicleCategory('moto')">
        <div class="type-icon">
          <svg viewBox="0 0 40 40" fill="none">
            <circle cx="10" cy="28" r="5" stroke="var(--teal)" stroke-width="2"/>
            <circle cx="30" cy="28" r="5" stroke="var(--teal)" stroke-width="2"/>
            <path d="M10 28l6-10h8l4 6" stroke="var(--teal)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 18l2-6h4" stroke="var(--teal)" stroke-width="2" stroke-linecap="round"/>
            <path d="M24 18l6 4" stroke="var(--teal)" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="type-label">Motorcycle</div>
        <div class="type-sub">Standard &amp; big bike</div>
      </div>
    </div>

    <!-- Car variants -->
    <div class="variant-section" id="varCar">
      <div class="variant-title">Select your car type</div>
      <div class="variant-grid">
        <button class="variant-btn" data-variant="Sedan" onclick="pickVariant(this,'Sedan')">
          <svg viewBox="0 0 32 18" fill="none"><path d="M3 13H2v-3l2.5-6h21l2.5 6v3h-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><rect x="2" y="10" width="28" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/><circle cx="25" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/></svg>
          Sedan
        </button>
        <button class="variant-btn" data-variant="SUV" onclick="pickVariant(this,'SUV')">
          <svg viewBox="0 0 32 18" fill="none"><path d="M3 13H2v-4l2-5h22l2 5v4h-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><rect x="2" y="9" width="28" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/><circle cx="25" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/><path d="M4 4h24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          SUV
        </button>
        <button class="variant-btn" data-variant="Hatchback" onclick="pickVariant(this,'Hatchback')">
          <svg viewBox="0 0 32 18" fill="none"><path d="M4 13H2v-3l3-6h18l3 6v3h-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><rect x="2" y="10" width="28" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/><circle cx="25" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/></svg>
          Hatchback
        </button>
        <button class="variant-btn" data-variant="Pickup" onclick="pickVariant(this,'Pickup')">
          <svg viewBox="0 0 32 18" fill="none"><path d="M2 13V10l2-5h12l2 5h4v3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><rect x="2" y="10" width="28" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/><circle cx="25" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/></svg>
          Pickup
        </button>
        <button class="variant-btn" data-variant="Van" onclick="pickVariant(this,'Van')">
          <svg viewBox="0 0 32 18" fill="none"><rect x="2" y="4" width="28" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/><circle cx="25" cy="17" r="2" stroke="currentColor" stroke-width="1.5"/><path d="M2 10h28" stroke="currentColor" stroke-width="1.5"/></svg>
          Van
        </button>
      </div>
    </div>

    <!-- Moto variants -->
    <div class="variant-section" id="varMoto">
      <div class="variant-title">Select your motorcycle type</div>
      <div class="variant-grid">
        <button class="variant-btn" data-variant="Scooter" onclick="pickVariant(this,'Scooter')">
          <svg viewBox="0 0 32 18" fill="none"><circle cx="8" cy="14" r="4" stroke="currentColor" stroke-width="1.5"/><circle cx="24" cy="14" r="4" stroke="currentColor" stroke-width="1.5"/><path d="M8 14l4-7h8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Scooter
        </button>
        <button class="variant-btn" data-variant="Underbone" onclick="pickVariant(this,'Underbone')">
          <svg viewBox="0 0 32 18" fill="none"><circle cx="8" cy="14" r="4" stroke="currentColor" stroke-width="1.5"/><circle cx="24" cy="14" r="4" stroke="currentColor" stroke-width="1.5"/><path d="M8 14l5-8h6l5 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Underbone
        </button>
        <button class="variant-btn" data-variant="Big Bike" onclick="pickVariant(this,'Big Bike')">
          <svg viewBox="0 0 32 18" fill="none"><circle cx="7" cy="14" r="4" stroke="currentColor" stroke-width="1.5"/><circle cx="25" cy="14" r="4" stroke="currentColor" stroke-width="1.5"/><path d="M7 14l6-9h5l7 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 5l2-3h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          Big Bike
        </button>
      </div>
    </div>

    <button class="cta cta-primary" id="btnS1Next" disabled onclick="goTo(2)">Continue →</button>
  </div>

  <!-- BONUS: Info strip -->
  <div class="s1-info-strip">
    <div class="info-strip-card">
      <div class="info-strip-icon" style="background:rgba(0,212,255,0.10);">
        <svg fill="none" viewBox="0 0 24 24" stroke="var(--cyan)" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
      </div>
      <div>
        <div class="info-strip-title">Fast Service</div>
        <div class="info-strip-sub">15–30 min average wash</div>
      </div>
    </div>
    <div class="info-strip-card">
      <div class="info-strip-icon" style="background:rgba(0,184,156,0.10);">
        <svg fill="none" viewBox="0 0 24 24" stroke="var(--teal)" stroke-width="1.8" stroke-linecap="round"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
      </div>
      <div>
        <div class="info-strip-title">Quality Guaranteed</div>
        <div class="info-strip-sub">Professional products only</div>
      </div>
    </div>
    <div class="info-strip-card">
      <div class="info-strip-icon" style="background:rgba(245,158,11,0.10);">
        <svg fill="none" viewBox="0 0 24 24" stroke="var(--amber)" stroke-width="1.8" stroke-linecap="round"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
      </div>
      <div>
        <div class="info-strip-title">Top Rated</div>
        <div class="info-strip-sub">4.9 ★ customer satisfaction</div>
      </div>
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════
     SCREEN 2 — Your Info + Slot Selection
     + FEATURE 1: Order Summary panel on right
═════════════════════════════════════════ -->
<div class="screen" id="s2">
  <div class="screen-cols">

    <!-- Main column -->
    <div class="screen-col-main">
      <div class="top-info">
        <div class="section-label">Your Details</div>
        <div class="section-desc">Fill in your info, then check slot availability below.</div>

        <div class="field-group">
          <label>Customer Name <span style="color:var(--red)">*</span></label>
          <input id="fName" type="text" placeholder="e.g. Juan Dela Cruz" oninput="updateSummary()" />
        </div>
        <div class="field-group">
          <label>Vehicle Plate Number <span style="color:var(--red)">*</span></label>
          <input id="fPlate" type="text" placeholder="e.g. ABC-1234" oninput="updateSummary()" />
          <div class="field-hint">Format: ABC-1234</div>
        </div>

        <div class="info-bar" id="infoBar"></div>
        <button class="cta cta-primary" id="btnCheckSlots" onclick="checkSlots()">Check Availability</button>
      </div>

      <div class="avail-section" id="availSection" style="display:none;">
        <div style="height:28px"></div>
        <div class="avail-heading">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--cyan)" stroke-width="2" stroke-linecap="round"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 9h18M9 21V9"/></svg>
          Washing Bays
        </div>
        <div class="slot-grid" id="slotGrid"></div>
        <div class="btn-row">
          <button class="cta cta-ghost" onclick="goTo(1)">← Back</button>
          <button class="cta cta-primary" id="btnS2Next" disabled onclick="goTo(3)">Next →</button>
        </div>
      </div>
    </div>

    <!-- FEATURE 1: Order Summary Panel — Screen 2 -->
    <div class="osp" id="ospPanel2">
      <div class="osp-progress">
        <div class="osp-prog-track">
          <div class="osp-prog-seg done"></div>
          <div class="osp-prog-seg active"></div>
          <div class="osp-prog-seg"></div>
          <div class="osp-prog-seg"></div>
        </div>
        <div class="osp-prog-label">Step 2 of 4</div>
      </div>
      <div class="osp-head">
        <div class="osp-head-icon">
          <svg fill="none" viewBox="0 0 24 24" stroke="var(--cyan)" stroke-width="2" stroke-linecap="round">
            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
          </svg>
        </div>
        <div class="osp-head-title">Order Summary</div>
      </div>
      <div class="osp-body" id="summaryBody"></div>
      <div class="osp-total-row">
        <span class="osp-total-label">Total</span>
        <span class="osp-total-amount" id="summaryTotal">₱0</span>
      </div>
    </div>

  </div>
</div>

<!-- ═════════════════════════════════════════
     SCREEN 3 — Services
     + FEATURE 1: Order Summary panel on right
═════════════════════════════════════════ -->
<div class="screen" id="s3">
  <div class="screen-cols">

    <!-- Main column -->
    <div class="screen-col-main">
      <div class="inner">
        <div class="section-label">Choose Services</div>
        <div class="section-desc">Prices shown for your vehicle type. Select all that apply.</div>
        <div class="services-list" id="svcList"></div>
        <div class="total-bar">
          <span class="total-label">Total Amount</span>
          <span class="total-amount" id="totalAmt">₱0</span>
        </div>
        <div class="btn-row">
          <button class="cta cta-ghost" onclick="goTo(2)">← Back</button>
          <button class="cta cta-primary" id="btnS3Next" disabled onclick="buildReceipt()">View Receipt →</button>
        </div>
      </div>
    </div>

    <!-- FEATURE 1: Order Summary Panel — Screen 3 -->
    <div class="osp" id="ospPanel3">
      <div class="osp-progress">
        <div class="osp-prog-track">
          <div class="osp-prog-seg done"></div>
          <div class="osp-prog-seg done"></div>
          <div class="osp-prog-seg active"></div>
          <div class="osp-prog-seg"></div>
        </div>
        <div class="osp-prog-label">Step 3 of 4</div>
      </div>
      <div class="osp-head">
        <div class="osp-head-icon">
          <svg fill="none" viewBox="0 0 24 24" stroke="var(--cyan)" stroke-width="2" stroke-linecap="round">
            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
          </svg>
        </div>
        <div class="osp-head-title">Order Summary</div>
      </div>
      <div class="osp-body" id="summaryBody3"></div>
      <div class="osp-total-row">
        <span class="osp-total-label">Total</span>
        <span class="osp-total-amount" id="summaryTotal3">₱0</span>
      </div>
    </div>

  </div>
</div>

<!-- ═════════════════════════════════════════
     SCREEN 4 — Receipt
     + FEATURE 2: Print & Download buttons
═════════════════════════════════════════ -->
<div class="screen" id="s4">
  <div class="inner">
    <div class="section-label">Your Receipt</div>
    <div class="section-desc">Present this to the counter staff.</div>

    <!-- Receipt card — layout unchanged -->
    <div class="receipt-card" id="receiptCard">
      <div class="receipt-header">
        <div class="receipt-icon">
          <svg viewBox="0 0 24 24">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="#080f1a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
          </svg>
        </div>
        <div class="receipt-title">Request Submitted</div>
        <div class="receipt-sub" id="receiptId"></div>
      </div>
      <div class="receipt-body" id="receiptBody"></div>
      <div class="receipt-total-row">
        <span class="rt-label">Total</span>
        <span class="rt-amount" id="receiptTotal"></span>
      </div>
    </div>

    <div class="receipt-note">Please show this receipt to the counter staff. A team member will assist you shortly.</div>

    <!-- FEATURE 2: Print & Download — below receipt, above Done button -->
    <div class="receipt-actions">
      <button class="btn-receipt btn-print" onclick="printReceipt()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
          <rect x="6" y="14" width="12" height="8" rx="1"/>
        </svg>
        Print Receipt
      </button>
      <button class="btn-receipt btn-download" onclick="downloadReceipt()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/>
        </svg>
        Download Receipt
      </button>
    </div>

    <div style="height:16px"></div>
    <div class="btn-row">
      <button class="cta cta-ghost" onclick="goTo(3)">← Edit</button>
      <button class="cta cta-primary" onclick="submitAndReset()">Done — New Customer</button>
    </div>
  </div>
</div>

<script>
/* ════════════════════════════════════════
   API helper — unchanged
════════════════════════════════════════ */
const API = 'api.php';
async function apiFetch(action, data=null){
  const opts = data
    ? {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(data)}
    : {method:'GET'};
  const res = await fetch(`${API}?action=${action}`, opts);
  if(!res.ok) throw new Error(await res.text());
  return res.json();
}

/* ════════════════════════════════════════
   In-memory data — unchanged
════════════════════════════════════════ */
let SLOTS    = [];
let SERVICES = [];

/* ════════════════════════════════════════
   State — unchanged
════════════════════════════════════════ */
const st = {
  category: null,
  variant:  null,
  name:     '',
  plate:    '',
  slot:     null,
  services: new Set()
};

/* Receipt data for print/download */
let _receipt = {};

/* ════════════════════════════════════════
   Init — unchanged
════════════════════════════════════════ */
async function initData(){
  try {
    const [rawSlots, rawServices] = await Promise.all([
      apiFetch('get_slots'),
      apiFetch('get_services')
    ]);
    SLOTS    = rawSlots.map(s=>({...s, isAvailable:!!Number(s.isAvailable)}));
    SERVICES = rawServices
      .filter(s=>!!Number(s.isAvailable))
      .map(s=>({
        id:   Number(s.id),
        name: s.name,
        car:  Number(s.carPrice),
        moto: Number(s.motoPrice)
      }));
  } catch(e){
    console.error('Failed to load data from DB:', e);
  }
}

/* ════════════════════════════════════════
   Step navigation — unchanged + updateSummary hook
════════════════════════════════════════ */
function goTo(n) {
  [1,2,3,4].forEach(i => {
    document.getElementById('s'+i).classList.toggle('visible', i===n);
    const si = document.getElementById('st'+i);
    si.classList.remove('active','done');
    if(i===n) si.classList.add('active');
    else if(i<n) si.classList.add('done');
  });
  window.scrollTo({top:0, behavior:'smooth'});
  if(n===2) renderInfoBar();
  if(n===3) renderServices();
  updateSummary();
}

/* ════════════════════════════════════════
   Screen 1 — unchanged
════════════════════════════════════════ */
function selectVehicleCategory(cat) {
  st.category = cat;
  st.variant  = null;
  document.getElementById('tcCar').classList.toggle('selected',  cat==='car');
  document.getElementById('tcMoto').classList.toggle('selected', cat==='moto');
  document.getElementById('varCar').classList.toggle('visible',  cat==='car');
  document.getElementById('varMoto').classList.toggle('visible', cat==='moto');
  document.getElementById('btnS1Next').disabled = true;
  document.querySelectorAll('.variant-btn').forEach(b=>b.classList.remove('selected'));
}

function pickVariant(btn, v) {
  st.variant = v;
  btn.closest('.variant-grid').querySelectorAll('.variant-btn').forEach(b=>b.classList.remove('selected'));
  btn.classList.add('selected');
  document.getElementById('btnS1Next').disabled = false;
}

/* ════════════════════════════════════════
   Screen 2 — unchanged logic
════════════════════════════════════════ */
function renderInfoBar() {
  document.getElementById('infoBar').innerHTML = st.variant
    ? `<span class="chip">🚗 ${st.variant}</span><span class="chip">${st.category==='car'?'Car':'Motorcycle'}</span>`
    : '';
}

async function checkSlots() {
  const name  = document.getElementById('fName').value.trim();
  const plate = document.getElementById('fPlate').value.trim();
  if(!name || !plate) { alert('Please fill in all fields.'); return; }
  st.name  = name;
  st.plate = plate;
  st.slot  = null;
  document.getElementById('btnS2Next').disabled = true;
  document.getElementById('availSection').style.display = 'block';
  document.getElementById('slotGrid').innerHTML = '<p style="color:#94a3b8;text-align:center;padding:20px;">Loading slots…</p>';
  await renderSlots();
  document.getElementById('availSection').scrollIntoView({behavior:'smooth', block:'start'});
  updateSummary();
}

async function renderSlots() {
  try {
    const fresh = await apiFetch('get_slots');
    SLOTS = fresh.map(s=>({...s, isAvailable:!!Number(s.isAvailable)}));
  } catch(e){}
  const taken = await getTakenSlots();
  const grid  = document.getElementById('slotGrid');
  grid.innerHTML = '';
  SLOTS.forEach(s => {
    const eff  = s.isAvailable && !taken.has(s.slotId);
    const isSel = st.slot===s.slotId;
    const div  = document.createElement('div');
    div.className = 'slot-tile ' + (eff ? 'available' : 'occupied') + (isSel?' selected':'');
    div.innerHTML = `
      <div class="slot-check"><svg viewBox="0 0 14 14" fill="none"><polyline points="2,7 6,11 12,3"/></svg></div>
      <div class="slot-id">${s.slotId}</div>
      <div class="slot-loc">${s.location}</div>
      <span class="slot-badge ${eff?'av':'oc'}">${eff?'✓ Available':'✗ Occupied'}</span>
    `;
    if(eff) div.addEventListener('click', ()=>pickSlot(s.slotId));
    grid.appendChild(div);
  });
}

async function pickSlot(id) {
  st.slot = id;
  document.getElementById('btnS2Next').disabled = false;
  await renderSlots();
  updateSummary(); /* FEATURE 1: update on slot pick */
}

async function getTakenSlots() {
  try {
    const orders = await apiFetch('get_orders');
    const taken  = orders
      .filter(o=>o.status==='Pending'||o.status==='In Progress')
      .map(o=>o.slotId);
    return new Set(taken);
  } catch { return new Set(); }
}

/* ════════════════════════════════════════
   Screen 3 — unchanged logic
════════════════════════════════════════ */
function getPrice(svc) {
  return st.category==='moto' ? svc.moto : svc.car;
}

function renderServices() {
  const list = document.getElementById('svcList');
  list.innerHTML = '';
  SERVICES.forEach(s => {
    const isSel = st.services.has(s.id);
    const row   = document.createElement('div');
    row.className = 'svc-row' + (isSel?' selected':'');
    row.innerHTML = `
      <div class="svc-info">
        <div class="svc-name">${s.name}</div>
      </div>
      <div class="svc-price">₱${getPrice(s)}</div>
      <div class="svc-check">
        <svg viewBox="0 0 14 14" fill="none"><polyline points="2,7 6,11 12,3"/></svg>
      </div>
    `;
    row.addEventListener('click', ()=>toggleSvc(s.id));
    list.appendChild(row);
  });
  updateTotal();
}

function toggleSvc(id) {
  if(st.services.has(id)) st.services.delete(id);
  else st.services.add(id);
  renderServices();
  updateSummary(); /* FEATURE 1: update on service toggle */
}

function updateTotal() {
  const total = SERVICES.filter(s=>st.services.has(s.id)).reduce((sum,s)=>sum+getPrice(s),0);
  document.getElementById('totalAmt').textContent = '₱'+total;
  document.getElementById('btnS3Next').disabled = st.services.size===0;
}

/* ════════════════════════════════════════
   FEATURE 1 — Live Order Summary updater
   Syncs both summary panels (screen 2 & 3)
════════════════════════════════════════ */
function updateSummary() {
  /* Pull live typed values if inputs exist on DOM */
  const nameEl  = document.getElementById('fName');
  const plateEl = document.getElementById('fPlate');
  const liveName  = nameEl  ? nameEl.value.trim()  : st.name;
  const livePlate = plateEl ? plateEl.value.trim() : st.plate;

  const chosen = SERVICES.filter(s=>st.services.has(s.id));
  const total  = chosen.reduce((sum,s)=>sum+getPrice(s), 0);

  /* helper — renders a value or an italic placeholder */
  const v = (val, ph) => val
    ? `<span class="osp-v">${val}</span>`
    : `<span class="osp-v empty">${ph}</span>`;

  /* services sub-list */
  const svcsHtml = chosen.length
    ? `<ul class="osp-svc-list">${chosen.map(s=>`<li>${s.name}<span style="margin-left:6px;color:var(--cyan);font-weight:700;">₱${getPrice(s)}</span></li>`).join('')}</ul>`
    : `<span class="osp-v empty">None yet</span>`;

  const vehicleLabel = st.variant
    ? `${st.variant}${st.category ? ' · '+(st.category==='car'?'Car':'Motorcycle') : ''}`
    : null;

  const html = `
    <div class="osp-row">
      <span class="osp-k">Vehicle</span>
      ${v(vehicleLabel, 'Not chosen')}
    </div>
    <div class="osp-row">
      <span class="osp-k">Name</span>
      ${v(liveName, 'Not entered')}
    </div>
    <div class="osp-row">
      <span class="osp-k">Plate</span>
      ${v(livePlate, 'Not entered')}
    </div>
    <div class="osp-row">
      <span class="osp-k">Bay</span>
      ${v(st.slot, 'Not selected')}
    </div>
    <div class="osp-row" style="flex-direction:column;align-items:flex-start;gap:7px;">
      <span class="osp-k">Services</span>
      ${svcsHtml}
    </div>
  `;

  /* Write to both panels simultaneously */
  const b1 = document.getElementById('summaryBody');
  const b3 = document.getElementById('summaryBody3');
  const t1 = document.getElementById('summaryTotal');
  const t3 = document.getElementById('summaryTotal3');
  if(b1) b1.innerHTML = html;
  if(b3) b3.innerHTML = html;
  if(t1) t1.textContent = '₱' + total;
  if(t3) t3.textContent = '₱' + total;
}

/* ════════════════════════════════════════
   Screen 4: Receipt — unchanged logic
════════════════════════════════════════ */
async function buildReceipt() {
  goTo(4);
  const refId    = 'CW-' + Date.now().toString(36).toUpperCase().slice(-6);
  document.getElementById('receiptId').textContent = 'Ref: ' + refId;

  const chosen   = SERVICES.filter(s=>st.services.has(s.id));
  const total    = chosen.reduce((sum,s)=>sum+getPrice(s), 0);
  const now      = new Date().toLocaleString('en-PH',{dateStyle:'medium',timeStyle:'short'});
  const svcNames = chosen.map(s=>s.name).join(', ');

  document.getElementById('receiptBody').innerHTML = `
    <div class="receipt-row"><span class="r-key">Customer</span><span class="r-val">${st.name}</span></div>
    <div class="receipt-row"><span class="r-key">Plate Number</span><span class="r-val">${st.plate}</span></div>
    <div class="receipt-row"><span class="r-key">Vehicle Type</span><span class="r-val">${st.variant}</span></div>
    <div class="receipt-row"><span class="r-key">Washing Bay</span><span class="r-val">${st.slot}</span></div>
    <div class="receipt-row"><span class="r-key">Date &amp; Time</span><span class="r-val">${now}</span></div>
    <div class="receipt-row">
      <span class="r-key">Services</span>
      <ul class="receipt-svc-list">${chosen.map(s=>`<li>${s.name} — ₱${getPrice(s)}</li>`).join('')}</ul>
    </div>
  `;
  document.getElementById('receiptTotal').textContent = '₱' + total;

  /* Store for print / download */
  _receipt = { refId, name:st.name, plate:st.plate, vehicle:st.variant, bay:st.slot, services:chosen, total, timestamp:now };

  /* Save order to DATABASE — unchanged */
  try {
    await apiFetch('submit_kiosk_order', {
      refId,
      customerName: st.name,
      plateNumber:  st.plate,
      vehicleType:  st.variant,
      slotId:       st.slot,
      service:      svcNames,
      total,
      source:       'kiosk'
    });
    showToast('success', 'Order saved successfully!');
  } catch(e){
    console.error('Failed to save order to DB:', e);
    showToast('warn', 'Could not sync — check connection.');
  }
}

/* ════════════════════════════════════════
   FEATURE 2 — Print Receipt
════════════════════════════════════════ */
function printReceipt() {
  const d = _receipt;
  if(!d.refId) { window.print(); return; }

  const svcRows = d.services.map(s =>
    `<div class="pr-svc"><span>• ${s.name}</span><span>₱${getPrice(s)}</span></div>`
  ).join('');

  document.getElementById('printArea').innerHTML = `
    <div class="pr-logo">🚗 Car Wash Self-Service</div>
    <div class="pr-sub">Official Customer Receipt</div>
    <div class="pr-ref">
      Reference: <strong>${d.refId}</strong> &nbsp;·&nbsp; ${d.timestamp}
    </div>
    <div class="pr-section">Customer Details</div>
    <div class="pr-row"><span class="pr-key">Customer Name</span><span class="pr-val">${d.name}</span></div>
    <div class="pr-row"><span class="pr-key">Plate Number</span><span class="pr-val">${d.plate}</span></div>
    <div class="pr-row"><span class="pr-key">Vehicle Type</span><span class="pr-val">${d.vehicle}</span></div>
    <div class="pr-row"><span class="pr-key">Washing Bay</span><span class="pr-val">${d.bay}</span></div>
    <div class="pr-section">Services</div>
    ${svcRows}
    <div class="pr-total">
      <span class="pr-total-lbl">Total Amount</span>
      <span class="pr-total-amt">₱${d.total}</span>
    </div>
    <div class="pr-footer">
      Thank you for choosing Car Wash!<br>
      Please present this receipt to the counter staff.
    </div>
  `;
  window.print();
}

/* ════════════════════════════════════════
   FEATURE 2 — Download Receipt (.txt)
   Filename: carwash-receipt-[refId].txt
════════════════════════════════════════ */
function downloadReceipt() {
  const d = _receipt;
  if(!d.refId) return;

  const pad = (str, len=28) => String(str).padEnd(len, '.');
  const svcLines = d.services.map(s =>
    `  ${pad(s.name)} ₱${getPrice(s)}`
  ).join('\n');

  const txt = [
    '============================================',
    '       CAR WASH — SELF SERVICE RECEIPT',
    '============================================',
    '',
    `  Reference ID   : ${d.refId}`,
    `  Date & Time    : ${d.timestamp}`,
    '',
    '--------------------------------------------',
    '  CUSTOMER DETAILS',
    '--------------------------------------------',
    `  Customer Name  : ${d.name}`,
    `  Plate Number   : ${d.plate}`,
    `  Vehicle Type   : ${d.vehicle}`,
    `  Washing Bay    : ${d.bay}`,
    '',
    '--------------------------------------------',
    '  SERVICES',
    '--------------------------------------------',
    svcLines,
    '',
    '--------------------------------------------',
    `  TOTAL AMOUNT   : ₱${d.total}`,
    '============================================',
    '',
    '  Thank you for choosing Car Wash!',
    '  Please present this receipt to staff.',
    '',
  ].join('\n');

  const blob = new Blob([txt], {type:'text/plain;charset=utf-8'});
  const url  = URL.createObjectURL(blob);
  const a    = document.createElement('a');
  a.href     = url;
  a.download = `carwash-receipt-${d.refId}.txt`;
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
  showToast('info', `Downloaded carwash-receipt-${d.refId}.txt`);
}

/* ════════════════════════════════════════
   BONUS — Toast notification helper
════════════════════════════════════════ */
function showToast(type, msg, duration=3000) {
  const wrap  = document.getElementById('toastContainer');
  const toast = document.createElement('div');
  toast.className = 'toast';
  toast.innerHTML = `<span class="toast-dot ${type}"></span>${msg}`;
  wrap.appendChild(toast);
  setTimeout(() => {
    toast.classList.add('out');
    setTimeout(() => toast.remove(), 320);
  }, duration);
}

/* ════════════════════════════════════════
   Reset — unchanged
════════════════════════════════════════ */
function submitAndReset() {
  st.category=null; st.variant=null; st.name=''; st.plate=''; st.slot=null; st.services=new Set();
  _receipt = {};
  document.getElementById('fName').value  = '';
  document.getElementById('fPlate').value = '';
  document.getElementById('availSection').style.display = 'none';
  document.querySelectorAll('.variant-btn').forEach(b=>b.classList.remove('selected'));
  document.querySelectorAll('.type-card').forEach(c=>c.classList.remove('selected'));
  document.querySelectorAll('.variant-section').forEach(v=>v.classList.remove('visible'));
  document.getElementById('btnS1Next').disabled = true;
  goTo(1);
}

/* ── Init ── */
initData();
updateSummary();
</script>
</body>
</html>