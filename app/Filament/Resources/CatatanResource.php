<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Catatan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Pages\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\CatatanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CatatanResource\RelationManagers;
use App\Filament\Resources\CatatanResource\Pages\EditCatatan;
use App\Filament\Resources\CatatanResource\Pages\ListCatatans;
use App\Filament\Resources\CatatanResource\Pages\CreateCatatan;

class CatatanResource extends Resource
{
    protected static ?string $model = Catatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    // protected static ?string $title = 'Note';
    protected static ?string $navigationLabel = 'Note';

   public static function form(Form $form): Form
    {
        return $form
    ->schema([
        Section::make()
            ->columns(1) // Pastikan hanya ada satu kolom di Section
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->columnSpan([
                        'sm' => 1,
                        'xl' => 1,
                        '2xl' => 1,
                    ]),

                Textarea::make('content')
                    ->label('Content')
                    ->columnSpan([
                        'sm' => 4,
                        'xl' => 1,
                        '2xl' => 8,
                    ])
                    ->autosize(),

                Select::make('label_id') // Dropdown untuk memilih Label
                    ->relationship('nama','id')
                    // ->label('Label')
                    // ->options(\App\Models\Label::pluck('name', 'id')) // Ambil nama label dari database
                    ->searchable() // Bisa dicari
                    ->required() // Kolom wajib diisi
                    ->columnSpan([
                        'sm' => 1,
                        'xl' => 1,
                        '2xl' => 1,
                    ]),
            ]),
    ]);

    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('content')
                ->limit(50)
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
            ])
            ->emptyStateHeading('Belum ada Catatan')
            ->emptyStateDescription('Silahkan buat terlebih dahulu!')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Create post')
                    ->url(route('filament.admin.resources.catatans.create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
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
            'index' => Pages\ListCatatans::route('/'),
            'create' => Pages\CreateCatatan::route('/create'),
            'edit' => Pages\EditCatatan::route('/{record}/edit'),
        ];
    }
}
