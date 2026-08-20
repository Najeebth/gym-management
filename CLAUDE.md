# CLAUDE.md

Gym membership CRM + admin CMS for the public site. Laravel 12, Blade, Livewire 4, Alpine, Tailwind 3,
Vite 7, Breeze auth, MySQL. No role/permission layer yet — `/admin/*` is gated by `auth` only.

Docs: `docs/ARCHITECTURE.md` (module map), `docs/DECISIONS.md` (why), `docs/modules/*.md` (per feature),
`docs/DEPLOYMENT.md` (hosting, on hold).

Rule: update the relevant `docs/` file in the same session a module changes.
