<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\City;
use App\Models\Employee;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Employee Management';

    protected static ?string $tenantOwnershipRelationshipName = 'team';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Employee Information')
                    ->description('Please fill in the employee details.')
                    ->schema([
                        Forms\Components\Select::make('country_id')
                            ->required()
                            ->relationship('country', 'name') // Country is a relationship in Employee model
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->live() // Live updates to fetch states and cities based on selected country
                            ->afterStateUpdated(function (Set $set) {
                                $set('state_id', null);
                                $set('city_id', null);
                            }), // Reset state and city when country changes
                        Forms\Components\Select::make('state_id')
                            ->required()
                            ->options(fn(Get $get) => State::query() // Get states based on selected country
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id'))
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->live() // Live updates to fetch cities based on selected state
                            ->afterStateUpdated(fn(Set $set) => $set('city_id', null)), // Reset city when state changes
                        Forms\Components\Select::make('city_id')
                            ->required()
                            ->options(fn(Get $get) => City::query()
                                ->where('state_id', $get('state_id'))
                                ->pluck('name', 'id'))
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->live(), // Live updates to fetch cities based on selected state
                        Forms\Components\Select::make('department_id')
                            ->required()
                            ->relationship('department', 'name')
                            ->native(false)
                            ->searchable()
                            ->preload(),
                    ])->columns(2),
                Forms\Components\Section::make('Personal Information')
                    ->description('Please fill in the personal details of the employee.')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required(),
                        Forms\Components\TextInput::make('last_name')
                            ->required(),
                        Forms\Components\TextInput::make('middle_name'),
                    ])->columns(3),
                Forms\Components\Section::make('Contact Information')
                    ->description('Please fill in the contact details of the employee.')
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->required(),
                        Forms\Components\TextInput::make('zip_code')
                            ->required(),
                    ])->columns(2),
                Forms\Components\Section::make('Employment Details')
                    ->description('Please fill in the employment details of the employee.')
                    ->schema([
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->native(false),
                        Forms\Components\DatePicker::make('date_of_hire')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->native(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_of_hire')
                    ->date()
                    ->sortable(),
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
                SelectFilter::make('department')
                    ->relationship('department', 'name')
                    ->native(false)
                    ->searchable(),
            ])->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
