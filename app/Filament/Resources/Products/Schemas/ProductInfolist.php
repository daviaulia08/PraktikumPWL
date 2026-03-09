<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // =====================
                // SECTION: Product Info
                // =====================
                Section::make('Product Info')
                    ->description('')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->weight('bold')
                            ->color('primary'),

                        TextEntry::make('id')
                            ->label('Product ID'),

                        // Tugas 1: badge SKU dengan warna berbeda (warning)
                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('description')
                            ->label('Product Description'),

                        TextEntry::make('created_at')
                            ->label('Product Creation Date')
                            ->date('d M Y')
                            ->color('info'),
                    ])
                    ->columnSpanFull(),

                // ===========================
                // SECTION: Pricing & Stock
                // ===========================
                Section::make('Product Price and Stock')
                    ->description('')
                    ->schema([
                        // Tugas 3: format harga menjadi Rp dengan formatStateUsing()
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-currency-dollar')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                        // Tugas 2: tambahkan icon pada Stock
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-archive-box'),
                    ])
                    ->columnSpanFull(),

                // ===========================
                // SECTION: Image and Status
                // ===========================
                Section::make('Image and Status')
                    ->description('')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),

                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-currency-dollar')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-archive-box'),

                        IconEntry::make('is_active')
                            ->label('Is Active?')
                            ->boolean(),

                        IconEntry::make('is_featured')
                            ->label('Is Featured?')
                            ->boolean(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}