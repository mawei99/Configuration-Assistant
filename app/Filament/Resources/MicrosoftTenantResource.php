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
                Forms\Components\TextInput::make('name')->required()->string(),
                Forms\Components\TextInput::make('tenant_id')->required()->string(),
                Forms\Components\TextInput::make('client_id')->required()->string(),
                Forms\Components\TextInput::make('secret_id')->string(),
                Forms\Components\TextInput::make('secret_value')->required()
                    ->password()->revealable()->string(),
                Forms\Components\Textarea::make('description')->string(),
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
                Tables\Actions\Action::make('Import configuration')
                    ->form([
                        Forms\Components\TextInput::make('Tenant_name')
                            ->default(fn (MicrosoftTenant $microsoftTenant) => $microsoftTenant->name)
                            ->readOnly(),
                        Forms\Components\Select::make('configuration')
                            ->options(Configuration::all()->pluck('name', 'id'))
                            ->required(),
                    ])
                    ->action(fn ($data, MicrosoftTenant $microsoftTenant) => $microsoftTenant->importConfiguration( Configuration::findOrFail($data['configuration']))
                    )->modalWidth('xl'),
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
            'index' => Pages\ListMicrosoftTenants::route('/'),
        ];
    }
}
