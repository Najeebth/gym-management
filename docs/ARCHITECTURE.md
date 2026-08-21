# Architecture

## Stack
Laravel 12 (PHP 8.2+) · Blade + Livewire 4 + Alpine.js · Tailwind CSS 3 · Vite 7 · Breeze auth (session,
no API layer) · MySQL.

## Layers
- **Controllers** (`app/Http/Controllers`) — thin, delegate to Services.
- **Services** (`app/Services`) — business logic: `MembershipPlanService`, `NavigationService`,
  `WebsiteService`, `ImageUploadService` (shared upload/delete/signed-URL logic, see `docs/DECISIONS.md`).
- **Livewire** (`app/Livewire`) — interactive admin/CMS islands: client name edit, website section editors.
- **Models** (`app/Models`) — `Client`, `MembershipPlan`, `SiteSetting`, `NavigationItem`, `User`.

## Modules (see `docs/modules/`)
| Module | Status |
|---|---|
| Client roster (CRUD, admin, profile photo) | done |
| Membership plans (CRUD, ordering) | done |
| Website CMS (home/about/contact/footer/nav editors) | done |
| Public landing page | in progress — see `modules/landing-page.md` |
| Auth | Breeze default, no roles/permissions |
| Trainers, classes, attendance, payments | not started |

## When adding a module
1. Migration + model + service (if it has logic beyond CRUD).
2. Controller/Livewire component.
3. Add a row to the table above and a `docs/modules/<name>.md` file.
4. Log any non-trivial choice in `docs/DECISIONS.md`.
