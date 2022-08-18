<?php

namespace Sorethea\KubeAdmin\Filament\Resources;

use Sorethea\KubeAdmin\Filament\Resources\UserResource\Pages;
use Sorethea\KubeAdmin\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Administration';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("name")
                    ->required(),
                Forms\Components\TextInput::make("email")
                    ->unique("users","email",fn(?User $record)=>$record)
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make("password")
                    ->password()
                    ->required()
                    ->rules("confirmed|min:8")
                    ->maxLength(60)
                    ->dehydrateStateUsing(fn($state)=>Hash::make($state))
                    ->visibleOn("create"),
                Forms\Components\TextInput::make("password_confirmation")
                    ->password()
                    ->required()
                    ->maxLength(60)
                    ->visibleOn("create"),
                Forms\Components\BelongsToManyCheckboxList::make("roles")
                    ->relationship("roles","name"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("email")->searchable(),
                Tables\Columns\TextColumn::make("roles.name")->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
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
            'index' => \Sorethea\KubeAdmin\Filament\Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => \Sorethea\KubeAdmin\Filament\Resources\UserResource\Pages\CreateUser::route('/create'),
            'edit' => \Sorethea\KubeAdmin\Filament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
