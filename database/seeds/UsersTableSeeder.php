<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, "super admin", "super_admin@ivas.com", "$2y$10$NeBk5Rt.cocTb9mmQEokc.AAl.yq1cKbudxd9Ai4U/dBk7KKxG.dK", 1, "bwvhPVfbgLpHWQysjiuypV0NdqcRUvDa2NH69I4PCRWY960eNTLTkrURJSLA", "2017-11-09 13:13:14", "2020-07-02 08:22:21")');
    }
}
