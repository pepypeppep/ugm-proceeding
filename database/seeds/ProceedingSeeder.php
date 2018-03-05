<?php

use Illuminate\Database\Seeder;
use App\Subject;
use App\User;

class ProceedingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Proceeding::class, 18)->create()->each(function($p)
        {
            $subject = Subject::all()->pluck('id');
            $user = User::all()->pluck('id');

        	$p->article()
        		->createMany(factory(App\Article::class, rand(8, 13))->make()->toArray())
        		->each(function($a)
	        	{
	        		$a->author()
	        			->createMany(factory(App\Author::class, rand(1, 5))->make()->toArray());

                    if (collect([false, true, false])->random()) {
                        $a->indexation()
                        ->save(factory(App\Indexation::class)->make());
                    }
	        	});
            $p->subject()->attach([$subject->random(), $subject->random()]);
    		$p->owner()->attach([$user->random()]);
        });
    }
}
