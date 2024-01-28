<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MicrosoftTenantResource\Pages;
use App\Filament\Resources\MicrosoftTenantResource\RelationManagers;
use App\Models\Configuration\Configuration;
use App\Models\MicrosoftTenant\MicrosoftTenant;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class MicrosoftTenantResource extends Resource
{
    protected static ?string $model = MicrosoftTenant::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('tenant_id')->required(),
                Forms\Components\TextInput::make('application_id')->required(),
                Forms\Components\TextInput::make('secret')->required()
                    ->password()->revealable(),
                Forms\Components\Textarea::make('description'),
            ])->columns(1);
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
                Tables\Actions\Action::make('Import configuration')
                ->form([
                    Forms\Components\Wizard::make([
                        Forms\Components\Wizard\Step::make('Authorization')
                            ->description('Check the access token')
                            ->schema([
                                Forms\Components\TextInput::make('status')
                                    ->readOnly()
                                    ->default(fn (MicrosoftTenant $microsoftTenant) => $microsoftTenant->tokenStatusMessage())
                                ->hintAction(
                                    Action::make('New access token')
                                    ->action(fn (MicrosoftTenant $microsoftTenant) => $microsoftTenant->renewAccessToken())
                                ),
                            ]),
                        Forms\Components\Wizard\Step::make('Configuration Selection')
                            ->description('Select the configuration to import')
                            ->schema([
                                Forms\Components\TextInput::make('Tenant')
                                    ->readOnly()
                                    ->default(fn (MicrosoftTenant $microsoftTenant) => $microsoftTenant->name),
                                Forms\Components\Select::make('Configuration')
                                    ->options(Configuration::all()->pluck('name', 'id'))
                            ]),
                    ]),
                ])->modalWidth('xl')
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
            'index' => Pages\ListMicrosoftTenants::route('/'),
        ];
    }
}
