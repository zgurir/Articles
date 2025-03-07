<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label,
        public ?string $value = null,
        public ?string $id = null,
        public string $type ='text',
        public string $placeholder = '',
        public string $help = '',
        public string $page = '',
        )

    {
        $this->id ??= $this->name;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function isImage(): bool
    {
        return str_starts_with(Storage::mimeType($this->value), 'image/');
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
