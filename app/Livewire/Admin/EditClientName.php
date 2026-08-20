<?php

namespace App\Livewire\Admin;

use App\Models\Client;
use Livewire\Component;

class EditClientName extends Component
{
    public Client $client;
    public string $first_name;
    public string $last_name;
    public bool $saved = false;
    public int $saveVersion = 0;

    public function mount(Client $client): void
    {
        $this->client = $client;
        $this->first_name = $client->first_name;
        $this->last_name = $client->last_name;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
        ]);

        $this->client->update($validated);
        $this->saved = true;
        $this->saveVersion++;
    }

    public function render()
    {
        return view('livewire.admin.edit-client-name');
    }
}
