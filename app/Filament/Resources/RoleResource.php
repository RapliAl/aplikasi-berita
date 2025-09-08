<?php

namespace App\Filament\Resources;

use BezhanSalleh\FilamentShield\Resources\RoleResource as BaseRoleResource;

class RoleResource extends BaseRoleResource
{
    protected static ?string $navigationGroup = 'User Management';
    
    protected static ?int $navigationSort = 2;
}