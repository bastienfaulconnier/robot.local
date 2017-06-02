<?php

use Illuminate\Database\Seeder;

class RobotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//images
    	$uploads = public_path('images');
    	$files = File::allFiles($uploads);

    	foreach ($files as $file) {
    		File::delete($file);
    	}

        factory(App\Robot::class, 10)->create()->each(function($robot) use($uploads) {

        	// tags
        	$nbTags = App\Tag::all()->count();
        	$indices = [];
        	$max = rand(1, $nbTags);

        	while (count($indices) != $max ) {
        		$tagId = rand(1, $max);

        		while (in_array($tagId, $indices)) {
        			$tagId = rand(1, $max);

        		}

        		$indices[] = $tagId;
        	}

        	// on met des tags à un robot
        	$robot->tags()->attach($indices);

        	// on met une image à un robot
        	$uri = str_random(12) . '.jpg';

        	$image= file_get_contents('http://lorempicsum.com/futurama/400/200/' . rand(1,9));

        	//file_put_contents($uploads. '/' . $uri, $image);

        	File::put($uploads. DIRECTORY_SEPARATOR . $uri, $image);

        	$robot->link = $uri;
        	$robot->save();
        });
    }
}
