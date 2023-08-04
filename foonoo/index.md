---
title: Welcome
layout: project_home
---

<div class="larger-text">
ClearIce provides tools that allow PHP applications to parse command line arguments, and perform interactive I/O sessions. Arguments supplied at the command line, or through a shell are validated and supplied to your script in an organized format, with the added possibility of automatically generating help messages for your command line applications. 
</div>

## Installing
The preferred way to install ClearIce is through composer. You can require the [ekowabaka/clearice](http://packagist.org/packages/ekowabaka/clearice) dependency in your application.

    composer require ekowabaka/clearice

## Start with an example
For example, the following script ...

````php
<?php
require "vendor/autoload.php";

$parser = new \clearice\argparser\ArgumentParser();
$parser->addOption([
    'name' => 'input',
    'short_name' => 'i',
    'type' => 'string',
    'required' => true
]);

$parser->addOption([
    'name' => 'output',
    'short_name' => 'o',
    'type' => 'string',
    'default' => '/default/output/path'
]);

$options = $parser->parse($argv);
print_r($options);
````

... when executed as ...

    php wiki.php generate --input=/home/james --output=/var/www/cool-wiki

... produces ...

    Array
    (
        [input] => /input/path
        [output] => /output/path
        [__executed] => wiki.php
    )

... and so will the following:

    php test.php --input /input/path --output /output/path
    php test.php -i/input/path -o/output/path

For interactive I/O, the following script ...

````php
use clearice\io\Io;
$io = new Io();
$name = $io->getResponse('What is your name', ['default' => 'No Name']);

$direction = $io->getResponse("Okay $name, where do you want to go", 
    [
        'required' => true,
        'answers' => array('north', 'south', 'east', 'west')
    ]
); 
````

... could lead to an interaction like this:

    What is your name [No Name]: ⏎
    Okay No Name, where do you want to go (north/south/east/west) []: ⏎
    A value is required.
    Okay No Name, where do you want to go (north/south/east/west) []: home⏎
    Please provide a valid answer.
    Okay No Name, where do you want to go (north/south/east/west) []: 

