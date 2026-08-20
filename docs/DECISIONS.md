# Decisions

Short dated log. Format: what, why.

## 2026-08-18 — DB is MySQL, not SQLite
Framework default is SQLite; project already runs MySQL. Matters for hosting choice — rules out hosts
that can't attach a persistent MySQL DB.

## 2026-08-18 — Landing page layout adapted from Colorlib's free "Gym" template
Rebuilt in Tailwind (not copy-pasted; original is Bootstrap 4) to match project stack. License is
CC BY 3.0 — free for commercial use, attribution required, hence the credit line in the footer.
Source: https://colorlib.com/wp/template/gym/. New sections (offers, trainers) are static/hardcoded for
now, not yet wired into the Livewire CMS editors — that restructure is deferred.

## 2026-08-18 — BMI calculator is client-side (Alpine.js), not server-side
No data to protect, no lookup, just arithmetic — a server round-trip added latency for no benefit.
Alpine is already loaded (Livewire ships it), so no new dependency either. jQuery/vanilla JS were ruled
out: jQuery isn't in `package.json` and would be pure added weight; vanilla JS works but needs manual DOM
wiring that `x-model`/`x-text` already handles. Revisit with a Livewire version only if BMI history needs
to be saved against a `Client` record later.

## 2026-08-19 — BMI avatar uses healthicons.org artwork, not hand-drawn SVG
First attempt was hand-crafted SVG body shapes (bezier paths) — looked amateurish ("alien"). Switched to
inlining raw markup from Health Icons (healthicons.org, CC0/public domain, no attribution required),
which has real underweight/overweight/body illustrations made for exactly this use case. Inlined directly
as static markup (no npm package/JS dependency added, zero bundle cost) — colored via `currentColor` +
existing Tailwind text classes. No distinct "obese" icon exists upstream, so Obese reuses the Overweight
artwork scaled up slightly.

## 2026-08-18 — Hosting: Oracle Cloud Always Free VM, on hold
Considered Render/Railway (sleep or resource-capped free tiers), Hostinger/GoDaddy (fixed-term billing,
bad fit for "pause between job searches"), Hetzner/DigitalOcean (cheapest paid option if free isn't
enough later). Oracle's Always Free tier is a persistent real VM at $0, no sleep, matches the
start/stop usage pattern. Not set up yet — deferred until a module set is ready to deploy.
