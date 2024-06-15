<?php

namespace App\View\Components;

use App\Models\Role;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Roles extends Component
{
    public $id;
    public $class;
    public $value;
    public $query;
    public $label;
    public $name;
    public $defaultSelect;
    /**
     * Create a new component instance.
     */
    public function __construct($value, $label, $class, $id, $name, $defaultSelect)
    {
        // if ($value !== "") {
        // } else {
        //     $query = Role::where(['status' => '1'])->get();
        //     // $query = [];
        // }

        $query = Role::where(['status' => '1'])->get();
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
        return view('components.roles');
    }
}
