<?php

namespace Database\Seeders;
// use App\Models\Inv_Product_Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this::call([
            UserCategorySeeder::class,
            UserInfoSeeder::class,
            InvUnitSeeder::class,
            InvSupplierInfoSeeder::class,
            InvManufacturerInfoSeeder::class,
            InvProductCategorySeeder::class,
            InvProductSubCategorySeeder::class,
            InvProductSeeder::class,
            InvLocationSeeder::class,
            InvStoreSeeder::class,
            InvClientInfoSeeder::class,
            InvReceiveDetailSeeder::class,
            
        ]);

        // Inv_Product_category::factory()->count(50000)->unique()->create();






        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
