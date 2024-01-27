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

class ConfigurationTemplateResource extends Resource
{
    protected static ?string $model = ConfigurationTemplate::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form {
        return $form
            ->columns(1)
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
                Tables\Actions\EditAction::make()
                    ->modalWidth('xl'),
                Tables\Actions\DeleteAction::make()
                    ->modalWidth('xl'),
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
        ];
    }
}
