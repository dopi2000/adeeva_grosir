<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class UserInfolist {

    public static function configure(Schema $schema) : Schema {

        return $schema->components([
            Section::make()
            ->columnSpanFull()
            ->schema([
                
                Section::make('Informasi Detail Pengguna')
                ->description('Meta dan Informasi Detail Pengguna')
                ->schema([
                    ImageEntry::make('avatar')
                   ->state(function ($record) {
                        if ($record->avatar) {
                            return Storage::disk('public')->url($record->avatar);
                        }
                        return url('/avatar/avatar-default.jpg');
                    })
                    ->inlineLabel()
                    ->circular()
                    ->disk('public')
                    ->imageHeight(30)
                    ->imageWidth(30)
                    ->simpleLightbox(),
                    TextEntry::make('name')
                    ->label('Nama')
                    ->inlineLabel(),
                    TextEntry::make('username')
                    ->label('Nama Pengguna')
                    ->inlineLabel(),
                    TextEntry::make('email')
                    ->label('Email')
                    ->inlineLabel(),
                    TextEntry::make('phone')
                    ->label('Nomor Kontak')
                    ->inlineLabel(),
                    TextEntry::make('role')
                    ->label('Level Pengguna')
                    ->inlineLabel()
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
                    TextEntry::make('status')
                    ->label('Status')
                    ->inlineLabel()
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
                    TextEntry::make('email_verified_at')
                    ->label('Tanggal Verifikasi Email')
                    ->inlineLabel()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d-M-Y H:i:s')),
                    TextEntry::make('created_at')
                    ->label('Tanggal Akun Dibuat')
                    ->inlineLabel()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d-M-Y H:i:s'))
                ]),

                Section::make('Informasi Alamat Pengguna')
                ->description('Meta dan Detail Alamat Pengguna')
                ->relationship('address')
                ->schema([
                    TextEntry::make('province')
                    ->label('Provinsi')
                    ->inlineLabel(),
                    TextEntry::make('city')
                    ->label('Kota/Kabupaten')
                    ->inlineLabel(),
                    TextEntry::make('district')
                    ->label('Kecamatan')
                    ->inlineLabel(),
                    TextEntry::make('village')
                    ->label('Desa/Kelurahan')
                    ->inlineLabel(),
                    TextEntry::make('postal_code')
                    ->label('Kode Pos')
                    ->inlineLabel(),
                    TextEntry::make('street_name')
                    ->label('Deskripsi Alamat Spesifik')
                    ->inlineLabel(),
    
                ])
            ])
        ]);
    }

}