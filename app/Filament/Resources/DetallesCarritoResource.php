<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetallesCarritoResource\Pages;
use App\Models\DetallesCarrito;
use App\Models\Productos; // Importación correcta del modelo Producto
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;


class DetallesCarritoResource extends Resource
{
    protected static ?string $model = DetallesCarrito::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('carrito_id')
                ->label('Carrito')
                ->relationship('carrito', 'id')
                ->required(),

            Select::make('producto_id')
                ->label('Producto')
                ->relationship('producto', 'nombre')
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                    $producto = Productos::find($state);
                    if ($producto) {
                        $set('precio', $producto->precio); // Establece el precio aquí
                        $cantidad = $get('cantidad') ?? 1;
                        $set('subtotal', $cantidad * $producto->precio);
                    }
                }),

            TextInput::make('cantidad')
                ->label('Cantidad')
                ->numeric()
                ->default(1)
                ->reactive()
                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                    $precio = $get('precio');
                    if ($precio) {
                        $set('subtotal', $state * $precio);
                    }
                }),

            Forms\Components\TextInput::make('precio')
                ->required()
                ->numeric()
                ->minValue(0),

            Forms\Components\TextInput::make('subtotal')
                ->required()
                ->numeric()
                ->minValue(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('carrito_id')->label('Carrito ID'),
                Tables\Columns\TextColumn::make('producto.nombre')->label('Producto'),
                Tables\Columns\TextColumn::make('cantidad')->label('Cantidad'),
                Tables\Columns\TextColumn::make('precio')->label('Precio'),
                Tables\Columns\TextColumn::make('subtotal')->label('Subtotal'),
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
            'index' => Pages\ListDetallesCarritos::route('/'),
            'create' => Pages\CreateDetallesCarrito::route('/create'),
            'edit' => Pages\EditDetallesCarrito::route('/{record}/edit'),
        ];
    }
}
