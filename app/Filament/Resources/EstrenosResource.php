<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstrenosResource\Pages;
use App\Filament\Resources\EstrenosResource\RelationManagers;
use App\Models\Estrenos;
use App\Models\Productos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;



class EstrenosResource extends Resource
{
    protected static ?string $model = Estrenos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Administrador de productos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('descripcion')
                    ->required(),
                Forms\Components\TextInput::make('fecha_estreno')
                    ->label('fecha de estreno')
                    ->required()
                    ->type('date'), // Esto define el tipo de campo como 'date'
                    Select::make('producto_id')
                    ->label('Producto')
                    ->relationship('producto', 'nombre'), // Asegúrate de que 'nombre' es un campo válido en tu tabla 'productos'
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('descripcion')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('fecha_estreno')
                ->label('Fecha de estreno'),
            Tables\Columns\TextColumn::make('producto.nombre')
                ->label('Producto')
                ->sortable()
                ->searchable(),
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
            'index' => Pages\ListEstrenos::route('/'),
            'create' => Pages\CreateEstrenos::route('/create'),
            'edit' => Pages\EditEstrenos::route('/{record}/edit'),
        ];
    }
}
