<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15/02/16
 * Time: 18:50
 */

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Resources')
    ->exclude('Tests')
    ->in('src/AppBundle/')
;

return new Sami($iterator, array(
    'title'                => 'CRUD Contacts',
    'build_dir'            => __DIR__.'/../../doc',
    'cache_dir'            => __DIR__.'/../../cache')
);