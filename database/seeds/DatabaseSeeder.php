<?php

use Illuminate\Database\Seeder;
use App\Mahasiswa;
use App\Buku;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker\Factory::create();

		$jumlah_mahasiswa = 24;
		for ($i=1; $i < $jumlah_mahasiswa; $i++) { 
			$mahasiswa = new Mahasiswa;
			$mahasiswa->nama = $faker->name;
			$mahasiswa->nim = $faker->numerify('3.34.15.0.##');
			$mahasiswa->email = $faker->email;
			$mahasiswa->foto = $faker->imageUrl($width = 640, $height = 480);
			$mahasiswa->save();
		}

        $jumlah_buku = 10;
        for ($i=1; $i < $jumlah_buku; $i++) { 
            $buku = new Buku;
            $buku->judul = $faker->title;
            $buku->pengarang = $faker->name;
            $buku->tahun = $faker->year;
            $buku->save();
        }
    }
}
