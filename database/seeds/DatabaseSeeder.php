<?php

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
        $this->call(BaccaratHistoryTableSeeder::class);
        $this->call(VideoRecordTableSeeder::class);
        $this->call('InitUsersTableSeeder');

        //$this->call(VoyagerDatabaseSeeder::class);
        $this->call('DataTypesTableSeeder');
        $this->call('DataRowsTableSeeder');
        $this->call('MenusTableSeeder');
        $this->call('MenuItemsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('PermissionRoleTableSeeder');
        $this->call('SettingsTableSeeder');
    }
}
