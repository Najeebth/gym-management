# Decisions

Short dated log. Format: what, why.

## 2026-08-26 — Role/permission layer: spatie/laravel-permission, not a hand-rolled `role` column
Considered a plain `role` enum column on `users` — simpler, but one-to-one only, and "who can edit
membership pricing vs. who can edit the public website" needs more than two buckets long-term.
`spatie/laravel-permission` gives roles *and* granular permissions (many-to-many, polymorphic
`model_has_roles`/`model_has_permissions` pivots) for the cost of one package, and every permission
name is auto-registered as a Laravel Gate ability, so `@can`/`@canany` in Blade and the `can` route
middleware work without any custom Gate::define calls. Installed v6.25 (not the newer 8.x line — that
requires PHP ^8.3, which this environment doesn't have).

Two roles seeded (`database/seeders/RoleSeeder.php`): `admin` (all permissions) and `staff`
(`manage-clients` only) — matches the actual need (front-desk staff manage clients day-to-day; pricing
and public-site content stay admin-only). Three permissions instead of a single generic "admin access"
flag, so a future narrower role (e.g. read-only reporting) can be added without restructuring.

`/admin/*` routes are gated two levels deep: `role:admin|staff` at the group level (must be logged in
and hold a recognized admin-side role), then `permission:<name>` on specific route groups (clients vs.
website CMS vs. membership-plan pricing). Nav links use `@can`/`@canany` so Staff never see a link to a
page that would 403 them — see `docs/modules/access-control.md`.

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

## 2026-08-21 — User-uploaded images go to Backblaze B2 (S3-compatible), not local disk
Local `public` disk (used since Phase pre-1) doesn't survive a redeploy off a container, doesn't scale
past one app server, and every image request competes with the app for this VM's CPU/bandwidth/disk I/O.
Considered AWS S3 (12-month free tier only, then paid, requires a card), DigitalOcean Spaces ($5/month
flat, no free tier), Cloudflare R2 (free tier, but activating R2 requires a card on file even at $0
usage), MinIO self-hosted (free, no card, but only useful for local dev — still need real storage for
the live demo), and Backblaze B2 (10GB free forever, no card required, real S3-compatible API — usable
for both local dev and the live deploy without switching providers). Picked B2.

Bucket is **private** (public buckets require a paid plan on B2), so images are served via short-lived
signed URLs (`ImageUploadService::url()`, `Storage::disk('b2')->temporaryUrl()`), not permanent public
links — regenerated per page load. `config('filesystems.uploads_disk')` (env `UPLOADS_DISK`) switches
between `public` (local dev fallback, no B2 credentials needed) and `b2`, so the disk is swappable
without touching call sites. `storeImage`/`deleteImage` logic, previously duplicated per-service, was
pulled out into `App\Services\ImageUploadService` used by both `WebsiteService` (CMS images) and the new
client photo feature.

## 2026-08-18 — Hosting: Oracle Cloud Always Free VM, on hold
Considered Render/Railway (sleep or resource-capped free tiers), Hostinger/GoDaddy (fixed-term billing,
bad fit for "pause between job searches"), Hetzner/DigitalOcean (cheapest paid option if free isn't
enough later). Oracle's Always Free tier is a persistent real VM at $0, no sleep, matches the
start/stop usage pattern. Not set up yet — deferred until a module set is ready to deploy.
