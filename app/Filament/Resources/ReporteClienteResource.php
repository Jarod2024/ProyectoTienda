<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteClienteResource\Pages;
use App\Filament\Resources\ReporteClienteResource\RelationManagers;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReporteClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;
    protected static ?string $navigationGroup = 'Reportes';
    protected static ?string $navigationIcon = 'heroicon-o-user';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
        
                Forms\Components\TextInput::make('name')
                ->label('Nombre')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('Direccion')
                ->label('Direccion')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('phone_number')
                ->label('Número de Teléfono')
                ->tel()
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('year_of_birth')
                ->label('Fecha de Nacimiento')
                ->required()
                ->type('date'), // Esto define el tipo de campo como 'date'
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nombre'),
            Tables\Columns\TextColumn::make('email')
                ->label('Email'),
            Tables\Columns\TextColumn::make('Direccion')
                ->label('Dirección'),
            Tables\Columns\TextColumn::make('phone_number')
                ->label('Número de Teléfono'),
            Tables\Columns\TextColumn::make('year_of_birth')
                ->label('Fecha de Nacimiento'),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Creado'),
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
            'index' => Pages\ListReporteClientes::route('/'),
        ];
    }
}