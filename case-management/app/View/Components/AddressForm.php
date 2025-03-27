<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class AddressForm extends Component
{
    public $address;

    public function __construct($address = null)
    {
        $this->address = $address; // Pass an existing address for editing, or null for creating
    }

    public function render()
    {
        return view('components.address-form');
    }
}
