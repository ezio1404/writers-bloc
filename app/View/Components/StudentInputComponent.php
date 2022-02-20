<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentInputComponent extends Component
{
    public $title;
    public $field;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$field,$value = null)
    {
        $this->title = $title;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student-input-component');
    }
}
