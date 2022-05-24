<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Author;

class AuthorTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Web', 'website')
                ->sortable(),
            Column::make('Phone', 'phone')
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Author::query();
    }
}
