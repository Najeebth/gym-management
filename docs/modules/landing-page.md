# Module: Public landing page

File: `resources/views/home.blade.php`

## Status
Mixed — CMS-driven sections still work as before; new static sections added on top.

## CMS-driven (via `WebsiteService::getHome()` / `SiteSetting` key `home`)
- Hero heading/subheading/button/image
- Intro heading/text
- CTA heading/text/button
- Membership plans grid — live from `MembershipPlan` (name, price, billing interval, short_description,
  features array)

## Static / hardcoded (added 2026-08-18, not yet CMS-wired)
- "We Care About What We Offer" — 3 fixed service cards (icon + text)
- BMI calculator — client-side only (Alpine.js), no backend, not persisted. Result shown via real body
  illustrations from healthicons.org (CC0), swapped by category (Underweight/Normal/Overweight; Obese
  reuses the Overweight artwork scaled up, since healthicons has no distinct fourth tier)
- Hero "Years Experience" / "Membership Plans" stats animate 0→target on load (`countUp` Alpine component
  in `resources/js/app.js`)
- Stats band (members/trainers/classes/satisfaction) — fixed numbers
- Membership plans grid — middle plan auto-highlighted as "Most Popular" (index-based, not a DB flag)
- "Our Experienced Trainers" — 4 placeholder names, no `trainers` table exists yet
- Testimonials — 3 fixed quotes, no `testimonials` table exists yet

## Pending work
- Wire offers/trainers/testimonials/stats into the Livewire CMS editors (`app/Livewire/Admin/Website/HomeEditor.php`
  or new editors) once there's a real need to edit them without a deploy.
- Trainers and testimonials need real tables/models if this becomes more than placeholder content.
- "Most Popular" plan should become a real `is_featured` column instead of an index guess once plans are
  reordered/edited.
- BMI calculator: decide later whether to persist results against `Client` (would need a Livewire/backend
  version — see `docs/DECISIONS.md`).

## Attribution
Layout/section structure inspired by Colorlib's free "Gym" template (CC BY 3.0) — see
`docs/DECISIONS.md`. Credit line lives in `resources/views/partials/site-footer.blade.php`.
