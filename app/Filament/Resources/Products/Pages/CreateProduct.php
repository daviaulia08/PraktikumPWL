<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    /**
     * Menghilangkan default form action buttons
     * (Create, Create & create another, Cancel)
     * karena sudah digantikan oleh tombol di dalam Wizard.
     */
    protected function getFormActions(): array
    {
        return [];
    }
}