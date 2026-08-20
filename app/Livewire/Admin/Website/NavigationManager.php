<?php

namespace App\Livewire\Admin\Website;

use App\Models\NavigationItem;
use App\Services\NavigationService;
use Livewire\Component;

class NavigationManager extends Component
{
    public string $newLabel = '';

    public string $newUrl = '';

    public array $edits = [];

    public ?int $savedId = null;

    public function mount(NavigationService $navigationService): void
    {
        $this->syncEdits($navigationService);
    }

    public function addItem(NavigationService $navigationService): void
    {
        $validated = $this->validate([
            'newLabel' => ['required', 'string', 'max:100'],
            'newUrl' => ['required', 'string', 'max:255'],
        ]);

        $navigationService->create([
            'label' => $validated['newLabel'],
            'url' => $validated['newUrl'],
        ]);

        $this->reset(['newLabel', 'newUrl']);
        $this->syncEdits($navigationService);
    }

    public function saveItem(NavigationService $navigationService, int $id): void
    {
        $this->validate([
            "edits.{$id}.label" => ['required', 'string', 'max:100'],
            "edits.{$id}.url" => ['required', 'string', 'max:255'],
        ]);

        $item = NavigationItem::findOrFail($id);
        $navigationService->update($item, $this->edits[$id]);

        $this->savedId = $id;
    }

    public function deleteItem(NavigationService $navigationService, int $id): void
    {
        $item = NavigationItem::findOrFail($id);
        $navigationService->delete($item);
        $this->syncEdits($navigationService);
    }

    public function toggleActive(NavigationService $navigationService, int $id): void
    {
        $item = NavigationItem::findOrFail($id);
        $navigationService->toggleActive($item);
        $this->syncEdits($navigationService);
    }

    public function moveUp(NavigationService $navigationService, int $id): void
    {
        $item = NavigationItem::findOrFail($id);
        $navigationService->moveUp($item);
        $this->syncEdits($navigationService);
    }

    public function moveDown(NavigationService $navigationService, int $id): void
    {
        $item = NavigationItem::findOrFail($id);
        $navigationService->moveDown($item);
        $this->syncEdits($navigationService);
    }

    private function syncEdits(NavigationService $navigationService): void
    {
        $this->edits = $navigationService->allOrdered()
            ->mapWithKeys(fn (NavigationItem $item) => [
                $item->id => ['label' => $item->label, 'url' => $item->url],
            ])
            ->toArray();
    }

    public function render(NavigationService $navigationService)
    {
        return view('livewire.admin.website.navigation-manager', [
            'items' => $navigationService->allOrdered(),
        ]);
    }
}
