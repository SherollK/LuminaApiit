// database/seeders/UserAndProfileSeeder.php
<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;

class UserAndProfileSeeder extends Seeder
{
    public function run()

    //3 Alumini users 
        //a lawyer 
        //a software engineer 
        //a Buissness owner. 
    //6 students 
        //a law school students in first year who just wanna have fun 
        //a computer science student in second year who is actively looking for industrail opportunities 
        //a buissness student needing ideas for her project 
        //student looking to find good cafes around the uni to eat 
        //study oriented students needing fun events to go to as they are new to network 
        //Story shared by a student about how they started to enjoy their work 
        //

    //5 content creator admins 
        //their posts show under their profile 
        //APIIT CANteen 
        //Fullstack computer society 
        //Resolver's club 
        //Toastmaster's club 
        //A lecturer 
        //APIIT lost and found 
        //have the wellness instrctor post posts and stuff. 
        

    //categories 
        // basic ones 
        //parameters to see how much they have been used. 
        //posts need to have main categories and thats how sub categories work 
        //but the small ones can be used to see whats been used the most and you can search them up . 
        //when you reigster they the list should be smaller. 
        //but for posts it should be longer. //have current categories. 

    
    //add hide property to posts 
    //make location nullable in the userprofile database 




    //1 category management admin 
    //1 user management admin //they shouldnt be able to post atleast from the backend
    {
        $users = [
            [
                'name' => 'Resolvers Club',
                'email' => 'Resolvers@apiit.lk',
                'password' => Hash::make('password'),
                'profile' => [
                    'jobDescription' => 'Resolvers are a club',
                    'bio' => "Resolvers Movement, aims to cultivate future leaders who are grounded, passionate, kind empathizers who can think critically and solve problems. The goal of this project is to produce leaders who use both classroom knowledge and real-world experiences to improve society."
                ]
            ],
            //Alumini
            [
                'name' => 'Jagath Perera',
                'email' => 'jagath@example.com',
                'password' => Hash::make('password'),
                'profile' => [
                'location' => "APIIT School of Computing",
                  'jobDescription' => 'Project Manager',
                    'bio' => "A project manager : professional tasked with planning, executing, and concluding
                    projects. They play a crucial role in making sure that projects are finished on schedule,
                    within the allocated budget, and meet the expected quality standards. Project managers
                    work across various industries, including construction, IT, healthcare, and finance,
                    demonstrating their role's versatility and critical nature. Essentially, they are the bridge"
                ]
            ],
            // Add 8 more users with their profiles here
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@example.com',
                'password' => Hash::make('password'),
                'profile' => [
                    'jobDescription' => 'Data Scientist',
                    'level' => 'Junior',
                    'location' => 'Chicago',
                    'bio' => 'Data scientist with a love for big data and machine learning.'
                ]
            ],
            [
                'name' => 'Bob Brown',
                'email' => 'bob.brown@example.com',
                'password' => Hash::make('password'),
                'profile' => [
                    'jobDescription' => 'DevOps Engineer',
                    'level' => 'Senior',
                    'location' => 'Austin',
                    'bio' => 'Expert in cloud infrastructure and continuous integration.'
                ]
            ],
            [
                'name' => 'Cathy Wilson',
                'email' => 'cathy.wilson@example.com',
                'password' => Hash::make('password'),
                'profile' => [
                    'jobDescription' => 'UI/UX Designer',
                    'level' => 'Mid',
                    'location' => 'Seattle',
                    'bio' => 'Designer focused on creating intuitive user experiences.'
                ]
            ],
            [
                'name' => 'David Lee',
                'email' => 'david.lee@example.com',
                'password' => Hash::make('password'),
                'profile' => [
                    'jobDescription' => 'Product Manager',
                    'level' => 'Senior',
                    'location' => 'Los Angeles',
                    'bio' => 'Product manager with a keen eye for market trends and user needs.'
                ]
            ],
            [
                'name' => 'Ella Martinez',
                'email' => 'ella.martinez@example.com',
                'password' => Hash::make('password'),
                'profile' => [
                    'jobDescription' => 'Quality Assurance Engineer',
                    'level' => 'Junior',
                    'location' => 'Denver',
                    'bio' => 'QA engineer dedicated to ensuring software quality and reliability.'
                ]
            ],
            [
                'name' => 'Frank Kim',
                'email' => 'frank.kim@example.com',
                'password' => Hash::make('password'),
                'profile' => [
                    'jobDescription' => 'Network Engineer',
                    'level' => 'Mid',
                    'location' => 'Boston',
                    'bio' => 'Network engineer with a deep understanding of network security and protocols.'
                ]
            ],
            [
                'name' => 'Grace Wong',
                'email' => 'grace.wong@example.com',
                'password' => Hash::make('password'),
                'profile' => [
                    'jobDescription' => 'Cybersecurity Analyst',
                    'level' => 'Senior',
                    'location' => 'Washington D.C.',
                    'bio' => 'Cybersecurity expert specializing in threat analysis and mitigation.'
                ]
            ],
            [
                'name' => 'Henry Davis',
                'email' => 'henry.davis@example.com',
                'password' => Hash::make('password'),
                'profile' => [
                    'jobDescription' => 'Full Stack Developer',
                    'level' => 'Mid',
                    'location' => 'Houston',
                    'bio' => 'Full stack developer proficient in both front-end and back-end technologies.'
                ]
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            UserProfile::create([
                'user_id' => $user->id,
                'jobDescription' => $userData['profile']['jobDescription'],
                'level' => $userData['profile']['level'],
                'location' => $userData['profile']['location'],
                'bio' => $userData['profile']['bio'],
            ]);
        }
    }
}


