<?php

namespace App\Filament\Resources\Posts\Schemas;
//namespace App\Filament\Resources\Posts\Schemas\Category

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Post Details")
                    ->description("Fill in the details of the post")
                    ->icon('heroicon-o-document-text')
                    ->components([
                        Group::make([
                            TextInput::make("title")
                                ->required()
                                ->rules('min:5|max:100')
                                ->validationMessages([
                                    'min'      => 'Judul minimal harus 5 karakter.',
                                    'required' => 'Judul wajib diisi.',
                                ]),

                            TextInput::make("slug")
                                ->rules('required|min:3')
                                ->unique(ignoreRecord: true)
                                ->validationMessages([
                                    'unique'   => 'Slug sudah digunakan, gunakan slug yang berbeda.',
                                    'min'      => 'Slug minimal harus 3 karakter.',
                                    'required' => 'Slug wajib diisi.',
                                ]),

                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required()
                                ->searchable(),

                            ColorPicker::make("color"),

                        ])->columns(2),

                        MarkdownEditor::make("body")
                            ->columnSpan(2),

                    ]),

                Section::make("Image Upload")
                    ->components([
                        FileUpload::make("image")
                            ->required()
                            ->disk("public")
                            ->directory("posts"),
                    ]),

                Section::make("Meta Information")
                    ->components([
                        Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload(),
                    ]),

            ]);
    }
}
