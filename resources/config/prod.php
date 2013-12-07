<?php

date_default_timezone_set('gmt');

// Environments - Database and such
require __DIR__.'/environment.php';

// Local
$app['locale'] = 'en';
$app['session.default_locale'] = $app['locale'];
$app['translator.messages'] = array(
    'fr' => __DIR__.'/../resources/locales/fr.yml',
);

// Cache
$app['cache.path'] = __DIR__ . '/../cache';

// Http cache
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

// Twig cache
$app['twig.options.cache'] = false; //$app['cache.path'] . '/twig';

// User
$app['security.users'] = array('username' => array('ROLE_USER', 'password'));
