<?php

namespace App\View\Components;

use Closure;
use App\Models\State;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StateDropdown extends Component
{
    public $id;
    public $url;
    public $class;
    public $value;
    public $anotherId;
    public $query;
    public $label;
    public $name;
    public $nextFieldId;
    public $defaultSelect;    
    /**
     * Create a new component instance.
     */
    public function __construct($value, $anotherId, $label, $class, $id, $name, $defaultSelect, $nextFieldId, $url)
    {
        if ($value !== "") {
            $query = State::where(array('country_id' => $anotherId, 'status' => '1'))->get();
        } else {
            $query = [];
        }

        $this->id = $id;
        $this->url = $url;
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
        $this->label = $label;
        $this->query = $query;
        $this->nextFieldId = $nextFieldId;
        $this->defaultSelect = $defaultSelect;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.state-dropdown');
    }
}
