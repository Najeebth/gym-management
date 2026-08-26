# Roadmap

Goal: portfolio/showcase build — feature-complete on a defined scope, tested, deployed live with a
seeded dataset large enough to prove it isn't a toy, documented like a real product. Not aimed at
multi-tenant SaaS or OSS community growth (see `docs/DECISIONS.md` for related calls).

Estimated total: ~16–24 working days solo (~4–5 weeks part-time, ~3 weeks full-time).

## Execution order
Phase 0 → 1 → 2 → 4 → 5 → 6 → 3 → 7 → 8. Payments (3) is pushed late and is the first thing to cut
if time runs short; everything else is either a dependency or a portfolio-critical signal.

## Phases

### Phase 0 — Git & repo hygiene (0.5 day)
- `git init`, initial commit, verify `.env`/`vendor`/`node_modules` stay untracked.
- Push to a public GitHub repo.
- Branch protection once CI exists (Phase 6).

### Phase 1 — Access control (1–2 days)
- Role/permission layer (`spatie/laravel-permission`) — Admin vs Staff at minimum.
- Gate `/admin/*` by role, not just `auth`.
- Do this before other modules so "who can do this" isn't bolted on per-feature later.
- After roles are in: WhatsApp message confirmation on client creation, via WhatsApp Business Cloud
  API test/sandbox account (free, no billing — 5 verified test recipients). `App\Services\WhatsAppService`
  wraps the Graph API `POST /{phone_number_id}/messages` call, fired from client creation, fail-soft
  (logged, doesn't block creation) since sandbox credentials won't exist in every environment. See
  `docs/modules/whatsapp-notifications.md` (to be created) for setup + sandbox limitations.

### Phase 2 — Trainers → Classes → Attendance (4–6 days)
- Migrations/models/services following the existing pattern (`docs/ARCHITECTURE.md`).
- Trainer CRUD, Class CRUD (linked to trainer + schedule), Attendance check-in flow (Livewire).
- Proves the app does more than CRUD — attendance is the real "complex data" surface.

### Phase 3 — Payments, light version (2–3 days)
- Stripe test-mode checkout tied to a membership plan, `payments` table, simple admin ledger view.
- Deliberately scoped light — full billing (invoicing/refunds/dunning) is out of scope for this goal.

### Phase 4 — Landing page CMS completion (1–2 days)
- Wire hardcoded offers/trainers sections (`docs/modules/landing-page.md`) into the existing Livewire
  CMS editors so the whole site is admin-editable.

### Phase 5 — Data at scale + performance (2–3 days)
The "handles complex data at ease" phase — this is what sells the live demo.
- Factory-based seeder: thousands of clients, hundreds of classes, tens of thousands of attendance rows.
- DB indexes on actually-queried/filtered columns.
- Audit every list view for N+1s / eager loading.
- Pagination everywhere lists exist.
- Dashboard aggregate queries (attendance trend, revenue by month) — visual proof, not just row count.

### Phase 6 — Tests + CI (2–3 days)
- Fill test gaps: membership plans, website CMS, trainers/classes/attendance, payments.
- GitHub Actions: `composer test`, Pint, Larastan on push/PR.
- CI status badge on README.

### Phase 7 — Deploy (1–2 days)
- Oracle Cloud Always Free VM (see `docs/DECISIONS.md`), HTTPS via Let's Encrypt.
- Run Phase 5 seeder for demo data; scheduled "reset demo data" task so visitor edits don't degrade it.

### Phase 8 — Case-study README + polish (1–2 days)
- Replace default Laravel README: problem statement, screenshots/GIF, architecture diagram, tech
  stack, live demo link, "what I'd do differently at scale."
- UI polish pass: empty states, error pages.

## Status
- [x] Phase 0
- [ ] Phase 1 — access control done, WhatsApp confirmation still pending
- [ ] Phase 2
- [ ] Phase 3
- [ ] Phase 4
- [ ] Phase 5
- [ ] Phase 6
- [ ] Phase 7
- [ ] Phase 8
