<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers\PostsRelationManager;
use App\Models\Post;
use Closure;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Spatie\FilamentMarkdownEditor\MarkdownEditor;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = "Posts";

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make()
                    ->schema([
                        TextInput::make('title')
                            ->afterStateUpdated(function (Closure $get, Closure $set, ?string $state) {
                                if (! $get('is_slug_changed_manually') && filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->reactive()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->afterStateUpdated(function (Closure $set) {
                                $set('is_slug_changed_manually', true);
                            })
                            ->required(),
                        Hidden::make('is_slug_changed_manually')
                              ->default(false)
                              ->dehydrated(false),
                        MarkdownEditor::make('summary')
                            ->required(),



                        Builder::make('content')
                            ->blocks([
                                Block::make('heading')
                                    ->schema([
                                        TextInput::make('content')
                                            ->label('Heading')
                                            ->required(),
                                        Select::make('level')
                                            ->options([
                                                'h1' => 'Heading 1',
                                                'h2' => 'Heading 2',
                                                'h3' => 'Heading 3',
                                                'h4' => 'Heading 4',
                                                'h5' => 'Heading 5',
                                                'h6' => 'Heading 6',
                                            ])
                                            ->required(),
                                    ]),
                                   Block::make('content_block')->label('Content Block')
                                        ->schema([
                                            MarkdownEditor::make('content')
                                                ->label('Paragraph')
                                                ->required(),
                                        ]),
                                   Block::make('image')
                                        ->schema([
                                            FileUpload::make('url')
                                                ->label('Image')
                                                ->image()
                                                ->required(),
                                            TextInput::make('alt')
                                                ->label('Alt text')
                                                ->required(),
                                        ]),

                                   Block::make('quote')
                                        ->schema([
                                            TextArea::make('Quote')
                                                ->label('Quote')
                                                ->required(),
                                            TextInput::make('source')
                                                ->label('Source')
                                                ->required(),
                                        ]),

                                   Block::make('hero')
                                        ->schema([
                                            FileUpload::make('url')
                                                ->label('Image')
                                                ->image()
                                                ->required(),
                                            TextInput::make('alt')
                                                ->label('Alt text')
                                                ->required(),
                                            TextInput::make('headline')
                                                ->required(),
                                            TextInput::make('sub_headline')
                                                ->label('Sub Headline'),
                                            TextInput::make('call_to_action')
                                                ->label('Call to Action'),
                                            TextInput::make('url')
                                                ->rule('url')
                                        ]),

                               ]),
                                Repeater::make('related_posts')
                                        ->schema([
                                            Select::make('related_post')
                                                ->options(Post::all()->pluck('title', 'id'))
                                                ->searchable()
                                        ])
                                        ->columns(1),

                    ])
                    ->columns(1)->columnSpan(9),

                Grid::make()
                    ->schema([
                        FileUpload::make('cover_image')
                            ->image(),
                        Select::make('author_id')
                            ->relationship('author', 'name')
                            ->required()
                            ->default('1'),
                        Select::make('status')
                            ->required()
                            ->options([
                                'Draft' => 'Draft',
                                'Published' => 'Published',
                            ])->default('Draft'),
                        Select::make('project_id')
                              ->relationship('project', 'title')
                              ->required(),
                        Select::make('series_id')
                              ->relationship('series', 'title')
                              ->required(),
                        CheckboxList::make('categories')
                              ->relationship('categories', 'title')
                              ->required(),
                        SpatieTagsInput::make('tags')



                    ])->columns(1)->columnSpan(3),


            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order', '#')
                    ->toggleable()
                    ->sortable(),

                ImageColumn::make('cover_image')->square(),
                TextColumn::make('author.name'),
                TextColumn::make('title'),
                TextColumn::make('summary'),
                TextColumn::make('status'),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
