<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;


class AuthLayout extends AbstractLayout
{
    public function __construct(
        public string $title = '',
        public string $pageTitle,
        public string $action = '',
        )
    {
        parent::__construct($title);
    }

    public function render(): View|Closure|string
    {
        return view('layouts.auth');
    }
}
