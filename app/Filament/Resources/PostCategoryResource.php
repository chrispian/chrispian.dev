<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostCategoryResource\Pages;
use App\Filament\Resources\PostCategoryResource\RelationManagers;
use App\Models\PostCategory;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class PostCategoryResource extends Resource
{
    protected static ?string $model = PostCategory::class;

    protected static ?string $navigationGroup = "Posts";

    protected static ?string $label = 'Categories';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->afterStateUpdated(function (Closure $get, Closure $set, ?string $state) {
                        if (! $get('is_slug_changed_manually') && filled($state)) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->reactive()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->afterStateUpdated(function (Closure $set) {
                        $set('is_slug_changed_manually', true);
                    })
                    ->maxLength(255),
                Hidden::make('is_slug_changed_manually')
                      ->default(false)
                      ->dehydrated(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('slug'),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime(),
            ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPostCategories::route('/'),
            'create' => Pages\CreatePostCategory::route('/create'),
            'edit' => Pages\EditPostCategory::route('/{record}/edit'),
        ];
    }
}
