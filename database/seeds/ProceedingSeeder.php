<?php

use Illuminate\Database\Seeder;
use App\Subject;

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
        	$p->article()
        		->createMany(factory(App\Article::class, rand(8, 13))->make()->toArray())
        		->each(function($a)
	        	{
	        		$a->author()
	        			->createMany(factory(App\Author::class, rand(1, 5))->make()->toArray());
        			$a->article_identifier()
	        			->save(factory(App\ArticleIdentifier::class)->make());
	        	});
        	$p->editor()
        		->createMany(factory(App\Editor::class, rand(2,3))->make()->toArray());
    		$p->subject()->attach([$subject->random(), $subject->random()]);
        });
    }
}