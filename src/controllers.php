<?php

use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

$app->match('/', function() use ($app) {
    /*$app['session']->getFlashBag()->add('warning', 'Warning flash message');
    $app['session']->getFlashBag()->add('info', 'Info flash message');
    $app['session']->getFlashBag()->add('success', 'Success flash message');
    $app['session']->getFlashBag()->add('error', 'Error flash message');*/

    $imperial = new UniSoc\Model\University($app, "1");

   // var_dump($imperial->getSocs());



    return $app['twig']->render('index.html.twig');
})->bind('homepage');


$app->match('/hello', function() use($app) {
	 return $app['twig']->render('test.html.twig', array( 
    ));;
});



$app->match('/ImperialCollege', function() use($app) {
	$imperial = new UniSoc\Model\University($app, "1");
	$societies = $imperial->getSocs();
	//var_dump($societies);
	return $app['twig']->render('societies.html.twig', array( 'societies' => $societies,
    ));;
});

$app->match('/login', function(Request $request) use ($app) {
    $form = $app['form.factory']->createBuilder('form')
        ->add('username', 'text', array('label' => 'Username', 'data' => $app['session']->get('_security.last_username')))
        ->add('password', 'password', array('label' => 'Password'))
        ->getForm()
    ;

    return $app['twig']->render('login.html.twig', array(
        'form'  => $form->createView(),
        'error' => $app['security.last_error']($request),
    ));
})->bind('login');

$app->match('/register', function() use($app) {

	//var_dump($societies);
	return $app['twig']->render('register.html.twig', array( 
    ));;
})->bind('register');

$app->match('/logout', function() use ($app) {
    $app['session']->clear();

    return $app->redirect($app['url_generator']->generate('homepage'));
})->bind('logout');

return $app;
