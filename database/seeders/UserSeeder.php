<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'),
            'bio' => 'Experienced Laravel Developer',
            'skill' => 'Laravel, PHP, MySQL',
        ]);
        User::create([
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'password' => Hash::make('securepass'),
            'bio' => 'Frontend Engineer',
            'skill' => 'Vue, React, Tailwind',
        ]);
        User::create([
            'name' => 'Alice Johnson',
            'email' => 'alicejohnson@example.com',
            'password' => Hash::make('alicepass'),
            'bio' => 'Backend Developer',
            'skill' => 'Node.js, Express, MongoDB',
        ]);
        User::create([
            'name' => 'Bob Williams',
            'email' => 'bobwilliams@example.com',
            'password' => Hash::make('bobsecure'),
            'bio' => 'Full Stack Developer',
            'skill' => 'Angular, Laravel, PostgreSQL',
        ]);
        User::create([
            'name' => 'Charlie Brown',
            'email' => 'charliebrown@example.com',
            'password' => Hash::make('charlie123'),
            'bio' => 'Mobile App Developer',
            'skill' => 'Flutter, Dart, Firebase',
        ]);
        User::create([
            'name' => 'Diana Prince',
            'email' => 'dianaprince@example.com',
            'password' => Hash::make('wonderwoman'),
            'bio' => 'UI/UX Designer',
            'skill' => 'Figma, Sketch, Adobe XD',
        ]);
        User::create([
            'name' => 'Ethan Hunt',
            'email' => 'ethanhunt@example.com',
            'password' => Hash::make('mission123'),
            'bio' => 'DevOps Engineer',
            'skill' => 'Docker, Kubernetes, AWS',
        ]);
        User::create([
            'name' => 'Fiona Gallagher',
            'email' => 'fionagallagher@example.com',
            'password' => Hash::make('fionapass'),
            'bio' => 'Data Scientist',
            'skill' => 'Python, R, TensorFlow',
        ]);
        User::create([
            'name' => 'George Martin',
            'email' => 'georgemartin@example.com',
            'password' => Hash::make('georgepass'),
            'bio' => 'Game Developer',
            'skill' => 'Unity, C#, Unreal Engine',
        ]);
        User::create([
            'name' => 'Hannah Lee',
            'email' => 'hannahlee@example.com',
            'password' => Hash::make('hannahsecure'),
            'bio' => 'AI Engineer',
            'skill' => 'Machine Learning, AI, Python',
        ]);
        User::create([
            'name' => 'Ian Wright',
            'email' => 'ianwright@example.com',
            'password' => Hash::make('ianwright123'),
            'bio' => 'Cybersecurity Specialist',
            'skill' => 'Penetration Testing, Network Security, Cryptography',
        ]);
        User::create([
            'name' => 'Julia Roberts',
            'email' => 'juliaroberts@example.com',
            'password' => Hash::make('juliaroberts'),
            'bio' => 'Cloud Architect',
            'skill' => 'Azure, AWS, Google Cloud',
        ]);
    }
}
