<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\PastPaperResource\Pages;
use App\Filament\Student\Resources\PastPaperResource\RelationManagers;
use App\Models\PastPaper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class PastPaperResource extends Resource
{
    protected static ?string $model = PastPaper::class;
    protected static ?string $navigationGroup = 'Study Material';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Section::make('Past Paper')
                    ->description('Happy revision !!')
                    ->schema([
                        Forms\Components\FileUpload::make('paper')
                            ->columnSpanFull()
                            ->required(),

                        Forms\Components\Textarea::make('tags')
                            ->required(),

                        Forms\Components\Select::make('course_id')
                            ->required()
                            ->relationship('course', 'course_name'),
                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('paper')
                    ->searchable(),
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
