<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfigurationResource\Pages;
use App\Filament\Resources\ConfigurationResource\RelationManagers;
use App\Models\Configuration\Configuration;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class ConfigurationResource extends Resource
{
    protected static ?string $model = Configuration::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                    Forms\Components\TextInput::make('name')->required(),
                                    Forms\Components\Select::make('configuration_template_id')
                                        ->relationship(name: 'configurationTemplate', titleAttribute: 'name')
                                        ->label('Template')
                                        ->required(),
                                ])->columns(2),
                                Forms\Components\Textarea::make('description')
                                ->rows(3),
                        ]),
                        Forms\Components\Tabs\Tab::make('Properties')
                        ->schema([
                            Forms\Components\Repeater::make('properties')
                                ->relationship()
                                ->schema([
                                    Forms\Components\TextInput::make('name')->required(),
                                    Forms\Components\Select::make('type')
                                        ->options([
                                            'boolean',
                                            'int',
                                            'string',
                                        ])->required(),
                                    Forms\Components\TextInput::make('value')->required(),
                                ])->columns(3)
                                ->addActionLabel('Add Property')
                                ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                ->collapsible()
                                ->collapsed()
                                ->reorderable(),
                        ])
                    ]),
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
                    ->modalWidth('4xl'),
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
            'index' => Pages\ListConfigurations::route('/'),
        ];
    }
}
