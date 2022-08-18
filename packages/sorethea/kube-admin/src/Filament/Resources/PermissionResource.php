<?php

namespace Sorethea\KubeAdmin\Filament\Resources;

use Sorethea\KubeAdmin\Filament\Resources\PermissionResource\Pages;
use Sorethea\KubeAdmin\Filament\Resources\PermissionResource\RelationManagers;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Spatie\Permission\Models\Permission;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-open';

    protected static ?string $navigationGroup = 'Administration';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("name")
                    ->unique("permissions","name",fn(?Permission $record)=>$record)
                    ->required(),
                Forms\Components\BelongsToManyCheckboxList::make("roles")
                    ->relationship("roles","name"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("roles.name")->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => \Sorethea\KubeAdmin\Filament\Resources\PermissionResource\Pages\ListPermissions::route('/'),
            'create' => \Sorethea\KubeAdmin\Filament\Resources\PermissionResource\Pages\CreatePermission::route('/create'),
            'edit' => \Sorethea\KubeAdmin\Filament\Resources\PermissionResource\Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
