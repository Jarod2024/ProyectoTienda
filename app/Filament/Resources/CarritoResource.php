<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarritoResource\Pages;
use App\Models\Carrito;
use App\Models\Productos;
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
                    ->relationship('cliente', 'name')
                    ->required(),
                Repeater::make('productos')
                    ->schema([
                        Select::make('producto_id')
                            ->label('Producto')
                            ->relationship('producto', 'nombre')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $producto = Productos::find($state);
                                if ($producto) {
                                    $set('precio', $producto->precio);
                                    $cantidad = $get('cantidad') ?? 1;
                                    $set('subtotal', $cantidad * $producto->precio);
                                }
                            }),
                        TextInput::make('cantidad')
                            ->numeric()
                            ->default(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $precio = $get('precio');
                                if ($precio) {
                                    $set('subtotal', $state * $precio);
                                }
                            }),
                        TextInput::make('precio')
                            ->disabled()
                            ->numeric(),
                        TextInput::make('subtotal')
                            ->disabled()
                            ->numeric(),
                    ])
                    ->columns(4)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $total = collect($state)->sum('subtotal');
                        $set('total', $total);
                    }),
                TextInput::make('total')
                    ->label('Total')
                    ->disabled()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.name')->label('Cliente'),
                Tables\Columns\TextColumn::make('producto')
                    ->label('Productos')
                    ->formatStateUsing(function ($state) {
                        // Decodifica el JSON
                        $productosArray = json_decode($state, true);

                        // Verifica si $productosArray es un array
                        if (is_array($productosArray)) {
                            return collect($productosArray)
                                ->map(function ($producto) {
                                    if (is_array($producto) && isset($producto['producto_id'])) {
                                        $productoModel = Productos::find($producto['producto_id']);
                                        return $productoModel ? $productoModel->nombre . ' (Cantidad: ' . $producto['cantidad'] . ')' : 'Desconocido';
                                    }
                                    return 'Datos inválidos'; // Manejo de datos inesperados
                                })
                                ->join(', ');
                        }
                        return 'N/A'; // Valor de reserva en caso de datos inesperados
                    }),
                Tables\Columns\TextColumn::make('total')->label('Total'),
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
