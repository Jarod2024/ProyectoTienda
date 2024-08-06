<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductosResource\Pages;
use App\Filament\Resources\ProductosResource\RelationManagers;
use App\Models\Productos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Image;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ImageColumn;


class ProductosResource extends Resource
{
    protected static ?string $model = Productos::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Administrador de productos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descripcion')
                    ->required(),
                Forms\Components\TextInput::make('precio')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                Forms\Components\Select::make('plataforma_id')
                    ->relationship('plataforma', 'nombre') 
                    ->required(),
                Forms\Components\Select::make('categoria_id')
                    ->relationship('categoria', 'nombre')
                    ->required(),
                Forms\Components\FileUpload::make('imagen')
                ->disk('public') // especificar el disco, por ejemplo, 'public'
                ->directory('imagenes') // especificar el directorio dentro del disco
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('nombre')
                ->sortable()
                ->searchable(),
            TextColumn::make('descripcion')
                ->sortable()
                ->searchable(),
            TextColumn::make('precio')
                ->sortable()
                ->searchable(), 
            TextColumn::make('plataforma.nombre')
                ->label('Plataforma')
                ->sortable()
                ->searchable(),
            TextColumn::make('categoria.nombre')
                ->label('Categoria')
                ->sortable()
                ->searchable(),
                ImageColumn::make('imagen')
                ->label('Imagen')
                ->disk('public') // Especifica el disco público
                ->sortable()
                ->searchable(),  
        ])
        ->filters([
            // Define los filtros si es necesario
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProductos::route('/create'),
            'edit' => Pages\EditProductos::route('/{record}/edit'),
        ];
    }
}
