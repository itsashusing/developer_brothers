<?php

namespace App\View\Components;

use Closure;
use App\Models\Pincode;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PincodeDropdown extends Component
{
    public $id;
    public $class;
    public $value;
    public $anotherId;
    public $query;
    public $label;
    public $name;
    public $defaultSelect;
    /**
     * Create a new component instance.
     */
    public function __construct($value, $anotherId, $label, $class, $id, $name, $defaultSelect)
    {
        if ($value !== "") {
            $query = Pincode::where(['city_id' => $anotherId, 'status' => '1'])->get();
        } else {
            $query = [];
        }
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
        $this->value = $value;
        $this->label = $label;
        $this->query = $query;
        $this->defaultSelect = $defaultSelect;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pincode-dropdown');
    }
}
