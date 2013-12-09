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
  if ($app['request']->getMethod() == "POST") {
    if ($app['db']->insert('user', array('col'=>'something')))
    {
      $app['session']->set('user', array('username' => $username));
      return $app->redirect('/register/step2');
    }
    $error = "Username is in use";
    
  }

	return $app['twig']->render('register.html.twig', array('error' => @$error
    ));;
})->bind('register');

$app->match('/register/step2', function() use($app) {


	return $app['twig']->render('register2.html.twig', array( 
    ));;
})->bind('register2');

$app->match('/register/step3', function() use($app) {
	
	$user_fullname = 0;
	$user_groups = 0;
	$logout_url = 0;
	$login_url = 0;
	
	$config = array(
		'appId' => '543632092324983',
		'secret' => '3eb57dbdf332061afa7ca71297b0c7b0',
	  );
	$facebook = new Facebook($config);
	$user_id = $facebook->getUser();
	if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $user_profile = $facebook->api('/me','GET');
        $user_fullname =  $user_profile['name'];
       
        $params = array( 'next' => 'http://www.jackfarrant.com/SocManLogout.php' );
		$logout_url = $facebook->getLogoutUrl($params); 
        
        
        $user_groups = $facebook->api('/me/groups','GET');
        	

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
         
        $params = array(
  		'scope' => 'user_groups'
			);
        $login_url = $facebook->getLoginUrl($params); 
        //error_log($e->getType());
        //error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
      $params = array(
  		'scope' => 'user_groups'
			);

      $login_url = $facebook->getLoginUrl($params);
    }

	return $app['twig']->render('register3.html.twig', 
		array( 
			'user_fullname' => $user_fullname , 
			'user_groups' => $user_groups,
			'logout_url' => $logout_url,
			'login_url' => $login_url
    ));;
})->bind('register3');

$app->match('/register/step3/{gid}', function($gid) use($app) {
	
	$config = array(
		'appId' => '543632092324983',
		'secret' => '3eb57dbdf332061afa7ca71297b0c7b0',
	  );
	$facebook = new Facebook($config);
	$group_name_data = $facebook->api("/$gid/?field=name");
	$group_name = $group_name_data['name'];

	$params = array(
        'method' => 'fql.query',
        'query' => "SELECT name, id, url, pic_square FROM profile WHERE id IN (SELECT uid from group_member where gid=$gid)",
	);
	
	$group_members_data = $facebook->api($params);

	return $app['twig']->render('register4.html.twig', 
		array(  
			'group_name' => $group_name,
			'group_members_data' => $group_members_data
    ));;
});


$app->match('/logout', function() use ($app) {
    $app['session']->clear();

    return $app->redirect($app['url_generator']->generate('homepage'));
})->bind('logout');

return $app;
