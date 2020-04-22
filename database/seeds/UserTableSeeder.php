<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Gary Riehle';
        $user->email = 'gary.riehle@nef1.org';
        $user->password = bcrypt('mynef');
        $user->save();

        $user = new User();
        $user->name = 'Elissa Richards';
        $user->email = 'elissa@nef1.org';
        $user->password = bcrypt('mynef');
        $user->save();

        $user = new User();
        $user->name = 'Wayne Bonner';
        $user->email = 'wayne@nef1.org';
        $user->password = bcrypt('mynef');
        $user->save();


    }
}
