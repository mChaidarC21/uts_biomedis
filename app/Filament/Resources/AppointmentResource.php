<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patient_id')
                    ->label('Nama Pasien')
                    ->relationship('patient', 'name')
                    ->required(),
    
                Select::make('doctor_id')
                    ->label('Nama Dokter')
                    ->relationship('doctor', 'name')
                    ->required(),
    
                DateTimePicker::make('appointment_date')
                    ->label('Tanggal')
                    ->required(),
    
                Select::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'completed' => 'Completed',
                        'canceled' => 'Canceled',
                    ])
                    ->default('scheduled')
                    ->required(),
            ]);
    }
    

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('patient.name')->label('Nama Pasien'),
            TextColumn::make('doctor.name')->label('Nama Dokter'),
            TextColumn::make('appointment_date')->label('Tanggal')->dateTime(),
            TextColumn::make('status')
            ->label('Status')
            ->badge()
            ->formatStateUsing(function (string $state): string {
                return match ($state) {
                    'scheduled' => 'Scheduled',
                    'completed' => 'Completed',
                    'canceled' => 'Canceled',
                    default => 'Unknown',
                };
            })
            ->color(function (string $state): string {
                return match ($state) {
                    'scheduled' => 'primary',
                    'completed' => 'success',
                    'canceled' => 'danger',
                    default => 'secondary',
                };
            }),
        ])
        ->filters([
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }    
}
