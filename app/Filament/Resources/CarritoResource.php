<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarritoResource\Pages;
use App\Models\Carrito;
use App\Models\Productos;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class CarritoResource extends Resource
{
    protected static ?string $model = Carrito::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('cliente_id')
                ->label('Cliente')
                ->relationship('cliente', 'name') // Usa 'name' si tu modelo Usuario tiene un campo 'name'
                ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('Cliente.name') // Muestra el nombre del usuario en la tabla
                ->label('Cliente'),
            Tables\Columns\TextColumn::make('fecha_creacion')
                ->label('Fecha de Creación')
                ->dateTime(),
                
            ])
            ->filters([
                // Define los filtros si es necesario
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
            // Define relationships if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarritos::route('/'),
            'create' => Pages\CreateCarrito::route('/create'),
            'edit' => Pages\EditCarrito::route('/{record}/edit'),
        ];
    }
}
