<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();

        $config = config('laratrust_seeder.role_structure');
        $userPermission = config('laratrust_seeder.permission_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));
        $controllers = $this->getFullQualifiedControllersNames();
        foreach ($config as $key => $modules) {

            // Create a new role
            $role = \App\Role::create([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);

            $this->command->info('Creating Role ' . strtoupper($key));

            $name = ucwords(str_replace('_', ' ', $key));

            $user = \App\User::create([
                'name' => $name,
                'email' => $key . '@app.com',
                'password' => bcrypt('password'),
                'slug' => str_slug($key)
            ]);


        }
        $permissions = [];

        foreach ($controllers as $controller) {
            $c = strtolower(str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller));
            list($controller_name, $action) = explode('@', $c);
            $permission =   $action. '-' .$controller_name;
            $permissions[] = \App\Permission::firstOrCreate([
                'name' => $permission,
                'display_name' => ucfirst($action) . ' ' . ucfirst($controller_name),
                'description' => ucfirst($action) . ' ' . ucfirst($controller_name),
            ])->id;
        }
        // Attach all permissions to the role
        $role = \App\Role::where('name', 'superadministrator')->first();
        $role->permissions()->sync($permissions);
        $user = \App\User::first();
        $user->roles()->sync($role);

        // Create default user for each role
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        \App\User::truncate();
        \App\Role::truncate();
        \App\Permission::truncate();
        Schema::enableForeignKeyConstraints();
    }

    private function getFullQualifiedControllersNames(): array
    {
        $controllers = [];
        foreach (\Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            if (array_key_exists('controller', $action)) {
                // You can also use explode('@', $action['controller']); here
                // to separate the class name from the method
                if(strpos($action['controller'], 'Backend')) {
                    $controllers[] = $action['controller'];
                }
            }
        };
        return $controllers;
    }
}
