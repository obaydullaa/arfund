<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Form;

class ArForm extends Component
{
     /**
     * Create a new component instance.
     *
     * @return void
     */
    public $identifier;
    public $identifierValue;
    public $form;
    public $formData;

    /**
     * Create a new component instance.
     */
    public function __construct(string $identifier, string $identifierValue)
    {
        $this->identifier = $identifier;
        $this->identifierValue = $identifierValue;
        $this->form = Form::where($this->identifier, $this->identifierValue)->first();
        $this->formData = $this->form ? $this->form->form_data : [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ar-form');
    }
}
