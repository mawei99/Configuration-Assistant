<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfigurationTemplateResource\Pages;
use App\Filament\Resources\ConfigurationTemplateResource\RelationManagers;
use App\Models\Configuration\ConfigurationTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConfigurationTemplateResource extends Resource
{
    protected static ?string $model = ConfigurationTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('url'),
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable(),
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

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListConfigurationTemplates::route('/'),
            'create' => Pages\CreateConfigurationTemplate::route('/create'),
            'edit' => Pages\EditConfigurationTemplate::route('/{record}/edit'),
        ];
    }
}
