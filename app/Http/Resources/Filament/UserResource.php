<?php

namespace App\Http\Resources\Filament;

use App\Models\User;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Actions\Action;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected static ?string $model = User::class;

    // ... Остальной код ...

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('balance')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Имя'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('balance')->label('Баланс'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('credit')
                    ->form([
                        Forms\Components\TextInput::make('amount')
                            ->label('Сумма для зачисления')
                            ->numeric()
                            ->required(),
                    ])
                    ->action(function (User $record, array $data) {
                        $record->credit($data['amount']);
                    }),
                Action::make('debit')
                    ->form([
                        Forms\Components\TextInput::make('amount')
                            ->label('Сумма для списания')
                            ->numeric()
                            ->required(),
                    ])
                    ->action(function (User $record, array $data) {
                        $record->debit($data['amount']);
                    }),
            ]);
    }
}
