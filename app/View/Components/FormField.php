<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormField extends Component
{
    public $type;
    public $name;
    public $label;
    public $value;
    public $isTextarea;
   /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $label
     * @param string $type
     * @param string|null $value
     * @param bool $isTextarea
     */
    public function __construct($name, $label, $type = 'text', $value = null, $isTextarea = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->isTextarea = $isTextarea;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.form-field');
    }
}
