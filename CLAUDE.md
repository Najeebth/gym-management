# CLAUDE.md

Gym membership CRM + admin CMS for the public site. Laravel 12, Blade, Livewire 4, Alpine, Tailwind 3,
Vite 7, Breeze auth, MySQL. `/admin/*` is gated by role (`admin`/`staff`) and permission via
`spatie/laravel-permission` — see `docs/modules/access-control.md`.

User-uploaded images (client photos, website CMS images) go through `App\Services\ImageUploadService`
onto `config('filesystems.uploads_disk')` — `public` (local dev) or `b2` (Backblaze B2, S3-compatible,
private bucket + signed URLs) — see `docs/DECISIONS.md` (2026-08-21).

Docs: `docs/ARCHITECTURE.md` (module map), `docs/DECISIONS.md` (why), `docs/modules/*.md` (per feature),
`docs/DEPLOYMENT.md` (hosting, on hold).

Rule: update the relevant `docs/` file in the same session a module changes.
