<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Ask for confirmation to refresh migration
        if ($this->command->confirm('Do you wish to refresh migration before seeding, Make sure it will clear all old data ?')) {
            $this->command->call('migrate:refresh');
            $this->command->warn("Data deleted, starting from fresh database.");
        }
        // Seed the default permissions
        $permissions = Permission::defaultPermissions();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $this->command->info('Default Permissions added.');
        // Ask to confirm to assign admin or user role
        if ($this->command->confirm('Create Roles for user, default is admin and user? [y|N]', true)) {
            // Ask for roles from input
            $roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,User');
            // Explode roles
            $rolesArray = explode(',', $roles);
            // add roles
            foreach($rolesArray as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);

                if( $role->name == 'Admin' ) {
                    // assign all permissions to admin role
                    $role->permissions()->sync(Permission::all());
                    $this->command->info('Admin will have full rights');
                } else {
                    // for others, give access to view only
                    $role->permissions()->sync(Permission::where('name', 'LIKE', 'view_%')->get());
                }
                // create one user for each role

                $this->createUser($role);
            }
            $this->command->info('Roles ' . $roles . ' added successfully');
        } else {
            Role::firstOrCreate(['name' => 'User']);
            $this->command->info('By default, User role added.');
        }
    }
    /**
    * Create a user with given role
    *
    * @param $role
    */

    private function createUser($role)
    {
        $user = User::factory()->create();
        $user->assignRole($role->name);

        $username     = get_initials($user->username);
        $id        = $user->id.'.png';
        $path      = '/images/avatars/';
        $imagePath = create_avatar($username, $id, $path);

        //save image
        $user->avatar = $imagePath;
        $user->save();

        if( $role->name == 'Admin' ) {
            $this->command->info('Admin login details:');
            $this->command->warn('Username : '.$user->email);
            $this->command->warn('Password : "secret"');
        }
    }

}
