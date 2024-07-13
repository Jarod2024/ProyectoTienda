<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfertasResource\Pages;
use App\Filament\Resources\OfertasResource\RelationManagers;
use App\Models\Ofertas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;

class OfertasResource extends Resource
{
    protected static ?string $model = Ofertas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('descripcion')
            ->required(),
            Forms\Components\TextInput::make('fecha_inicio')
            ->label('Fecha de Inicio')
            ->required()
            ->type('date'),
            Forms\Components\TextInput::make('fecha_fin')
            ->label('Fecha de Fin')
            ->required()
            ->type('date'),
        Select::make('producto_id')
            ->label('Producto')
            ->relationship('producto', 'nombre'),
        Forms\Components\TextInput::make('descuento') // Añadir el campo de descuento
            ->label('Descuento')
            ->required()
            ->numeric(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('descripcion')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('fecha_inicio')
                ->label('Fecha de estreno'),
            Tables\Columns\TextColumn::make('fecha_fin')
                ->label('Fecha de estreno'),
            Tables\Columns\TextColumn::make('producto.nombre')
                ->label('Producto')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('descuento')
                ->label('Descuento')
                ->sortable(),
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
            'index' => Pages\ListOfertas::route('/'),
            'create' => Pages\CreateOfertas::route('/create'),
            'edit' => Pages\EditOfertas::route('/{record}/edit'),
        ];
    }
}
