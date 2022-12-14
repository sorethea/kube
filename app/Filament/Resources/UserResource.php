<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static function getNavigationGroup(): ?string
    {
        return trans('general.administration');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make("name")->required(),
                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make("email")
                            ->unique(User::class, ignorable: fn($record)=>$record),
                        Forms\Components\TextInput::make("phone")
                            ->unique(User::class, ignorable: fn($record)=>$record),
                    ])->columns(2),
                    Forms\Components\SpatieMediaLibraryFileUpload::make("avatar"),
                ])->columnSpan(2),
                Forms\Components\Card::make()->schema([
                    Forms\Components\BelongsToManyCheckboxList::make('roles')->relationship('roles','name'),
                    Forms\Components\Toggle::make("active"),
                    Forms\Components\Group::make([
                        Forms\Components\Placeholder::make("created_at")
                            ->content(fn($record):string => $record->created_at->diffForHumans()),
                        Forms\Components\Placeholder::make("updated_at")
                            ->content(fn($record):string => $record->updated_at->diffForHumans()),
                    ])->hidden(fn($record)=>$record===null),
                ])->columnSpan(1),
            ])->columns(3);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('phone')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\BooleanColumn::make('active'),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope('active');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
