<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Dokumen;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DokumenResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DokumenResource\RelationManagers;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class DokumenResource extends Resource
{
    protected static ?string $model = Dokumen::class;

    protected static ?string $navigationIcon = 'heroicon-s-server-stack';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bidang_id')
                    ->relationship('bidang', 'nama')
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('nama_dokumen')
                    ->required(),
                Forms\Components\TextInput::make('nama_pekerjaan')
                    ->required(),
                Forms\Components\Select::make('pelanggan_id')
                ->relationship('pelanggan', 'nama')
                ->native(false)
                ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->unique(),
                        Forms\Components\Textarea::make('alamat')
                            ->required(),
                    ]),
                Forms\Components\TextInput::make('nama_pic')
                    ->label('Nama PIC perusahaan'),
                Forms\Components\TextInput::make('nomor_pic')
                    ->label('Nomor PIC perusahaan'),
                Forms\Components\TextInput::make('email_pic')
                    ->label('Email PIC perusahaan')
                    ->email(),
                Forms\Components\Select::make('pic_sci_id')
                    ->relationship('picSci', 'fullname')
                    ->label('PIC Sucofindo')
                    ->native(false),
                Forms\Components\FileUpload::make('berkas')
                    ->downloadable()
                    ->directory('upload/dokumen')
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => '' .now()->format('d-m-Y_H-i-s_').auth()->user()->id.'.'.str($file->getClientOriginalName()),
                    ),
                Forms\Components\DatePicker::make('tgl_penerbitan')
                    ->native(false)
                    ->displayFormat('d-m-Y')
                    ->closeOnDateSelection(),
                Forms\Components\DatePicker::make('tgl_kadaluarsa')
                    ->native(false)
                    ->displayFormat('d-m-Y')
                    ->closeOnDateSelection(),
                Forms\Components\DatePicker::make('tgl_pengingat')
                    ->native(false)
                    ->displayFormat('d-m-Y')
                    ->closeOnDateSelection(),
                Forms\Components\Select::make('status_follow_up')
                    ->options([
                        'Belum Follow Up' => 'Belum Follow Up',
                        'Sudah Follow Up' => 'Sudah Follow Up',
                        'Tidak Perlu Follow Up' => 'Tidak Perlu Follow Up'])
                    ->native(false),
                Forms\Components\Toggle::make('status_pengingat')
                ->default(true)
                ->helperText('Aktifkan untuk membuat pengingat'),
                Forms\Components\Textarea::make('keterangan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bidang.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_dokumen')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pekerjaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pelanggan.nama')
                    ->searchable()
                    ->description(fn (Dokumen $record): string => $record->nama_pic),
                Tables\Columns\TextColumn::make('nomor_pic')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_pic')
                    ->searchable(),
                Tables\Columns\TextColumn::make('picSci.fullname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_penerbitan')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_kadaluarsa')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_pengingat')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_follow_up')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status_pengingat')
                    ->boolean(),
                Tables\Columns\TextColumn::make('createdBy.fullname')
                    ->label('created_by')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updatedBy.fullname')
                    ->label('updated_by')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deletedBy.fullname')
                    ->label('deleted_by')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                    Action::make('Download File')
                    ->url(fn (Dokumen $record): string => '../storage/'.$record->berkas)
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-arrow-down'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->recordUrl(null)->recordAction(null);
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
            'index' => Pages\ListDokumens::route('/'),
            'create' => Pages\CreateDokumen::route('/create'),
            'edit' => Pages\EditDokumen::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
