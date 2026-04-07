<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Edit Informasi Pengguna')
                ->schema([
                    Section::make()
                    ->schema([
                        TextInput::make('name')
                        ->label('Nama')
                        ->live(onBlur:true)
                        ->placeholder('Masukan Nama Lengkap')
                        ->dehydrateStateUsing(fn($state) => Str::title($state))
                        ->formatStateUsing(fn($state) => Str::title($state))
                        ->string()
                        ->required()
                        ->minLength(5)
                        ->maxLength(255),
                        TextInput::make('username')
                        ->label('Nama Pengguna')
                        ->placeholder('Masukan Nama Pengguna')
                        ->unique(ignoreRecord:true)
                        ->required()
                        ->string()
                        ->minLength(5)
                        ->maxLength(255),
                        TextInput::make('email')
                        ->label('Email')
                        ->placeholder('Masukan Nama Email')
                        ->required()
                        ->email()
                        ->unique(ignoreRecord:true)
                        ->minLength(5)
                        ->maxLength(255),
                        TextInput::make('phone')
                        ->label('Nomor Kontak')
                        ->placeholder('Masukan Nomor Kontak')
                        ->string()
                        ->unique(ignoreRecord:true)
                        ->required()
                        ->minLength(6)
                        ->maxLength(15),
                        Select::make('role')
                        ->label('Level Pengguna')
                        ->required()
                        ->options([
                            'owner' => 'Owner',
                            'staf' => 'Staff',
                        ])
                        ->native(false),
                        Select::make('roles')
                        ->required()
                        ->multiple()
                        ->preload()
                        ->relationship('roles', 'name'),
                        Fieldset::make('Kata Sandi')
                        ->schema([
                            TextInput::make('password')
                            ->label('Kata Sandi')
                            ->placeholder('Masukan Kata Sandi')
                            ->required(fn($record) => $record === null)
                            ->same('confirmation_password')
                            ->password()
                            ->revealable()
                            ->minLength(8)
                            ->maxLength(16)
                            ->dehydrated(fn($record) => filled($record))
                            ->dehydrateStateUsing(fn($state) => Hash::make($state)),
                            TextInput::make('confirmation_password')
                            ->label('Konfirmasi Kata Sandi')
                            ->placeholder('Masukan Konfirmasi Kata Sandi')
                            ->required(fn($record) => $record === null)
                            ->password()
                            ->revealable()
                            ->dehydrated(false)
                            ->minLength(8)
                            ->maxLength(16)
                        ])

                    ])->columns(1)
                ])
                ->columnSpanFull()
            ]);
    }
}
