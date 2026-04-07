<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nama')
                ->searchable(),
                TextColumn::make('phone')
                ->label('Kontak'),
                TextColumn::make('role')
                ->label('Level pengguna')
                ->formatStateUsing(fn($state) => ucfirst($state))
                ->badge()
                ->icon(fn(string $state) : string => match($state) {
                    'owner' => 'heroicon-s-shield-check',
                    'staf' => 'heroicon-s-identification',
                    'customer' => 'heroicon-s-user-group',
                })
                ->color(fn (string $state): string => match ($state) {
                    'owner' => 'danger',
                    'staf' => 'warning',
                    'customer' => 'success',
                }),
                TextColumn::make('status')
                ->label('Status')
                ->getStateUsing(fn ($record) => $record->isOnline() ? 'Sedang Aktif' : 'Tidak Aktif')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Sedang Aktif' => 'success',
                    'Tidak Aktif' => 'gray',
                })
                ->icon(fn (string $state): string => match ($state) {
                    'Sedang Aktif' => 'heroicon-s-check-circle',
                    'Tidak Aktif' => 'heroicon-o-x-circle',
                }),
                TextColumn::make('last_seen')
                ->label('Terakhir Aktif')
                ->since(),
                TextColumn::make('created_at')
                ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d-M-Y H:i:s'))
                ->label('Tanggal Dibuat')
                ->toggleable(isToggledHiddenByDefault:true)
            ])
            ->filters([
                TernaryFilter::make('Status Pengguna')
                ->placeholder('Semua Pengguna')
                ->native(false)
                ->trueLabel('Pengguna Sedang Aktif')
                ->falseLabel('Pengguna Tidak Aktif')
                ->queries(
                    true: fn(Builder $query) => $query->where('last_seen','>=', Carbon::now()->subMinutes(5)),
                    false: fn(Builder $query) => $query->where(function (Builder $query) {
                        $query->where('last_seen', '<', Carbon::now()->subMinutes(5))
                        ->orWhereNull('last_seen');
                    })
                )
                ->indicator('Status')
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make()
                    ->visible(fn($record) => in_array($record->role, ['owner', 'staf'])),
                    DeleteAction::make()
                    ->visible(fn($record) => in_array($record->role, ['owner', 'staf']))
                ])
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     // DeleteBulkAction::make(),
                // ]),
            ])
            ->headerActions([
                CreateAction::make()
                ->label('Tambah Pengguna')
                ->icon('heroicon-s-user-plus')
            ]);
    }
}
