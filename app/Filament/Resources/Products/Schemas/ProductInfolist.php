<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Tabs::make('Product Tabs')
                    ->tabs([

                        // TAB 1 - Product Details
                        // Icon berbeda: heroicon-o-tag
                        Tab::make('Product Details')
                            ->icon('heroicon-o-tag')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('id')
                                    ->label('Product ID'),

                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('description')
                                    ->label('Product Description'),

                                TextEntry::make('created_at')
                                    ->label('Product Creation Date')
                                    ->date('d M Y')
                                    ->color('info'),
                            ]),

                        // TAB 2 - Pricing & Stock
                        // Badge dinamis dari jumlah stok, icon berbeda: heroicon-o-banknotes
                        Tab::make('Product Price and Stock')
                            ->icon('heroicon-o-banknotes')
                            ->badge(fn ($record) => $record?->stock ?? 0)
                            ->badgeColor(fn ($record) => match(true) {
                                ($record?->stock ?? 0) === 0    => 'danger',
                                ($record?->stock ?? 0) <= 5     => 'warning',
                                ($record?->stock ?? 0) <= 20    => 'info',
                                default                         => 'success',
                            })
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-s-currency-dollar'),

                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->weight('bold')
                                    ->color('primary'),
                            ]),

                        // TAB 3 - Image and Status
                        // Icon berbeda: heroicon-o-camera
                        Tab::make('Image and Status')
                            ->icon('heroicon-o-camera')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),

                                IconEntry::make('is_active')
                                    ->label('Is Active?')
                                    ->boolean(),

                                IconEntry::make('is_featured')
                                    ->label('Is Featured?')
                                    ->boolean(),
                            ]),

                    ])
                    ->columnSpanFull()
                    ->vertical(), // Tugas 3: ubah ke vertical

            ]);
    }
}