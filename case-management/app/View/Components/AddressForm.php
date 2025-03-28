<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class AddressForm extends Component
{
    public $address;
    public $states;

    //public function __construct($address = null, $states)
    public function __construct($address, $states)
    {
        $this->address = $address;
        $this->states = $states;
    }

    public function render()
    {
        return view('components.address-form');
    }
}
