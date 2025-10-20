<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChoicesSelect extends Component
{
    public $id;
    public $name;
    public $label;
    public $url;
    public $multiple;
    public $placeholder;
    public $labelKey;
    public $noteType;

    public function __construct($id, $name, $label, $url, $multiple = false, $placeholder = 'Search...', $labelKey = null, $noteType = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->url = $url;
        $this->multiple = $multiple;
        $this->placeholder = $placeholder;
        $this->labelKey = $labelKey;
        $this->noteType = $noteType;
    }

    public function render()
    {
        return view('components.choices-select');
    }
}
