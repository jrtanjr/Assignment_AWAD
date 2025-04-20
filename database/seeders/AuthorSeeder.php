<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        Author::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('john123'),
            'bio' => 'Experienced Laravel Developer',
            'skill' => 'Laravel, PHP, MySQL',
        ]);
        Author::create([
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'password' => Hash::make('jane456'),
            'bio' => 'Frontend Engineer',
            'skill' => 'Vue, React, Tailwind',
        ]);
        Author::create([
            'name' => 'Alice Johnson',
            'email' => 'alicejohnson@example.com',
            'password' => Hash::make('alicepass'),
            'bio' => 'Backend Developer',
            'skill' => 'Node.js, Express, MongoDB',
        ]);
        Author::create([
            'name' => 'Bob Williams',
            'email' => 'bobwilliams@example.com',
            'password' => Hash::make('bobsecure'),
            'bio' => 'Full Stack Developer',
            'skill' => 'Angular, Laravel, PostgreSQL',
        ]);
        Author::create([
            'name' => 'Charlie Brown',
            'email' => 'charliebrown@example.com',
            'password' => Hash::make('charlie123'),
            'bio' => 'Mobile App Developer',
            'skill' => 'Flutter, Dart, Firebase',
        ]);
        Author::create([
            'name' => 'Diana Prince',
            'email' => 'dianaprince@example.com',
            'password' => Hash::make('wonderwoman'),
            'bio' => 'UI/UX Designer',
            'skill' => 'Figma, Sketch, Adobe XD',
        ]);
        Author::create([
            'name' => 'Ethan Hunt',
            'email' => 'ethanhunt@example.com',
            'password' => Hash::make('mission123'),
            'bio' => 'DevOps Engineer',
            'skill' => 'Docker, Kubernetes, AWS',
        ]);
        Author::create([
            'name' => 'Fiona Gallagher',
            'email' => 'fionagallagher@example.com',
            'password' => Hash::make('fionapass'),
            'bio' => 'Data Scientist',
            'skill' => 'Python, R, TensorFlow',
        ]);
        Author::create([
            'name' => 'George Martin',
            'email' => 'georgemartin@example.com',
            'password' => Hash::make('georgepass'),
            'bio' => 'Game Developer',
            'skill' => 'Unity, C#, Unreal Engine',
        ]);
        Author::create([
            'name' => 'Hannah Lee',
            'email' => 'hannahlee@example.com',
            'password' => Hash::make('hannahsecure'),
            'bio' => 'AI Engineer',
            'skill' => 'Machine Learning, AI, Python',
        ]);
        Author::create([
            'name' => 'Ian Wright',
            'email' => 'ianwright@example.com',
            'password' => Hash::make('ianwright123'),
            'bio' => 'Cybersecurity Specialist',
            'skill' => 'Penetration Testing, Network Security, Cryptography',
        ]);
        Author::create([
            'name' => 'Julia Roberts',
            'email' => 'juliaroberts@example.com',
            'password' => Hash::make('juliaroberts'),
            'bio' => 'Cloud Architect',
            'skill' => 'Azure, AWS, Google Cloud',
        ]);
    }
}
