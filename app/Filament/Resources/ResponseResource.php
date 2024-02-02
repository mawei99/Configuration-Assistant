<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResponseResource\Pages;
use App\Filament\Resources\ResponseResource\RelationManagers;
use App\Models\Response;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ResponseResource extends Resource
{
    protected static ?string $model = Response::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('response_code')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('microsoft_tenant_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('configuration_name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListResponses::route('/'),
            'view' => Pages\ViewResponse::route('/{record}'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist {
        return $infolist
            ->schema([
                Infolists\Components\Grid::make(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('user_name'),
                        Infolists\Components\TextEntry::make('microsoft_tenant_name'),
                        Infolists\Components\TextEntry::make('response_code'),
                        Infolists\Components\TextEntry::make('created_at'),
                        Infolists\Components\TextEntry::make('configuration_name'),
                    ]),
                Infolists\Components\Grid::make(1)
                    ->schema([
                        Infolists\Components\TextEntry::make('Configuration_properties')
                            ->state(fn (Response $response) => json_encode($response->configuration_properties)),
                        Infolists\Components\TextEntry::make('headers'),
                        Infolists\Components\TextEntry::make('body'),
                    ]),
            ]);
    }
}
