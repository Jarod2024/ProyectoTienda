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
                Tables\Columns\TextColumn::make('user.name')->label('User Name'),
                Tables\Columns\TextColumn::make('productos')->label('Products')->formatStateUsing(function ($state) {
                    return json_encode($state); // Asegúrate de formatear el JSON para la vista de la tabla
                }),
                Tables\Columns\TextColumn::make('total')->label('Total'),
            ])
            ->filters([
                //
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
            //
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
