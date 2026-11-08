<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public string $status;

    public function __construct(string $status = 'Aktif')
    {
        $this->status = $status;
    }

    public function render(): View|Closure|string
    {
        return view('components.status-badge');
    }
}
