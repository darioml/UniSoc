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

    $imperial = new UniSoc\Model\College($app, "1");

   // var_dump($imperial->getSocs());



    return $app['twig']->render('index.html.twig');
})->bind('homepage');


$app->match('/testBED', function() use($app) {
	$SOC = new UniSoc\Model\Society($app, "15");
	$uid = '8';
	$SOC->setRelationship($uid, '0');
	 return $app['twig']->render('test.html.twig', array( 
    ));;
});



$app->match('/ImperialCollege', function() use($app) {
	$imperial = new UniSoc\Model\College($app, "1");
	$societies = $imperial->getSocs();
	//var_dump($societies);
	return $app['twig']->render('societies.html.twig', array( 'societies' => $societies,
    ));;
});

$app->match('/Society/{sid}', function($sid) use($app) {
	$society = new UniSoc\Model\Society($app, "$sid");
	$members = $society->getMembersSoc();
	return $app['twig']->render('societyhome.html.twig', array( 'members' => $members
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

	return $app['twig']->render('register.html.twig', array( 
    ));;
})->bind('register');


//REGISTER STEP 1

$app->match('/register/fblogin', function() use($app) {
   		//This page loads the user data from facebook and then makes a local user using the facebook data.
   		//It then forwards to the next step (/unisoc/web/register/step2)
   		//Or if it cant login to facebook it 
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

			$user_profile = $facebook->api('/me?fields=email,id,first_name,last_name,picture','GET');
			//$user_profile =  $user_profile['data'];
		
			$newUser = new UniSoc\Model\UserModel($app, null);
			
			$newUser->addUser($user_profile['id'], $user_profile['email'], $user_profile['first_name'], $user_profile['last_name'], $user_profile['picture']['data']['url'], 0);
			//echo ('Hello' . $user_profile['id'] . $user_profile['email'] . $user_profile['first_name'].  $user_profile['last_name']. $user_profile['picture']['data']['url']);
			
			
			$app['session']->set('user', array('uid' => $user_profile['id'] ));
			
			return($app->redirect('/unisoc/web/register/step2'));
		  } catch(FacebookApiException $e) {
			// If the user is logged out, you can have a 
			// user ID even though the access token is invalid.
			// In this case, we'll get an exception, so we'll
			// just ask the user to login again here.
	 
			$params = array(
			'scope' => 'user_groups, email, friends_likes'
				);
			
			$login_url = $facebook->getLoginUrl($params); 
			return($app->redirect($login_url));
			
			//error_log($e->getType());
			//error_log($e->getMessage());
		  }   
		} else {

		  // No user, print a link for the user to login
		  $params = array(
			'scope' => 'user_groups, email, friends_likes'
				);
		
		  $login_url = $facebook->getLoginUrl($params);
		  return($app->redirect($login_url));
		}
	
   
    /*if ($app['db']->insert('users', array('col'=>'something')))
    {
      
      return $app->redirect('/register/step2');
    }else{
    $error = "Username is in use";
    } */
  
	
	return( $app->redirect('/unisoc/web/register'));;
	
})->bind('register-fblogin');

//REGISTER STEP 2

$app->match('/register/step2', function() use($app) {
	if (null === $user = $app['session']->get('user')) {
		echo 'Invalid Session --- redirecting ...';
        return $app->redirect('/unisoc/web/register');
    }
    $uid = $user['uid'];    
	if ($app['request']->getMethod() == "POST") {
	$Society_Name = $app['request']->get('Society_Name');
	$cid = $app['request']->get('University');
	$Society_Webpage = $app['request']->get('Society_Webpage');
	
	//echo $Society_Name . $cid . $Society_Webpage;
	
	$College = new UniSoc\Model\College($app, $cid);
	$sid = $College->addSoc($uid, $Society_Name, 0, $Society_Webpage);
	$app['session']->set('user', array('uid' => $uid , 'sid' => $sid ));
	return( $app->redirect('/unisoc/web/register/step3'));;
	}
 	$colleges = $app['db']->fetchAll("SELECT cid, name FROM college" );
	return $app['twig']->render('register2.html.twig', array( 'colleges' => $colleges
    ));;
})->bind('register2');


//REGISTER STEP 3 

$app->match('/register/step3', function() use($app) {
	if (null === $user = $app['session']->get('user')) {
		echo 'Invalid Session --- redirecting ...';
        return $app->redirect('/unisoc/web/register');
    }
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
	if (null === $user = $app['session']->get('user')) {
		echo 'Invalid Session --- redirecting ...';
        return $app->redirect('/unisoc/web/register');
    }
    $uid = $user['uid'];    
    $sid = $user['sid'];  
    
	if ($app['request']->getMethod() == "POST") {
	$exec_members = $app['request']->get('exec_members');
	
	if(empty($exec_members)) { return( 'Please select someone to be on the exec');  }
	else{
		$SOC = new UniSoc\Model\Society($app, $sid);
		
		
		if (is_array($exec_members ))
		{
			foreach ($exec_members as $exec_member)
			{
				
				if (!($exec_member == $uid))
					{
					$SOC->setRelationship($exec_member, '1');
					}
					
			}
		} 
	}
	
		return(1);
	}
	
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



$app->match('/register/complete', function() use ($app) {
    if (null === $user = $app['session']->get('user')) {
		echo 'Invalid Session --- redirecting ...';
        return $app->redirect('/unisoc/web/register');
    }
   
    $uid = $user['uid'];    
    $sid = $user['sid'];  
 	
    return $app['twig']->render('registercomplete.html.twig', 
		array(  
			'uid' => $uid,
			'sid' => $sid
    ));;
})->bind('complete');

$app->match('/user/{uid}', function($uid) use ($app) {
    if (null === $user = $app['session']->get('user')) {
		echo 'Invalid Session --- redirecting ...';
        return $app->redirect('/unisoc/web/register');
    }
   
    $uid = $user['uid'];    
    $sid = $user['sid'];  
    $CurrentUser = new UniSoc\Model\UserModel($app, $uid);
 	$Societies = $CurrentUser->getSocs();
 	$Permissions = $CurrentUser->getRoles();
    return $app['twig']->render('user.html.twig', 
		array(  
			'uid' => $uid,
			'sid' => $sid,
			'Societies' => $Societies,
			'Permissions' => $Permissions
    ));;
})->bind('user');





$app->match('/logout', function() use ($app) {
    $app['session']->clear();

    return $app->redirect($app['url_generator']->generate('homepage'));
})->bind('logout');

return $app;
