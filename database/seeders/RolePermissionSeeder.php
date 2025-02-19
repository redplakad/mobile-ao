<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    private $permission = [
        'dashboard' => [
            'view',
        ],

        'user' => [
            'view',
            'create',
            'edit',
            'delete',
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}
