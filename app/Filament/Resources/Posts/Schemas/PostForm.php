<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ===== GROUP KIRI (2/3 lebar) =====
                Group::make([

                    Section::make("Post Details")
                        ->description("Fill in the main details of the post")
                        ->icon("heroicon-o-document-text")
                        ->schema([

                            // 4 field utama dalam 2 kolom
                            Group::make([
                                TextInput::make("title")
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make("slug")
                                    ->required()
                                    ->maxLength(255),

                                Select::make("category_id")
                                    ->relationship("category", "name")
                                    ->preload()
                                    ->searchable()
                                    ->required(),

                                ColorPicker::make("color"),
                            ])->columns(2),

                            // Content full width
                            MarkdownEditor::make("content")
                                ->columnSpanFull(),
                        ]),

                ])->columnSpan(2),

                // ===== GROUP KANAN (1/3 lebar) =====
                Group::make([

                    Section::make("Image Upload")
                        ->description("Upload thumbnail post")
                        ->icon("heroicon-o-photo")
                        ->schema([
                            FileUpload::make("image")
                                ->disk("public")
                                ->directory("posts")
                                ->image()
                                ->imagePreviewHeight("200"),
                        ]),

                    Section::make("Meta Information")
                        ->description("Additional post metadata")
                        ->icon("heroicon-o-information-circle")
                        ->schema([
                            TagsInput::make("tags")
                                ->columnSpanFull(),

                            Checkbox::make("published")
                                ->label("Published"),

                            DateTimePicker::make("published_at")
                                ->label("Published At")
                                ->columnSpanFull(),
                        ])->columns(2),

                ])->columnSpan(1),

            ])->columns(3);
    }
}
