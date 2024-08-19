<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteComprobanteResource\Pages;
use App\Filament\Resources\ReporteComprobanteResource\RelationManagers;
use App\Models\ReporteComprobante;
use App\Models\comprobante;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReporteComprobanteResource extends Resource
{
    protected static ?string $model = comprobante::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Reportes';

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
                Tables\Columns\TextColumn::make('cliente.name')->label('Cliente'),
                Tables\Columns\TextColumn::make('carrito_id')->label('Carrito'),
                    
                Tables\Columns\TextColumn::make('monto_total')->label('Total'),
            ])
            ->filters([
                //
            ])
            ->actions([
                
            ])
            ->bulkActions([
               
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
            'index' => Pages\ListReporteComprobantes::route('/'),
            
        ];
    }
}
