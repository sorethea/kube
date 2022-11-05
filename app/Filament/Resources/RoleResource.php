<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyThroughRelationManager;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static function getNavigationGroup(): ?string
    {
        return trans("general.administration");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make("name")->unique(Role::class, ignorable: fn($record)=>$record),
                ])->columnSpan(2),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Placeholder::make("created_at")->content(fn($record):string => $record->created_at->diffForHumans()),
                    Forms\Components\Placeholder::make("updated_at")->content(fn($record):string => $record->updated_at->diffForHumans()),
                ])->hidden(fn($record)=>$record===null)->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable()->sortable(),
                Tables\Columns\TextColumn::make("permissions_count")
                    ->label(trans('general.permissions'))
                    ->counts("permissions"),
                Tables\Columns\TextColumn::make("users_count")
                    ->label(trans("general.users"))
                    ->counts("users"),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
