<?php

namespace App\Filament\Pages;

use Illuminate\Contracts\View\View;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $title = 'Custom Aasdasdadasd Title';

    public function getHeader(): ?View
{
    return view('filament.pages.home');
}
}