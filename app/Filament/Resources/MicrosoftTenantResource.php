<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MicrosoftTenantResource\Pages;
use App\Filament\Resources\MicrosoftTenantResource\RelationManagers;
use App\Models\MicrosoftTenant\MicrosoftTenant;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MicrosoftTenantResource extends Resource
{
    protected static ?string $model = MicrosoftTenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('tenant_id')->required(),
                Forms\Components\TextInput::make('application_id')->required(),
                Forms\Components\TextInput::make('secret')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListMicrosoftTenants::route('/'),
            'create' => Pages\CreateMicrosoftTenant::route('/create'),
            'edit' => Pages\EditMicrosoftTenant::route('/{record}/edit'),
        ];
    }
}
