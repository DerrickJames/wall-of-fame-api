<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'production') {
            exit('I just stopped you from getting fired, asshole! Thank me later.');
        }

        $tables = [
            'users'
        ];

        /** 
         * For MySQL database
         *
         * TODO: Extract a package for checking different database
         *       implementations
         * */
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        /** For PostgreSQL */
        DB::statement('SET session_replication_role = replica;');

        foreach($tables as $table) {
            DB::table($table)->truncate();
        }

        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('SET session_replication_role = DEFAULT;');

        $this->call(UserTableSeeder::class);
    }
}
