<?php

namespace App\Modules\Users\Database\Seeds;

use Nova\Database\ORM\Model;
use Nova\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the Database Seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //
        $this->call('App\Modules\Users\Database\Seeds\UsersTableSeeder');
        $this->call('App\Modules\Users\Database\Seeds\PermissionsTableSeeder');
    }
}
