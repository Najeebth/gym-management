<?php

namespace App\Services;

use App\Models\MembershipPlan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class MembershipPlanService
{
    public function allOrdered(): Collection
    {
        return MembershipPlan::ordered()->get();
    }

    public function activePlansForPublicDisplay(): Collection
    {
        return MembershipPlan::active()->ordered()->get();
    }

    public function create(array $data): MembershipPlan
    {
        $data['display_order'] ??= (MembershipPlan::max('display_order') ?? 0) + 1;

        return MembershipPlan::create($data);
    }

    public function update(MembershipPlan $plan, array $data): MembershipPlan
    {
        $plan->update($data);

        return $plan;
    }

    public function delete(MembershipPlan $plan): void
    {
        if ($plan->clients()->exists()) {
            throw new RuntimeException('This plan has clients assigned to it and cannot be deleted.');
        }

        $plan->delete();
    }

    public function toggleActive(MembershipPlan $plan): MembershipPlan
    {
        $plan->update(['is_active' => ! $plan->is_active]);

        return $plan;
    }

    public function moveUp(MembershipPlan $plan): void
    {
        $previous = MembershipPlan::where('display_order', '<', $plan->display_order)
            ->orderByDesc('display_order')
            ->first();

        $this->swapOrder($plan, $previous);
    }

    public function moveDown(MembershipPlan $plan): void
    {
        $next = MembershipPlan::where('display_order', '>', $plan->display_order)
            ->orderBy('display_order')
            ->first();

        $this->swapOrder($plan, $next);
    }

    private function swapOrder(MembershipPlan $plan, ?MembershipPlan $sibling): void
    {
        if (! $sibling) {
            return;
        }

        DB::transaction(function () use ($plan, $sibling) {
            $planOrder = $plan->display_order;
            $siblingOrder = $sibling->display_order;

            $plan->update(['display_order' => $siblingOrder]);
            $sibling->update(['display_order' => $planOrder]);
        });
    }
}
