<?php
namespace UniSoc\Model;


class UserModel
{
    private $app,
        $uid,
        $object;

    function __construct($app, $uid = null)
    {
        $this->app = $app;

        if ($uid != null) {
            $this->uid = $uid;
            $this->dbload();
        }
    }

    function dbload() // load the data from database. Returns true if successful, false otherwise.
    {
        if (!$this->object) //if object is not set...
            if ($this->uid) // and if we have a uni id
                if ($this->object = $this->app['db']->fetchAssoc("SELECT * FROM users WHERE uid = ?", array($this->uid)))
                    return true;
                else
                    $this->object = null; //if we found nothing, let's set it to null to avoid returning false or nulls. This is more memory efficient than other methods..
        return false;
    }

    function addUser($uid, $email, $firstName, $lastName, $image, $permissions = 0) // return all users of Society
    {
    	/*var_dump( array( 
            'uid' => $uid ,
            'email' => $email ,
            'firstsName' => $firstName ,
            'lastName' =>  $lastName ,
            'lastLogin' => 0,
            'registeredOn' => $registeredOn,
            'image' =>  $image ,
            'permissions' => $permissions 
            ));;
        */ 
    
        	$registeredOn = date("Y-m-d H:i:s");
            $lastLogin = date("Y-m-d H:i:s", 0);
            $this->app['db']->insert('users', array( 
            
            'uid' => $uid ,
            'email' => $email ,
            'firstName' => $firstName ,
            'lastName' =>  $lastName ,
            'lastLogin' => $lastLogin,
            'registeredOn' => $registeredOn,
            'img' =>  $image ,
            'permissions' => $permissions 
            ));
		
            
            $this->uid = $uid;
			$this->dbload();
            return  $uid;

        
    }
    
    function getSocs($limit = null) // return all societies
    {
        if ($this->object) 
        { //if we exist
            return $this->app['db']->fetchAll(
                "SELECT * FROM societies WHERE sid in (SELECT sid FROM relationship WHERE uid = ?);" , 
                array($this->uid)
            );

        }
    }
    
    function getRoles( $limit = null) // return all societies
    {
        if ($this->object) 
        { //if we exist
            return $this->app['db']->fetchAll(
                "SELECT permissions FROM relationship WHERE uid = ?;" , 
                array($this->uid)
            );

        }
    }


}
