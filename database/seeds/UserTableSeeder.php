<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Images.
     *
     * @var array
     */
    protected $imageArray = [];

    /**
     * Create a new instance of the UserTableSeeder.
     */
    public function __construct() {
        $image1 = asset('profiles/avatars/avatar1.jpeg');
        $image2 = asset('profiles/avatars/avatar2.jpeg');
        $image3 = asset('profiles/avatars/avatar3.jpeg');
        $image4 = asset('profiles/avatars/avatar4.jpeg');

        $this->imageArray[] = $image1;
        $this->imageArray[] = $image2;
        $this->imageArray[] = $image3;
        $this->imageArray[] = $image4;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 3; $i++) {
            $user = User::create([
                'username' => $faker->name,
                'email' => $i === 0 ? 'admin@gmail.com' : $faker->email,
                'password' => $i === 0 ? bcrypt('password') : bcrypt(str_random(10)),
                'status' => $i === 0 ? true : rand(0, 1),
                'avatar' => $faker->randomElement($this->imageArray)
            ]);
        }
    }
}
