<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalRecordResource\Pages;
use App\Filament\Resources\MedicalRecordResource\RelationManagers;
use App\Models\medical_record;
use App\Models\MedicalRecord;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalRecordResource extends Resource
{
    protected static ?string $model = medical_record::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patient_id')
                    ->relationship('patient','name')->required()->label('Pasien'),
                Select::make('doctor_id')
                    ->relationship('doctor', 'name')->required()->label('Dokter'),
                DatePicker::make('record_date')->required()->label('Tanggal'),
                TextInput::make('blood_type')->required()->label('Golongan Darah'),
                TextInput::make('blood_pressure')->required()->label('Tekanan Darah'),
                TextInput::make('complaint')->required()->label('Keluhan'),
                TextInput::make('diagnosa')->required()->label('Diagnosis'),
                TextInput::make('treatment')->required()->label('Tindakan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.name')->label('Nama Pasien'),
                TextColumn::make('doctor.name')->label('Dokter'),
                TextColumn::make('record_date')->label('Tanggal'),
                TextColumn::make('blood_type')->label('Golongan Darah'),
                TextColumn::make('blood_pressure')->label('Tekanan Darah'),
                TextColumn::make('complaint')->label('Keluhan'),
                TextColumn::make('diagnosa')->label('Diagnosa'),
                TextColumn::make('treatment')->label('Tindakan'),
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
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListMedicalRecords::route('/'),
            'create' => Pages\CreateMedicalRecord::route('/create'),
            'edit' => Pages\EditMedicalRecord::route('/{record}/edit'),
        ];
    }    
}
