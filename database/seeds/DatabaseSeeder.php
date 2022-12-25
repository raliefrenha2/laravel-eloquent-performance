<?php

use App\Company;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Company::class, 1000)->create()->each(fn ($company) => $company->users()
            ->createMany(factory(User::class, 50)->make()->map->getAttributes())
        );

        factory(User::class, 20)->create(['company_id' => 1])->each(fn ($user) => $user->posts()
            ->createMany(factory(Post::class, 5)->make()->toArray())
        );
    }
}
