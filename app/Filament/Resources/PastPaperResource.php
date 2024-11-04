<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PastPaperResource\Pages;
use App\Filament\Resources\PastPaperResource\RelationManagers;
use App\Models\PastPaper;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PastPaperResource extends Resource
{
    protected static ?string $model = PastPaper::class;

    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('paper')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name'),
                Forms\Components\Select::make('course_id')
                    ->required()
                    ->relationship('course', 'course_name'),
                TagsInput::make('tags')
                    ->suggestions([
                        'Common Units',

                    ])
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('paper')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('uploaded by')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.course_name')
                    ->label('course name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.course_code')
                    ->label('course code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tags')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPastPapers::route('/'),
            'create' => Pages\CreatePastPaper::route('/create'),
            'view' => Pages\ViewPastPaper::route('/{record}'),
            'edit' => Pages\EditPastPaper::route('/{record}/edit'),
        ];
    }
}
