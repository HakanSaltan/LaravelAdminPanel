<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Seeder;

use App\User;
use App\Ayar;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
	{
		$user=[

			['name'=>'Admin',
			 'email'=>'admin@otogaraj.com',
			 'password'=>'$2y$10$UhxeJDP3pw4nbVRMaVXTR.6Tp.5oyaEBHEQBoXjOvILIxLAsv44yi'
			],

			['name'=>'Üye',
			 'email'=>'uye@otogaraj.com',
			 'password'=>'$2y$10$UhxeJDP3pw4nbVRMaVXTR.6Tp.5oyaEBHEQBoXjOvILIxLAsv44yi'
			],

			['name'=>'Tedarikçi',
			 'email'=>'tedarikci@otogaraj.com',
			 'password'=>'$2y$10$UhxeJDP3pw4nbVRMaVXTR.6Tp.5oyaEBHEQBoXjOvILIxLAsv44yi'
			]

		];
		$userJson=[

			['user_id'=>'2',
			 'ayarJson'=>'{"id":"2","firma_adi":"Kodgarj","firma_sahibi":"Kodgarj","firma_telefon":"05453601002","firma_adresi":"Kurtulu\u015f, Ey\u00fcp Sk. \u00d6zel Neva Fen ve Anadolu Lisesi)","firma_logo":{"yol":"uploads\/5e0bd0f009551","eskiAd":"kodgaraj.png"}}	NULL'
			]

		];
		foreach ($user as $key=>$value){
            User::create($value)->assignRole("uye");
		}
		foreach ($userJson as $key=>$value){
			Ayar::create($value);
		}


	}
}
