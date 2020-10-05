<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolePermissionBootstrap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Otogaraj:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Roller ve PermissionlarOluşturma';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
 public function handle()
    {

        $roles = ["super-admin","uye","tedarikci","role-manager"];

        $permissions = [
            "KullaniciGor",
            "KullaniciDuzenle",
            "RoleAta",
            "RoleKaldir",
            "IzinleriGor",
            "RolleriGor"];


        $this->line('------------- Rolleri Ayarlama:');

        foreach ($roles as $role) {
            $role = Role::updateOrCreate(['name' => $role, 'guard_name' => 'web']);
            $this->info($role->name . " Role Oluşturuldu");
        }

        $this->line('------------- İzinleri Ayarlama:');

        $superAdminRole = Role::where('name', "super-admin")->first();

        foreach ($permissions as $perm_name) {
            $permission = Permission::updateOrCreate(['name' => $perm_name,
                'guard_name' => 'web']);

            $superAdminRole->givePermissionTo($permission);

            $this->info($permission->name . " Permission Oluşturuldu");
        }

        $this->info("Tüm izinler Süper Admin'e verildi");
        $this->line('------------- Uygulama Önyükleme Tamamlandı.');
    }
}
