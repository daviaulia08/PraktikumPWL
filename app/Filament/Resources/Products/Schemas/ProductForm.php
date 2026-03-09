<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    // STEP 1 - icon: information-circle
                    Step::make('Product Info')
                        ->description('Isi Informasi Produk')
                        ->icon('heroicon-o-information-circle') // TUGAS 1
                        ->schema([
                            Group::make([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('sku')
                                    ->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description'),
                        ]),

                    // STEP 2 - icon: currency-dollar
                    Step::make('Product Price and Stock')
                        ->description('Isi Harga Produk')
                        ->icon('heroicon-o-currency-dollar') // TUGAS 1
                        ->schema([
                            Group::make([
                                TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1) // TUGAS 2: harga > 0
                                    ->validationMessages([
                                        'min' => 'Harga harus lebih dari 0.',
                                    ]),
                                TextInput::make('stock')
                                    ->numeric()
                                    ->required(),
                            ])->columns(2),
                        ]),

                    // STEP 3 - icon: photo
                    Step::make('Media and status')
                        ->description('Isi Gambar Produk')
                        ->icon('heroicon-o-photo') // TUGAS 1
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('products'),
                            Checkbox::make('is_active'),
                            Checkbox::make('is_featured'),
                        ]),

                ])
                ->columnSpanFull()
                ->submitAction(
                    Action::make('save')
                        ->label('Save Product')
                        ->button()
                        ->color('primary')
                        ->submit('save')
                ),
            ]);
    }
}