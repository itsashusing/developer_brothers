<?php

namespace App\View\Components;

use Closure;
use App\Models\Where_house;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WhereHouses extends Component
{
    public $id;
    public $class;
    public $value;
    public $query;
    public $label;
    public $name;
    public $defaultSelect;
    public $type;
    public $required;
    /**
     * Create a new component instance.
     */
    public function __construct($value, $label, $class, $id, $name, $defaultSelect, $type, $required)
    {
        $query = Where_house::query();
        if ($type !== "") {
            $query->where(array('type' => $type, 'status' => '1'));
        } else {
            $query->where('status', '1');
        }
        
        $query = $query->get();
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
        $this->label = $label;
        $this->query = $query;
        $this->defaultSelect = $defaultSelect;
        $this->required = $required;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.where-houses');
    }
}
