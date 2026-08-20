<?php

namespace App\Livewire\Admin\Website;

use App\Models\MembershipPlan;
use App\Services\MembershipPlanService;
use Livewire\Component;
use RuntimeException;

class MembershipPlanManager extends Component
{
    public bool $showModal = false;

    public ?int $editingId = null;

    public string $name = '';

    public string $price = '';

    public string $billing_interval = 'monthly';

    public ?string $duration_days = null;

    public string $short_description = '';

    public string $featuresText = '';

    public bool $is_active = true;

    public ?string $deleteError = null;

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(MembershipPlanService $membershipPlanService, int $id): void
    {
        $plan = MembershipPlan::findOrFail($id);

        $this->editingId = $plan->id;
        $this->name = $plan->name;
        $this->price = (string) $plan->price;
        $this->billing_interval = $plan->billing_interval;
        $this->duration_days = $plan->duration_days !== null ? (string) $plan->duration_days : null;
        $this->short_description = $plan->short_description ?? '';
        $this->featuresText = implode("\n", $plan->features ?? []);
        $this->is_active = $plan->is_active;

        $this->showModal = true;
    }

    public function save(MembershipPlanService $membershipPlanService): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:100', 'unique:membership_plans,name,'.$this->editingId],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_interval' => ['required', 'in:monthly,quarterly,annual,one_time'],
            'duration_days' => ['nullable', 'integer', 'min:1'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'featuresText' => ['nullable', 'string', 'max:2000'],
            'is_active' => ['boolean'],
        ]);

        $data = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'billing_interval' => $validated['billing_interval'],
            'duration_days' => $validated['duration_days'],
            'short_description' => $validated['short_description'],
            'features' => array_values(array_filter(array_map('trim', explode("\n", $validated['featuresText'] ?? '')))),
            'is_active' => $validated['is_active'],
        ];

        if ($this->editingId) {
            $membershipPlanService->update(MembershipPlan::findOrFail($this->editingId), $data);
        } else {
            $membershipPlanService->create($data);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete(MembershipPlanService $membershipPlanService, int $id): void
    {
        $this->deleteError = null;

        try {
            $membershipPlanService->delete(MembershipPlan::findOrFail($id));
        } catch (RuntimeException $e) {
            $this->deleteError = $e->getMessage();
        }
    }

    public function toggleActive(MembershipPlanService $membershipPlanService, int $id): void
    {
        $membershipPlanService->toggleActive(MembershipPlan::findOrFail($id));
    }

    public function moveUp(MembershipPlanService $membershipPlanService, int $id): void
    {
        $membershipPlanService->moveUp(MembershipPlan::findOrFail($id));
    }

    public function moveDown(MembershipPlanService $membershipPlanService, int $id): void
    {
        $membershipPlanService->moveDown(MembershipPlan::findOrFail($id));
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->name = '';
        $this->price = '';
        $this->billing_interval = 'monthly';
        $this->duration_days = null;
        $this->short_description = '';
        $this->featuresText = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function render(MembershipPlanService $membershipPlanService)
    {
        return view('livewire.admin.website.membership-plan-manager', [
            'plans' => $membershipPlanService->allOrdered(),
        ]);
    }
}
