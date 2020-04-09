<?php

use Illuminate\Database\Seeder;

class AdminstratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->name = "andre";
        $user->username = "andre";
        $user->password = \Hash::make('andre');
        $user->level = "admin";
        $user->email = "andrew@gmail.com";
        $user->save();
        $this->command->info('user berhasil dibuat');
    }
}
