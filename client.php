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
  --bg:       #080f1a;
  --surface:  #0d1829;
  --card:     #111e33;
  --border:   rgba(255,255,255,0.07);
  --border-hi: rgba(255,255,255,0.14);

  --cyan:     #00d4ff;
  --teal:     #00b89c;
  --amber:    #f59e0b;
  --red:      #ef4444;
  --green:    #22c55e;

  --text:     #f0f6ff;
  --muted:    #6b7fa3;
  --soft:     #a8b8d4;

  --r:        18px;
  --r-lg:     24px;
  --shadow:   0 24px 64px rgba(0,0,0,0.5);
}

* { margin:0; padding:0; box-sizing:border-box; }

body {
  font-family: 'DM Sans', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  overflow-x: hidden;
}

/* ── Background mesh ── */
body::before {
  content: '';
  position: fixed; inset: 0; z-index: 0;
  background:
    radial-gradient(ellipse 800px 500px at -10% 10%, rgba(0,212,255,0.08) 0%, transparent 60%),
    radial-gradient(ellipse 600px 400px at 110% 80%, rgba(0,184,156,0.07) 0%, transparent 60%),
    radial-gradient(ellipse 400px 300px at 50% 50%, rgba(0,212,255,0.03) 0%, transparent 70%);
  pointer-events: none;
}

/* ── Header ── */
header {
  position: sticky; top: 0; z-index: 100;
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 28px;
  height: 64px;
  background: rgba(8,15,26,0.88);
  backdrop-filter: blur(16px);
  border-bottom: 1px solid var(--border);
}

.logo {
  font-family: 'Syne', sans-serif;
  font-weight: 800;
  font-size: 17px;
  letter-spacing: 0.3px;
  background: linear-gradient(90deg, var(--cyan), var(--teal));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: flex; align-items: center; gap: 9px;
}
.logo-icon {
  width: 30px; height: 30px;
  background: linear-gradient(135deg, var(--cyan), var(--teal));
  border-radius: 8px;
  display: grid; place-items: center;
  flex-shrink: 0;
}
.logo-icon svg { width:18px; height:18px; fill: #080f1a; }

.back-btn {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 14px;
  border-radius: 10px;
  border: 1px solid var(--border-hi);
  background: rgba(255,255,255,0.04);
  color: var(--soft);
  font-size: 13px; font-weight: 500;
  text-decoration: none;
  transition: all .2s;
}
.back-btn:hover { background: rgba(0,212,255,0.08); border-color: rgba(0,212,255,0.3); color: var(--cyan); }

/* ── Stepper ── */
.stepper-wrap {
  position: relative; z-index: 1;
  padding: 28px 28px 0;
  display: flex; justify-content: center;
}
.stepper {
  display: flex; align-items: center; gap: 0;
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 999px;
  padding: 6px 10px;
  gap: 4px;
}
.step-item {
  display: flex; align-items: center; gap: 8px;
  padding: 8px 14px;
  border-radius: 999px;
  font-size: 13px; font-weight: 500;
  color: var(--muted);
  transition: all .3s;
  white-space: nowrap;
  cursor: default;
  user-select: none;
}
.step-item .num {
  width: 24px; height: 24px;
  border-radius: 999px;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.10);
  display: grid; place-items: center;
  font-family: 'Syne', sans-serif;
  font-size: 12px; font-weight: 700;
  flex-shrink: 0;
  transition: all .3s;
}
.step-item.active {
  background: rgba(0,212,255,0.10);
  color: var(--cyan);
}
.step-item.active .num {
  background: var(--cyan);
  border-color: var(--cyan);
  color: #080f1a;
}
.step-item.done { color: var(--teal); }
.step-item.done .num {
  background: rgba(0,184,156,0.2);
  border-color: var(--teal);
  color: var(--teal);
}
.step-div {
  width: 24px; height: 1px;
  background: var(--border);
  flex-shrink: 0;
}

/* ── Screens ── */
.screen {
  position: relative; z-index: 1;
  display: none;
  animation: fadeUp .35s ease both;
}
.screen.visible { display: block; }

@keyframes fadeUp {
  from { opacity:0; transform: translateY(18px); }
  to   { opacity:1; transform: translateY(0); }
}

/* ── Screen 1: Vehicle Type ── */
#s1 .inner {
  max-width: 720px;
  margin: 0 auto;
  padding: 48px 24px;
  text-align: center;
}
.screen-heading {
  font-family: 'Syne', sans-serif;
  font-size: clamp(26px, 5vw, 38px);
  font-weight: 800;
  margin-bottom: 10px;
  letter-spacing: -0.5px;
}
.screen-sub {
  color: var(--muted);
  font-size: 15px;
  margin-bottom: 40px;
}

.type-cards {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  max-width: 560px;
  margin: 0 auto 40px;
}
.type-card {
  background: var(--card);
  border: 2px solid var(--border);
  border-radius: var(--r-lg);
  padding: 36px 24px;
  cursor: pointer;
  transition: all .25s;
  display: flex; flex-direction: column;
  align-items: center; gap: 16px;
}
.type-card:hover {
  border-color: rgba(0,212,255,0.4);
  background: rgba(0,212,255,0.05);
  transform: translateY(-3px);
}
.type-card.selected {
  border-color: var(--cyan);
  background: rgba(0,212,255,0.08);
  box-shadow: 0 0 0 4px rgba(0,212,255,0.12), var(--shadow);
}
.type-icon {
  width: 80px; height: 80px;
  border-radius: 20px;
  background: rgba(255,255,255,0.04);
  border: 1px solid var(--border-hi);
  display: grid; place-items: center;
  transition: all .25s;
}
.type-card:hover .type-icon, .type-card.selected .type-icon {
  background: rgba(0,212,255,0.12);
  border-color: rgba(0,212,255,0.35);
}
.type-icon svg { width:40px; height:40px; }
.type-label {
  font-family: 'Syne', sans-serif;
  font-size: 20px; font-weight: 800;
  color: var(--text);
}
.type-sub { font-size: 13px; color: var(--muted); }

/* Variant list */
.variant-section {
  display: none;
  max-width: 560px;
  margin: 0 auto;
  animation: fadeUp .3s ease both;
}
.variant-section.visible { display: block; }
.variant-title {
  font-family: 'Syne', sans-serif;
  font-size: 15px; font-weight: 700;
  color: var(--soft);
  margin-bottom: 14px;
  text-align: left;
}
.variant-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
  margin-bottom: 28px;
}
.variant-btn {
  padding: 14px 10px;
  border-radius: var(--r);
  border: 1.5px solid var(--border);
  background: var(--card);
  color: var(--soft);
  font-size: 13px; font-weight: 500;
  cursor: pointer;
  transition: all .2s;
  display: flex; flex-direction: column;
  align-items: center; gap: 8px;
  font-family: 'DM Sans', sans-serif;
}
.variant-btn svg { width:28px; height:28px; opacity: 0.7; }
.variant-btn:hover { border-color: rgba(0,212,255,0.35); color: var(--cyan); background: rgba(0,212,255,0.05); }
.variant-btn.selected { border-color: var(--cyan); color: var(--cyan); background: rgba(0,212,255,0.10); }
.variant-btn svg { transition: opacity .2s; }
.variant-btn.selected svg { opacity: 1; }

/* ── Shared form styles ── */
.form-wrap {
  max-width: 600px;
  margin: 0 auto;
  padding: 48px 24px;
}

.field-group { margin-bottom: 18px; }
.field-group label {
  display: block;
  font-size: 12px; font-weight: 600;
  text-transform: uppercase; letter-spacing: 0.8px;
  color: var(--muted);
  margin-bottom: 8px;
}
.field-group input {
  width: 100%;
  padding: 14px 16px;
  border-radius: var(--r);
  border: 1.5px solid var(--border);
  background: var(--card);
  color: var(--text);
  font-family: 'DM Sans', sans-serif;
  font-size: 15px;
  outline: none;
  transition: all .2s;
}
.field-group input::placeholder { color: var(--muted); }
.field-group input:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(0,212,255,0.12); }
.field-hint { font-size: 12px; color: var(--muted); margin-top: 6px; }

/* ── Screen 2 ── */
#s2 .top-info {
  max-width: 600px;
  margin: 0 auto;
  padding: 40px 24px 0;
}
#s2 .info-bar {
  display: flex; gap: 10px; flex-wrap: wrap;
  margin-bottom: 28px;
}
.chip {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 6px 12px;
  border-radius: 999px;
  background: rgba(0,212,255,0.08);
  border: 1px solid rgba(0,212,255,0.2);
  font-size: 12px; color: var(--cyan);
  font-weight: 500;
}

.avail-section {
  max-width: 600px; margin: 0 auto;
  padding: 0 24px 40px;
}
.avail-heading {
  font-family: 'Syne', sans-serif;
  font-size: 16px; font-weight: 700;
  margin-bottom: 14px;
  display: flex; align-items: center; gap: 10px;
}
.slot-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
  gap: 12px;
  margin-bottom: 28px;
}
.slot-tile {
  border-radius: var(--r);
  border: 1.5px solid;
  padding: 18px 14px;
  text-align: center;
  cursor: pointer;
  transition: all .2s;
  position: relative;
}
.slot-tile.available {
  border-color: rgba(34,197,94,0.3);
  background: rgba(34,197,94,0.06);
}
.slot-tile.available:hover {
  border-color: var(--green);
  background: rgba(34,197,94,0.12);
  transform: translateY(-2px);
}
.slot-tile.available.selected {
  border-color: var(--green);
  background: rgba(34,197,94,0.15);
  box-shadow: 0 0 0 3px rgba(34,197,94,0.2);
}
.slot-tile.occupied {
  border-color: rgba(239,68,68,0.2);
  background: rgba(239,68,68,0.04);
  cursor: not-allowed;
  opacity: 0.55;
}
.slot-id {
  font-family: 'Syne', sans-serif;
  font-size: 17px; font-weight: 800;
  margin-bottom: 4px;
}
.slot-loc { font-size: 11px; color: var(--muted); margin-bottom: 8px; }
.slot-badge {
  display: inline-flex; align-items: center; gap: 5px;
  font-size: 11px; font-weight: 600;
  padding: 3px 8px;
  border-radius: 999px;
}
.slot-badge.av { background: rgba(34,197,94,0.15); color: #86efac; }
.slot-badge.oc { background: rgba(239,68,68,0.12); color: #fca5a5; }
.slot-check {
  position: absolute; top: 8px; right: 8px;
  width: 18px; height: 18px;
  border-radius: 999px;
  background: var(--green);
  display: grid; place-items: center;
  opacity: 0; transition: opacity .2s;
}
.slot-tile.selected .slot-check { opacity: 1; }
.slot-check svg { width:11px; height:11px; stroke: #fff; stroke-width: 2.5; }

/* ── Screen 3: Services ── */
#s3 .inner {
  max-width: 640px;
  margin: 0 auto;
  padding: 40px 24px;
}
.services-list {
  display: flex; flex-direction: column; gap: 10px;
  margin-bottom: 28px;
}
.svc-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 18px;
  border-radius: var(--r);
  border: 1.5px solid var(--border);
  background: var(--card);
  cursor: pointer;
  transition: all .2s;
  gap: 14px;
}
.svc-row:hover { border-color: rgba(0,212,255,0.3); background: rgba(0,212,255,0.04); }
.svc-row.selected { border-color: var(--cyan); background: rgba(0,212,255,0.07); }
.svc-info { flex: 1; }
.svc-name { font-size: 15px; font-weight: 600; margin-bottom: 2px; }
.svc-price {
  font-family: 'Syne', sans-serif;
  font-size: 18px; font-weight: 800;
  color: var(--cyan);
  white-space: nowrap;
}
.svc-check {
  width: 24px; height: 24px;
  border-radius: 999px;
  border: 1.5px solid var(--border-hi);
  background: rgba(255,255,255,0.04);
  display: grid; place-items: center;
  flex-shrink: 0;
  transition: all .2s;
}
.svc-row.selected .svc-check {
  background: var(--cyan);
  border-color: var(--cyan);
}
.svc-check svg { width:13px; height:13px; stroke: #080f1a; stroke-width: 2.5; opacity:0; transition: opacity .15s; }
.svc-row.selected .svc-check svg { opacity:1; }

.total-bar {
  display: flex; align-items: center; justify-content: space-between;
  padding: 18px 20px;
  border-radius: var(--r);
  background: rgba(0,212,255,0.06);
  border: 1.5px solid rgba(0,212,255,0.2);
  margin-bottom: 20px;
}
.total-label { font-size: 14px; color: var(--soft); font-weight: 500; }
.total-amount {
  font-family: 'Syne', sans-serif;
  font-size: 26px; font-weight: 800;
  color: var(--cyan);
}

/* ── Screen 4: Receipt ── */
#s4 .inner {
  max-width: 520px;
  margin: 0 auto;
  padding: 40px 24px 60px;
}
.receipt-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--r-lg);
  overflow: hidden;
  box-shadow: var(--shadow);
}
.receipt-header {
  padding: 28px 28px 24px;
  background: linear-gradient(135deg, rgba(0,212,255,0.12), rgba(0,184,156,0.10));
  border-bottom: 1px solid var(--border);
  text-align: center;
}
.receipt-icon {
  width: 56px; height: 56px;
  border-radius: 16px;
  background: linear-gradient(135deg, var(--cyan), var(--teal));
  display: grid; place-items: center;
  margin: 0 auto 14px;
}
.receipt-icon svg { width:28px; height:28px; fill: #080f1a; }
.receipt-title {
  font-family: 'Syne', sans-serif;
  font-size: 20px; font-weight: 800;
  margin-bottom: 4px;
}
.receipt-sub { font-size: 13px; color: var(--muted); }

.receipt-body { padding: 24px 28px; }
.receipt-row {
  display: flex; justify-content: space-between; align-items: baseline;
  padding: 10px 0;
  border-bottom: 1px solid var(--border);
  font-size: 14px;
}
.receipt-row:last-child { border-bottom: none; }
.r-key { color: var(--muted); font-weight: 500; }
.r-val { color: var(--text); font-weight: 600; text-align: right; }

.receipt-svc-list { list-style: none; text-align: right; }
.receipt-svc-list li { font-size: 13px; color: var(--soft); }

.receipt-total-row {
  display: flex; justify-content: space-between; align-items: baseline;
  padding: 18px 28px;
  background: rgba(0,212,255,0.06);
  border-top: 1px solid rgba(0,212,255,0.15);
}
.rt-label {
  font-family: 'Syne', sans-serif;
  font-size: 14px; font-weight: 700;
  color: var(--soft);
  text-transform: uppercase; letter-spacing: 0.5px;
}
.rt-amount {
  font-family: 'Syne', sans-serif;
  font-size: 28px; font-weight: 800;
  color: var(--cyan);
}

.receipt-note {
  text-align: center;
  font-size: 13px; color: var(--muted);
  margin: 20px 0 0;
  padding: 0 8px;
}

/* ── Buttons ── */
.cta {
  width: 100%;
  padding: 15px;
  border-radius: var(--r);
  border: none;
  cursor: pointer;
  font-family: 'Syne', sans-serif;
  font-size: 15px; font-weight: 800;
  letter-spacing: 0.3px;
  transition: all .2s;
}
.cta-primary {
  background: linear-gradient(90deg, var(--teal), var(--cyan));
  color: #080f1a;
  box-shadow: 0 8px 24px rgba(0,212,255,0.18);
}
.cta-primary:hover { filter: brightness(1.06); transform: translateY(-1px); }
.cta-primary:active { transform: translateY(0); }
.cta-primary:disabled { opacity:.4; cursor:not-allowed; filter:none; transform:none; box-shadow:none; }

.cta-ghost {
  background: rgba(255,255,255,0.04);
  border: 1.5px solid var(--border-hi) !important;
  color: var(--soft);
  border: none;
}
.cta-ghost:hover { background: rgba(255,255,255,0.07); }

.btn-row { display: flex; gap: 12px; }
.btn-row .cta { flex: 1; }

.section-label {
  font-family: 'Syne', sans-serif;
  font-size: 22px; font-weight: 800;
  margin-bottom: 6px;
}
.section-desc { font-size: 14px; color: var(--muted); margin-bottom: 28px; }

/* ── Responsive ── */
@media (max-width: 580px) {
  .type-cards { grid-template-columns: 1fr 1fr; }
  .variant-grid { grid-template-columns: repeat(2,1fr); }
  .stepper .step-item span:not(.num) { display: none; }
  .slot-grid { grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); }
}
</style>
</head>
<body>

<header>
  <div class="logo">
    <div class="logo-icon">
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M19 17H5v-2l1-4h12l1 4v2zm-1.5 2a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm-11 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3zM3 9l2-4h14l2 4"/>
      </svg>
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

<!-- ═══════════════ SCREEN 1 ═══════════════ -->
<div class="screen visible" id="s1">
  <div class="inner">
    <p class="screen-heading">What are you bringing in?</p>
    <p class="screen-sub">Select your vehicle category to get started.</p>

    <div class="type-cards">
      <div class="type-card" id="tcCar" onclick="selectVehicleCategory('car')">
        <div class="type-icon">
          <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 24H6v-4l3.5-8h21L34 20v4h-2" stroke="var(--cyan)" stroke-width="2" stroke-linecap="round"/>
            <rect x="7" y="20" width="26" height="8" rx="2" stroke="var(--cyan)" stroke-width="2"/>
            <circle cx="11" cy="30" r="3" stroke="var(--cyan)" stroke-width="2"/>
            <circle cx="29" cy="30" r="3" stroke="var(--cyan)" stroke-width="2"/>
            <path d="M14 12h12" stroke="var(--cyan)" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="type-label">Car</div>
        <div class="type-sub">Sedan, SUV & more</div>
      </div>

      <div class="type-card" id="tcMoto" onclick="selectVehicleCategory('moto')">
        <div class="type-icon">
          <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="28" r="5" stroke="var(--teal)" stroke-width="2"/>
            <circle cx="30" cy="28" r="5" stroke="var(--teal)" stroke-width="2"/>
            <path d="M10 28l6-10h8l4 6" stroke="var(--teal)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 18l2-6h4" stroke="var(--teal)" stroke-width="2" stroke-linecap="round"/>
            <path d="M24 18l6 4" stroke="var(--teal)" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="type-label">Motorcycle</div>
        <div class="type-sub">Standard & big bike</div>
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
</div>

<!-- ═══════════════ SCREEN 2 ═══════════════ -->
<div class="screen" id="s2">
  <div class="top-info">
    <div class="section-label">Your Details</div>
    <div class="section-desc">Fill in your info, then check slot availability below.</div>

    <div class="field-group">
      <label>Customer Name <span style="color:var(--red)">*</span></label>
      <input id="fName" type="text" placeholder="e.g. Juan Dela Cruz" />
    </div>
    <div class="field-group">
      <label>Vehicle Plate Number <span style="color:var(--red)">*</span></label>
      <input id="fPlate" type="text" placeholder="e.g. ABC-1234" />
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

<!-- ═══════════════ SCREEN 3 ═══════════════ -->
<div class="screen" id="s3">
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

<!-- ═══════════════ SCREEN 4 ═══════════════ -->
<div class="screen" id="s4">
  <div class="inner">
    <div class="section-label">Your Receipt</div>
    <div class="section-desc">Present this to the counter staff.</div>

    <div class="receipt-card">
      <div class="receipt-header">
        <div class="receipt-icon">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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

    <div style="height:20px"></div>
    <div class="btn-row">
      <button class="cta cta-ghost" onclick="goTo(3)">← Edit</button>
      <button class="cta cta-primary" onclick="submitAndReset()">Done — New Customer</button>
    </div>
  </div>
</div>

<script>
/* ─── API helper ─── */
const API = 'api.php';
async function apiFetch(action, data=null){
  const opts = data
    ? {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(data)}
    : {method:'GET'};
  const res = await fetch(`${API}?action=${action}`, opts);
  if(!res.ok) throw new Error(await res.text());
  return res.json();
}

/* ─── In-memory data (loaded from DB) ─── */
let SLOTS    = [];
let SERVICES = [];

/* ─── State ─── */
const st = {
  category: null,
  variant: null,
  name: '',
  plate: '',
  slot: null,
  services: new Set()
};

/* ─── Init: load slots + services from database ─── */
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
        id: Number(s.id),
        name: s.name,
        car:  Number(s.carPrice),
        moto: Number(s.motoPrice)
      }));
  } catch(e){
    console.error('Failed to load data from DB:', e);
  }
}

/* ─── Step navigation ─── */
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
}

/* ─── Screen 1 ─── */
function selectVehicleCategory(cat) {
  st.category = cat;
  st.variant = null;
  document.getElementById('tcCar').classList.toggle('selected', cat==='car');
  document.getElementById('tcMoto').classList.toggle('selected', cat==='moto');
  document.getElementById('varCar').classList.toggle('visible', cat==='car');
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

/* ─── Screen 2 ─── */
function renderInfoBar() {
  document.getElementById('infoBar').innerHTML = st.variant
    ? `<span class="chip">🚗 ${st.variant}</span><span class="chip">${st.category==='car'?'Car':'Motorcycle'}</span>`
    : '';
}

async function checkSlots() {
  const name = document.getElementById('fName').value.trim();
  const plate = document.getElementById('fPlate').value.trim();
  if(!name || !plate) { alert('Please fill in all fields.'); return; }
  st.name = name;
  st.plate = plate;
  st.slot = null;
  document.getElementById('btnS2Next').disabled = true;
  document.getElementById('availSection').style.display = 'block';
  document.getElementById('slotGrid').innerHTML = '<p style="color:#94a3b8;text-align:center;padding:20px;">Loading slots…</p>';
  await renderSlots();
  document.getElementById('availSection').scrollIntoView({behavior:'smooth',block:'start'});
}

async function renderSlots() {
  // Re-fetch slots from DB for real-time availability
  try {
    const fresh = await apiFetch('get_slots');
    SLOTS = fresh.map(s=>({...s, isAvailable:!!Number(s.isAvailable)}));
  } catch(e){}

  const taken = await getTakenSlots();
  const grid = document.getElementById('slotGrid');
  grid.innerHTML = '';
  SLOTS.forEach(s => {
    const eff = s.isAvailable && !taken.has(s.slotId);
    const isSel = st.slot===s.slotId;
    const div = document.createElement('div');
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
}

async function getTakenSlots() {
  // Get slots occupied by active (Pending/In Progress) orders from DB
  try {
    const orders = await apiFetch('get_orders');
    const taken = orders
      .filter(o=>o.status==='Pending'||o.status==='In Progress')
      .map(o=>o.slotId);
    return new Set(taken);
  } catch { return new Set(); }
}

/* ─── Screen 3 ─── */
function getPrice(svc) {
  return st.category==='moto' ? svc.moto : svc.car;
}

function renderServices() {
  const list = document.getElementById('svcList');
  list.innerHTML = '';
  SERVICES.forEach(s => {
    const isSel = st.services.has(s.id);
    const row = document.createElement('div');
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
}

function updateTotal() {
  const total = SERVICES.filter(s=>st.services.has(s.id)).reduce((sum,s)=>sum+getPrice(s),0);
  document.getElementById('totalAmt').textContent = '₱'+total;
  document.getElementById('btnS3Next').disabled = st.services.size===0;
}

/* ─── Screen 4: Receipt ─── */
async function buildReceipt() {
  goTo(4);
  const refId = 'CW-' + Date.now().toString(36).toUpperCase().slice(-6);
  document.getElementById('receiptId').textContent = 'Ref: ' + refId;

  const chosen = SERVICES.filter(s=>st.services.has(s.id));
  const total  = chosen.reduce((sum,s)=>sum+getPrice(s),0);
  const now    = new Date().toLocaleString('en-PH',{dateStyle:'medium',timeStyle:'short'});
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
  document.getElementById('receiptTotal').textContent = '₱'+total;

  /* Save order to DATABASE */
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
  } catch(e){
    console.error('Failed to save order to DB:', e);
  }
}

function submitAndReset() {
  st.category=null; st.variant=null; st.name=''; st.plate=''; st.slot=null; st.services=new Set();
  document.getElementById('fName').value='';
  document.getElementById('fPlate').value='';
  document.getElementById('availSection').style.display='none';
  document.querySelectorAll('.variant-btn').forEach(b=>b.classList.remove('selected'));
  document.querySelectorAll('.type-card').forEach(c=>c.classList.remove('selected'));
  document.querySelectorAll('.variant-section').forEach(v=>v.classList.remove('visible'));
  document.getElementById('btnS1Next').disabled=true;
  goTo(1);
}

/* ── Init ── */
initData();
</script>
</body>
</html>