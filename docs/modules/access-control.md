# Module: Access control (roles & permissions)

Package: `spatie/laravel-permission` (v6.25). See `docs/DECISIONS.md` (2026-08-26) for why this over a
plain `role` column.

## Status
Done — `/admin/*` gated by role + permission, nav links hidden accordingly, tests cover both.

## Roles & permissions
Seeded by `database/seeders/RoleSeeder.php`:

| Role  | `manage-clients` | `manage-membership-plans` | `edit-website` |
|-------|:---:|:---:|:---:|
| admin | ✓ | ✓ | ✓ |
| staff | ✓ | | |

Both roles/permissions live in the `web` guard (the app's only guard — no API layer, see
`CLAUDE.md`).

## How a user gets a role
- `php artisan admin:create-or-update {email}` — the manual "make a real admin" command; calls
  `assignRole('admin')`.
- `DatabaseSeeder`'s local fallback (`admin@example.com`) is also assigned `admin` for fresh
  `db:seed` runs.
- No UI or command exists yet for creating a `staff` user — done ad-hoc via `tinker`
  (`$user->assignRole('staff')`) until there's a real "manage users" admin screen.

## Route gating (`routes/web.php`)
Two layers:
```
auth + role:admin|staff        → whole /admin/* group
  permission:manage-clients          → client CRUD
  permission:manage-membership-plans → admin/website/membership-plans
  permission:edit-website            → the rest of website CMS (home/about/contact/footer/nav)
```
Failing the role check or a permission check returns a 403 (Spatie's middleware), not a redirect.

Middleware aliases (`role`, `permission`, `role_or_permission`) are registered in `bootstrap/app.php`
— Spatie doesn't auto-register these for Laravel 11+'s `bootstrap/app.php`-based middleware config,
unlike the older `Kernel.php` style.

## UI gating (`resources/views/layouts/navigation.blade.php`)
"Website CMS" dropdown (desktop) and its mobile equivalent are wrapped in
`@canany(['edit-website', 'manage-membership-plans'])` so Staff never see a link to a page that would
403 them. Inside the dropdown, the Membership Plans link is separately gated on
`manage-membership-plans`, the rest on `edit-website` — so a future role holding only one of the two
permissions would see a partial menu, not all-or-nothing.

`@can`/`@canany` work here because Spatie auto-registers every DB permission name as a Laravel Gate
ability on boot (`config('permission.register_permission_check_method')`, default `true`) — no manual
`Gate::define()` calls needed.

## Known gap
`App\Livewire\Admin\EditClientName` and `EditClientPhoto` are only reachable today from pages already
behind the gated routes, but the components themselves don't re-check permissions if mounted another
way (e.g. a future API or a differently-routed page). Low risk currently; revisit if either component
gets exposed outside the existing admin client pages.

## Tests
- `tests/Feature/Admin/AccessControlTest.php` — staff blocked (403) from CMS/plan routes, allowed on
  clients/dashboard; role-less user blocked from dashboard; admin allowed everywhere.
- `tests/Feature/Admin/NavigationVisibilityTest.php` — admin sees the "Website CMS" nav link, staff
  doesn't.
- `tests/TestCase.php` adds `$this->admin()` / `$this->staff()` helpers (seed roles, create a user,
  assign the role) — use these instead of a bare `User::factory()->create()` in any test that hits a
  gated admin route.
