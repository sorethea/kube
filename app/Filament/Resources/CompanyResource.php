<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use App\Models\Scopes\ActiveScope;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

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
                    ->relationship('parent',"name")
                    ->searchable()
                    ->options(Company::group()->pluck("name","id")->toArray()),
                Forms\Components\Toggle::make("group"),
//                Forms\Components\Toggle::make("active"),
                Forms\Components\SpatieMediaLibraryFileUpload::make("logo")
                    ->collection("logo"),
                Forms\Components\Fieldset::make('Company Details')->schema([
                    Forms\Components\TextInput::make("phone"),
                    Forms\Components\TextInput::make("email"),
                    Forms\Components\TextInput::make("address"),
                    Forms\Components\TextInput::make("location"),
                    Forms\Components\MarkdownEditor::make("description")->columnSpan(2),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make("logo")->collection("logo"),
                Tables\Columns\TextColumn::make("name")->searchable()->sortable(),
                Tables\Columns\TextColumn::make("abbr")->searchable()->sortable(),
                Tables\Columns\TextColumn::make("parent.name")->searchable(),
                Tables\Columns\BooleanColumn::make("group"),
//                Tables\Columns\BadgeColumn::make("state")
//                    ->label("Status")
//                    ->enum([
//                    null => "Not Available",
//                    0 => config("document-state.status")[0],
//                    1 => config("document-state.status")[1],
//                    2 => config("document-state.status")[2],
//                ])->colors([
//                    "primary",
//                    "success"=>1,
//                    "danger"=>2,
//                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\Action::make("Submit")
//                    ->action(fn($record)=>$record->setState(1))
//                    ->requiresConfirmation()
//                    ->color("success"),
//                Tables\Actions\Action::make("Cancel")
//                    ->action(fn($record)=>$record->setState(2))
//                    ->requiresConfirmation()
//                    ->color("danger"),
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
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->withoutGlobalScope("active");
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
