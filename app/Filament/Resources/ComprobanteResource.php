<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComprobanteResource\Pages;
use App\Models\Comprobante;
use App\Models\Cliente;
use App\Models\Carrito;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ComprobanteResource extends Resource
{
    protected static ?string $model = Comprobante::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('cliente_id')
                ->label('Cliente')
                ->relationship('cliente', 'name')
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    // Filtrar carritos según el cliente seleccionado
                    $carritos = Carrito::where('cliente_id', $state)->get();

                    // Establecer opciones de carritos en el campo de selección
                    $set('carrito_id', $carritos->pluck('id', 'id')->toArray());
                }),

            Select::make('carrito_id')
                ->label('Carrito')
                ->required()
                ->options(function (callable $get) {
                    // Obtener los carritos disponibles para el cliente seleccionado
                    $clienteId = $get('cliente_id');
                    if ($clienteId) {
                        return Carrito::where('cliente_id', $clienteId)->pluck('id', 'id');
                    }
                    return [];
                })
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    // Calcular y establecer el monto total para el carrito seleccionado
                    $carrito = Carrito::find($state);
                    if ($carrito) {
                        $total = $carrito->detalles->sum('subtotal');
                        $set('monto_total', $total);
                    }
                }),

            TextInput::make('monto_total')
                ->label('Monto Total')
                ->required()
                ->numeric(),
            Select::make('estado')
                ->label('Estado')
                ->options([
                    'pendiente' => 'Pendiente',
                    'pagado' => 'Pagado',
                    'cancelado' => 'Cancelado',
                ])
                ->default('pendiente')
                ->required(),
            

                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.name')->label('Cliente'),
                Tables\Columns\TextColumn::make('carrito_id') ->label('Carritos'),

                Tables\Columns\TextColumn::make('monto_total')->label('Total'),
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
            // Define the relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComprobantes::route('/'),
            'create' => Pages\CreateComprobante::route('/create'),
            'edit' => Pages\EditComprobante::route('/{record}/edit'),
        ];
    }
}
