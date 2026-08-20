<?php

namespace App\Services;

use App\Models\NavigationItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NavigationService
{
    public function allOrdered(): Collection
    {
        return NavigationItem::ordered()->get();
    }

    public function activeForPublicNav(): Collection
    {
        return NavigationItem::active()->ordered()->get();
    }

    public function create(array $data): NavigationItem
    {
        $data['display_order'] ??= (NavigationItem::max('display_order') ?? 0) + 1;

        return NavigationItem::create($data);
    }

    public function update(NavigationItem $item, array $data): NavigationItem
    {
        $item->update($data);

        return $item;
    }

    public function delete(NavigationItem $item): void
    {
        $item->delete();
    }

    public function toggleActive(NavigationItem $item): NavigationItem
    {
        $item->update(['is_active' => ! $item->is_active]);

        return $item;
    }

    public function moveUp(NavigationItem $item): void
    {
        $previous = NavigationItem::where('display_order', '<', $item->display_order)
            ->orderByDesc('display_order')
            ->first();

        $this->swapOrder($item, $previous);
    }

    public function moveDown(NavigationItem $item): void
    {
        $next = NavigationItem::where('display_order', '>', $item->display_order)
            ->orderBy('display_order')
            ->first();

        $this->swapOrder($item, $next);
    }

    private function swapOrder(NavigationItem $item, ?NavigationItem $sibling): void
    {
        if (! $sibling) {
            return;
        }

        DB::transaction(function () use ($item, $sibling) {
            $itemOrder = $item->display_order;
            $siblingOrder = $sibling->display_order;

            $item->update(['display_order' => $siblingOrder]);
            $sibling->update(['display_order' => $itemOrder]);
        });
    }
}
