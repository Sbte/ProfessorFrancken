<?php


declare(strict_types=1);

namespace Francken\Auth;

use DB;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

/**
 * Used
 */
final class SetupPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the old users table to new accounts table and add permissions / roles';

    /**
     * Execute the console command.
     */
    public function handle() : void
    {
        $this->seedRolesAndPermissions();
        $old_users = DB::table('users')->get();

        foreach ($old_users as $user) {
            $account = Account::create([
                'email' => $user->email,
                'password' => $user->password,
                'member_id' => $user->francken_id,
            ]);

            if ($user->can_access_admin) {
                $account->assignrole('Board');
            }
        }
    }

    private function seedRolesAndPermissions() : void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Make sure to import all permissions
        $role = Role::create(['name' => 'Admin']);
        $this->call('permission:import');

        Role::create(['name' => ChangeRolesListener::BOARD_ROLE]);
        Role::create(['name' => ChangeRolesListener::CANDIDATE_BOARD_ROLE]);
        Role::create(['name' => ChangeRolesListener::DEMISSIONED_BOARD_ROLE]);
        Role::create(['name' => ChangeRolesListener::DECHARGED_BOARD_ROLE]);

        Role::create(['name' => 'Member']);
        Role::create(['name' => 'Active Member']);
        Role::create(['name' => 'Alumni member']);
    }
}
