<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Address;
use App\Models\Organization;
use App\Models\Person;
use Livewire\Component;
use App\Enums\USState;

class OrganizationForm extends Component
{
    public $name = '';
    public $person_ids = [];
    public $address = null; // Initialize as null for new addresses
    public $isModal = false;

    public $states = [];
    public $persons = []; // For person multi-select

    protected $rules = [
        'name' => 'required|string|max:255',
        'person_ids' => 'nullable|array',
        'person_ids.*' => 'exists:persons,id',
        'address.street' => 'nullable|string|max:255',
        'address.city' => 'nullable|string|max:255',
        'address.state' => 'nullable|string|size:2', // Assuming US state codes
        'address.zip' => 'nullable|string|max:10',
    ];

    public function mount()
    {
        // Populate states from USState enum
        $this->states = array_reduce(
            USState::cases(),
            fn($carry, $state) => $carry + [$state->name => $state->value],
            []
        );
        // Load all persons for the multi-select
        $this->persons = Person::all();
    }

    public function save()
    {
        $validated = $this->validate();

        // Create the organization
        $organization = Organization::create([
            'name' => $validated['name'],
        ]);

        // Attach selected persons (many-to-many)
        if (!empty($validated['person_ids'])) {
            $organization->persons()->sync($validated['person_ids']);
        }

        // Create address if provided
        if ($this->hasAddressInput()) {
            $address = Address::create([
                'street' => $validated['address']['street'] ?? null,
                'city' => $validated['address']['city'] ?? null,
                'state' => $validated['address']['state'] ?? null,
                'zip' => $validated['address']['zip'] ?? null,
            ]);
            $organization->address()->associate($address)->save();
        }

        $this->reset(['name', 'person_ids', 'address']); // Clear form
        $this->dispatch('organizationCreated', $organization->id);

        if ($this->isModal) {
            $this->dispatch('closeModal');
        }

        session()->flash('message', 'Organization created successfully!');
    }

    private function hasAddressInput(): bool
    {
        return !empty(array_filter($this->address ?? [], fn($value) => !is_null($value) && $value !== ''));
    }

    public function render()
    {
        return view('livewire.organization-form');
    }
}
