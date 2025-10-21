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
    public $options;

    public function __construct($id, $name, $label, $url, $multiple = false, $placeholder = 'Search...', $labelKey = null, $noteType = null, $options = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->url = $url;
        $this->multiple = $multiple;
        $this->placeholder = $placeholder;
        $this->labelKey = $labelKey;
        $this->noteType = $noteType;
        $this->options = $options;
    }

    public function render()
    {
        return view('components.choices-select');
    }
}
