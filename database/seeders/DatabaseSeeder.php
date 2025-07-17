<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'is_admin' => true
        ]);
        
        // Seed tags from array
        $tags = [
            'sports', 'music', 'movies', 'technology', 'travel', 'food',
            'fashion', 'education', 'health', 'gaming', 'art', 'science',
            'nature', 'books', 'business', 'finance', 'politics', 'history',
            'photography', 'fitness', 'relationships', 'spirituality', 'humor', 'news', 'culture'
        ];

        foreach ($tags as $tagName) {
            \App\Models\Tag::firstOrCreate(['name' => $tagName]);
        }

        // Famous people seed data
        $famousPeople = [
            [ 'name' => 'Lionel Messi', 'username' => 'lmessi', 'email' => 'messi@sports.com', 'bio' => 'World-renowned football player.', 'tag' => 'sports' ],
            [ 'name' => 'Cristiano Ronaldo', 'username' => 'cronaldo', 'email' => 'ronaldo@sports.com', 'bio' => 'Legendary football player.', 'tag' => 'sports' ],
            [ 'name' => 'Kylian Mbappé', 'username' => 'kmbappe', 'email' => 'mbappe@sports.com', 'bio' => 'French football superstar.', 'tag' => 'sports' ],
            [ 'name' => 'Taylor Swift', 'username' => 'tswift', 'email' => 'taylor@music.com', 'bio' => 'International pop singer and songwriter.', 'tag' => 'music' ],
            [ 'name' => 'Shakira', 'username' => 'shakira', 'email' => 'shakira@music.com', 'bio' => 'Colombian singer and performer.', 'tag' => 'music' ],
            [ 'name' => 'Ed Sheeran', 'username' => 'edsheeran', 'email' => 'ed@music.com', 'bio' => 'British singer-songwriter.', 'tag' => 'music' ],
            [ 'name' => 'BTS', 'username' => 'bts', 'email' => 'bts@music.com', 'bio' => 'Global K-pop sensation.', 'tag' => 'music' ],
            [ 'name' => 'Leonardo DiCaprio', 'username' => 'leodicaprio', 'email' => 'leo@movies.com', 'bio' => 'Oscar-winning actor and environmentalist.', 'tag' => 'movies' ],
            [ 'name' => 'Tom Cruise', 'username' => 'tomcruise', 'email' => 'tom@movies.com', 'bio' => 'Hollywood action star.', 'tag' => 'movies' ],
            [ 'name' => 'Jennifer Lawrence', 'username' => 'jlawrence', 'email' => 'jlaw@movies.com', 'bio' => 'Academy Award-winning actress.', 'tag' => 'movies' ],
            [ 'name' => 'Morgan Freeman', 'username' => 'mfreeman', 'email' => 'morgan@movies.com', 'bio' => 'Iconic actor and narrator.', 'tag' => 'movies' ],
            [ 'name' => 'Emma Watson', 'username' => 'emmawatson', 'email' => 'emma@movies.com', 'bio' => 'Actress and activist.', 'tag' => 'movies' ],
            [ 'name' => 'Elon Musk', 'username' => 'elonmusk', 'email' => 'elon@technology.com', 'bio' => 'Entrepreneur and innovator in tech.', 'tag' => 'technology' ],
            [ 'name' => 'Mark Zuckerberg', 'username' => 'mzuckerberg', 'email' => 'mark@technology.com', 'bio' => 'Co-founder of Facebook.', 'tag' => 'technology' ],
            [ 'name' => 'Bill Gates', 'username' => 'billgates', 'email' => 'bill@business.com', 'bio' => 'Co-founder of Microsoft and philanthropist.', 'tag' => 'business' ],
            [ 'name' => 'Jeff Bezos', 'username' => 'jbezos', 'email' => 'jeff@business.com', 'bio' => 'Founder of Amazon.', 'tag' => 'business' ],
            [ 'name' => 'Oprah Winfrey', 'username' => 'oprah', 'email' => 'oprah@business.com', 'bio' => 'Media mogul and philanthropist.', 'tag' => 'business' ],
            [ 'name' => 'Barack Obama', 'username' => 'barackobama', 'email' => 'obama@politics.com', 'bio' => '44th President of the United States.', 'tag' => 'politics' ],
            [ 'name' => 'Angela Merkel', 'username' => 'amerkel', 'email' => 'angela@politics.com', 'bio' => 'Former Chancellor of Germany.', 'tag' => 'politics' ],
            [ 'name' => 'Kamala Harris', 'username' => 'kharris', 'email' => 'kamala@politics.com', 'bio' => 'Vice President of the United States.', 'tag' => 'politics' ],
            [ 'name' => 'Malala Yousafzai', 'username' => 'malala', 'email' => 'malala@education.com', 'bio' => 'Nobel laureate and education activist.', 'tag' => 'education' ],
            [ 'name' => 'Stephen Hawking', 'username' => 'shawking', 'email' => 'hawking@science.com', 'bio' => 'Theoretical physicist and cosmologist.', 'tag' => 'science' ],
            [ 'name' => 'Greta Thunberg', 'username' => 'gthunberg', 'email' => 'greta@nature.com', 'bio' => 'Climate activist.', 'tag' => 'nature' ],
            [ 'name' => 'Usain Bolt', 'username' => 'usainbolt', 'email' => 'usain@sports.com', 'bio' => 'Fastest man in the world.', 'tag' => 'sports' ],
            [ 'name' => 'LeBron James', 'username' => 'ljames', 'email' => 'lebron@sports.com', 'bio' => 'Basketball superstar.', 'tag' => 'sports' ],
            [ 'name' => 'Adele', 'username' => 'adele', 'email' => 'adele@music.com', 'bio' => 'Grammy-winning singer.', 'tag' => 'music' ],
            [ 'name' => 'Rihanna', 'username' => 'rihanna', 'email' => 'rihanna@music.com', 'bio' => 'Pop and R&B singer.', 'tag' => 'music' ],
            [ 'name' => 'Lady Gaga', 'username' => 'ladygaga', 'email' => 'gaga@music.com', 'bio' => 'Pop icon and actress.', 'tag' => 'music' ],
            [ 'name' => 'Bruno Mars', 'username' => 'brunomars', 'email' => 'bruno@music.com', 'bio' => 'Singer-songwriter and performer.', 'tag' => 'music' ],
            [ 'name' => 'Chris Hemsworth', 'username' => 'chemsworth', 'email' => 'chris@movies.com', 'bio' => 'Actor known for Thor.', 'tag' => 'movies' ],
            [ 'name' => 'Scarlett Johansson', 'username' => 'sjohansson', 'email' => 'scarlett@movies.com', 'bio' => 'Award-winning actress.', 'tag' => 'movies' ],
            [ 'name' => 'Dwayne Johnson', 'username' => 'therock', 'email' => 'rock@movies.com', 'bio' => 'Actor and former wrestler.', 'tag' => 'movies' ],
            [ 'name' => 'Zendaya', 'username' => 'zendaya', 'email' => 'zendaya@movies.com', 'bio' => 'Actress and singer.', 'tag' => 'movies' ],
            [ 'name' => 'Keanu Reeves', 'username' => 'keanureeves', 'email' => 'keanu@movies.com', 'bio' => 'Actor known for Matrix and John Wick.', 'tag' => 'movies' ],
            [ 'name' => 'Simone Biles', 'username' => 'sbiles', 'email' => 'simone@sports.com', 'bio' => 'Olympic gymnast.', 'tag' => 'sports' ],
            [ 'name' => 'Roger Federer', 'username' => 'rfederer', 'email' => 'roger@sports.com', 'bio' => 'Tennis legend.', 'tag' => 'sports' ],
            [ 'name' => 'Lewis Hamilton', 'username' => 'lhamilton', 'email' => 'lewis@sports.com', 'bio' => 'Formula 1 champion.', 'tag' => 'sports' ],
            [ 'name' => 'Virat Kohli', 'username' => 'vkohli', 'email' => 'virat@sports.com', 'bio' => 'Cricket superstar.', 'tag' => 'sports' ],
            [ 'name' => 'Novak Djokovic', 'username' => 'djokovic', 'email' => 'novak@sports.com', 'bio' => 'Tennis champion.', 'tag' => 'sports' ],
            [ 'name' => 'Michael Phelps', 'username' => 'mphelps', 'email' => 'michael@sports.com', 'bio' => 'Olympic swimmer.', 'tag' => 'sports' ],
            [ 'name' => 'Serena Williams', 'username' => 'serenawilliams', 'email' => 'serena@sports.com', 'bio' => 'Champion tennis player.', 'tag' => 'sports' ],
            [ 'name' => 'PewDiePie', 'username' => 'pewdiepie', 'email' => 'pewdiepie@gaming.com', 'bio' => 'Top YouTuber and gamer.', 'tag' => 'gaming' ],
            [ 'name' => 'Ninja', 'username' => 'ninja', 'email' => 'ninja@gaming.com', 'bio' => 'Professional gamer and streamer.', 'tag' => 'gaming' ],
            [ 'name' => 'Tim Cook', 'username' => 'tcook', 'email' => 'tim@technology.com', 'bio' => 'CEO of Apple.', 'tag' => 'technology' ],
            [ 'name' => 'Satya Nadella', 'username' => 'snadella', 'email' => 'satya@technology.com', 'bio' => 'CEO of Microsoft.', 'tag' => 'technology' ],
            [ 'name' => 'Jack Ma', 'username' => 'jackma', 'email' => 'jack@business.com', 'bio' => 'Founder of Alibaba.', 'tag' => 'business' ],
            [ 'name' => 'Warren Buffett', 'username' => 'wbuffett', 'email' => 'warren@business.com', 'bio' => 'Investor and philanthropist.', 'tag' => 'business' ],
            [ 'name' => 'J.K. Rowling', 'username' => 'jkrowling', 'email' => 'jk@books.com', 'bio' => 'Author of Harry Potter.', 'tag' => 'books' ],
            [ 'name' => 'Stephen King', 'username' => 'sking', 'email' => 'stephen@books.com', 'bio' => 'Prolific horror author.', 'tag' => 'books' ],
            [ 'name' => 'Neil deGrasse Tyson', 'username' => 'ndtyson', 'email' => 'neil@science.com', 'bio' => 'Astrophysicist and science communicator.', 'tag' => 'science' ],
            [ 'name' => 'Jane Goodall', 'username' => 'jgoodall', 'email' => 'jane@nature.com', 'bio' => 'Primatologist and conservationist.', 'tag' => 'nature' ],
            [ 'name' => 'David Attenborough', 'username' => 'dattenborough', 'email' => 'david@nature.com', 'bio' => 'Natural historian and broadcaster.', 'tag' => 'nature' ],
            [ 'name' => 'Michelle Obama', 'username' => 'micheleobama', 'email' => 'michelle@politics.com', 'bio' => 'Former First Lady and author.', 'tag' => 'politics' ],
            [ 'name' => 'Ellen DeGeneres', 'username' => 'ellen', 'email' => 'ellen@humor.com', 'bio' => 'Comedian and talk show host.', 'tag' => 'humor' ],
            [ 'name' => 'Trevor Noah', 'username' => 'trevornoah', 'email' => 'trevor@humor.com', 'bio' => 'Comedian and TV host.', 'tag' => 'humor' ]
        ];

        foreach ($famousPeople as $person) {
            $user = \App\Models\User::firstOrCreate([
                'email' => $person['email']
            ], [
                'name' => $person['name'],
                'username' => $person['username'],
                'is_admin' => false,
                'password' => bcrypt('password')
            ]);

            $profile = \App\Models\Profile::firstOrCreate([
                'user_id' => $user->id
            ], [
                'name' => $person['name'],
                'username' => $person['username'],
                'email' => $person['email'],
                'bio' => $person['bio']
            ]);

            $user->profile_id = $profile->id;
            $user->save();

            $tag = \App\Models\Tag::where('name', $person['tag'])->first();
            if ($tag && $profile) {
                // Attach tag to profile_tag table (many-to-many)
                $profile->tags()->syncWithoutDetaching([$tag->id]);
            }
        }
    }
}
