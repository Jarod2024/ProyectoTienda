<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteProductoResource\Pages;
use App\Filament\Resources\ReporteProductoResource\RelationManagers;
use App\Models\ReporteProducto;
use App\Models\Productos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ReporteProductoResource extends Resource
{
    protected static ?string $model = Productos::class;

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
                TextColumn::make('nombre')
                ->sortable()
                ,
            TextColumn::make('descripcion')
                ->sortable()
                ,
            TextColumn::make('precio')
                ->sortable()
            , 
            TextColumn::make('plataforma.nombre')
                ->label('Plataforma')
                ->sortable()
                ,
            TextColumn::make('categoria.nombre')
                ->label('Categoria')
                ->sortable()
                ,
                ImageColumn::make('imagen')
                ->label('Imagen')
                ->disk('public') // Especifica el disco público
                ->sortable()
                ,  
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
            'index' => Pages\ListReporteProductos::route('/'),
            
        ];
    }
}
