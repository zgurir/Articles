<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class Select extends Component
{
public bool $valueIsCollection;

public function __construct(
    public string $name,
    public string $label,
    public Collection $list,
    public ?string $id = null,
    public string $optionsValues = 'id',
    public string $optionsTexts = 'name',
    public mixed $value = null,
    public bool $multiple = false,
    public string $help = '',
    public string $page = '',
)
{
    $this->id ??= $this->name;
    $this->handleValue();
}

protected function handleValue(): void
{
    $this->value = old($this->name) ?? $this->value;
    if (is_array($this->value)) {
        $this->value = collect($this->value);
    }
    $this->valueIsCollection = $this->value instanceof Collection;
}
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
