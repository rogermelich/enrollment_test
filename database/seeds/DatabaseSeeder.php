<?php

use Illuminate\Database\Seeder;
use Scool\Curriculum\Database\Seeds\CurriculumSeeder;
use Scool\Curriculum\Database\Seeds\LawsTableSeeder;
use Scool\Curriculum\Database\Seeds\SubmoduleTypesTableSeeder;
use Scool\Enrollment\Database\Seeds\EnrollmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EnrollmentSeeder::class);
        $this->call(CurriculumSeeder::class);
        $this->call(LawsTableSeeder::class);
        $this->call(SubmoduleTypesTableSeeder::class);
    }
}
