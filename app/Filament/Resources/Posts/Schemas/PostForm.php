<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

class PostForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                // section 1 - post details
                Section::make("Post Details")
                    ->description("Fill in the details of the post")
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        // grouping fields into 2 columns
                        Group::make([
                            // ----- TITLE -----
                            // Tugas: minimal 5 karakter, wajib diisi
                            TextInput::make("title")
                                ->required()
                                ->rules('min:5|max:100')
                                ->validationMessages([
                                    'min' => 'Judul minimal harus 5 karakter.',
                                    'required' => 'Judul wajib diisi.',
                                ]),

                            // ----- SLUG -----
                            // Tugas: unik, minimal 3 karakter, custom message
                            TextInput::make("slug")
                                ->rules('required|min:3')
                                ->unique(ignoreRecord: true)
                                ->validationMessages([
                                    'unique'   => 'Slug sudah digunakan, gunakan slug yang berbeda.',
                                    'min'      => 'Slug minimal harus 3 karakter.',
                                    'required' => 'Slug wajib diisi.',
                                ]),

                            // ----- CATEGORY -----
                            // Tugas: wajib dipilih
                            Select::make("category_id")
                                ->relationship("category", "name")
                                ->preload()
                                ->searchable()
                                ->required(),

                            // ----- COLOR -----
                            ColorPicker::make("color"),

                        ])->columns(2),

                        // ----- CONTENT -----
                        MarkdownEditor::make("content")
                            ->columnSpan(2),

                    ]),

                // section 2 - image
                Section::make("Image Upload")
                    ->schema([
                        // Tugas: image wajib diupload
                        FileUpload::make("image")
                            ->required()
                            ->disk("public")
                            ->directory("posts"),
                    ]),

            ]);
    }
}