<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pahlawan;
use Barryvdh\DomPDF\Facade\PDF;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Http\UploadedFile;
use Filament\Tables\Actions\ButtonAction;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Finder\SplFileInfo;
use App\Filament\Resources\PahlawanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PahlawanResource\RelationManagers;

class PahlawanResource extends Resource
{
    protected static ?string $model = Pahlawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama Pahlawan')
                    ->maxLength(255),
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->label('Deskripsi')
                            ->maxLength(255),
                    ]),
                // Forms\Components\Textarea::make('description')
                //     ->required()
                //     ->label('Deskripsi')
                //     ->maxLength(255),
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto')
                    ->directory('pahlawans')
                    ->required()
                    ->preserveFilenames()
                    ->getUploadedFileNameForStorageUsing(function ($file): string {
                        if ($file instanceof UploadedFile) {
                            return time() . '-' . $file->getClientOriginalName(); // Ambil nama asli file
                        }
                        return time() . '-' . $file->getFilename(); // Fallback untuk SplFileInfo
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Pahlawan'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50), // Batasi teks hingga 50 karakter,
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public'),  // Jika foto disimpan di disk 'public', sesuaikan dengan tempat penyimpanan foto
                // ->width(100),  // Ukuran lebar gambar, sesuaikan dengan kebutuhan
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document')
                    ->color('danger')
                    ->action(function () {
                        $pahlawans = Pahlawan::all();
                        $pdf = PDF::loadView('pdf', ['pahlawans' => $pahlawans])
                            ->setPaper('A4', 'potrait');
                        return response()->streamDownload(
                            fn() => print($pdf->output()),
                            'daftar_pahlawan.pdf'
                        );
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPahlawans::route('/'),
            'create' => Pages\CreatePahlawan::route('/create'),
            'edit' => Pages\EditPahlawan::route('/{record}/edit'),
        ];
    }
}
