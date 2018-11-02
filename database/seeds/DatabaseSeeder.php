<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);

        Model::reguard();
    }

}

class UserTableSeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();
    $data['name']='Administrator';
    $data['email']='julia@krc.karelia.ru';
    $data['password']=bcrypt("111111");
    $data['status']='admin';
    $user=User::create($data);
    $user->save();
  }

}
