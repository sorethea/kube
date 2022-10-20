<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-library';

    protected static function getNavigationGroup(): ?string
    {
        return trans("general.application");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("name")
                    ->unique('companies',ignorable: fn($record)=>$record)
                    ->required(),
                Forms\Components\TextInput::make("abbr")
                    ->unique('companies',ignorable: fn($record)=>$record)
                    ->required(),
                Forms\Components\TextInput::make("domain"),
                Forms\Components\BelongsToSelect::make("parent")
                    ->relationship('parent',"name"),
                Forms\Components\SpatieMediaLibraryFileUpload::make("logo")
                    ->collection("logo"),

                Forms\Components\Fieldset::make('Company Details')->schema([
                    Forms\Components\TextInput::make("phone"),
                    Forms\Components\TextInput::make("email"),
                    Forms\Components\TextInput::make("address"),
                    Forms\Components\TextInput::make("location"),
                    Forms\Components\MarkdownEditor::make("description"),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}