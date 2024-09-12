<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static bool $shouldSkipAuthorization = true;

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Form Pelanggan')
                ->label(fn () => __('Form Pelanggan'))
                // ->description(fn () => __('page.general_settings.sections.site.description'))
                ->icon('fluentui-web-asset-24-o')
                ->schema([
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\TextInput::make('nama_perusahaan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nama_pic')
                            ->required()
                            ->maxLength(255),
                    ]),
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\TextInput::make('email_pic')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nomor_hp_pic')
                            ->required()
                        ->maxLength(255),
                    ]),

                    Forms\Components\TextInput::make('dokumen_id')
                        ->maxLength(255)
                        ->hidden(true),
                    Forms\Components\Textarea::make('alamat')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Select::make('jasa_dibutuhkan')
                        ->multiple()
                        ->label('Jasa yang Dibutuhkan')
                        ->options([
                            'tkdn' => 'TKDN',
                            'survey_kepuasan' => 'Survey Kepuasan',
                            'pendataan' => 'Pendataan',
                            'sni' => 'SNI',
                            'iso' => 'ISO',
                            'lainnya' => 'Jasa Lainnya (bisa dituliskan di keterangan)',
                        ]),
                    Forms\Components\Textarea::make('keterangan')
                        ->columnSpanFull(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_perusahaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pic')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_pic')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_hp_pic')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dokumen_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
