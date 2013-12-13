<?php
namespace UniSoc\Model;


class College
{
    private $app,
        $cid,
        $object;

    function __construct($app, $cid = null)
    {
        $this->app = $app;

        if ($cid != null) {
            $this->cid = $cid;
            $this->dbload();
        }
    }

    function dbload() // load the data from database. Returns true if successful, false otherwise.
    {
        if (!$this->object) //if object is not set...
            if ($this->cid) // and if we have a uni id
                if ($this->object = $this->app['db']->fetchAssoc("SELECT * FROM college WHERE cid = ?", array($this->cid)))
                    return true;
                else
                    $this->object = null; //if we found nothing, let's set it to null to avoid returning false or nulls. This is more memory efficient than other methods..
        return false;
    }

    function getSocs($limit = null) // return all societies
    {
        if ($this->object) { //if we exist
            return $this->app['db']->fetchAll(
                "SELECT * FROM societies WHERE cid = ?" . ( (is_int($limit)) ? " LIMIT $limit" : "" ), 
                array($this->cid)
            );

        }
    }
    
    
    function addSoc($uid, $name, $level, $homepage) // add a society 
    {
    	
        if ($this->object) { 
    //Create the society in the database
            $this->app['db']->insert('societies', array( 
            
            'cid' => $this->cid ,
            'name' => $name ,
            'level' => $level ,
            'homepage' =>  $homepage 
            
            ));
    	
    	$SQLreguest = $this->app['db']->fetchall("SELECT LAST_INSERT_ID();");
    	//var_dump($SQLreguest);
    	$sid = $SQLreguest[0]['LAST_INSERT_ID()'];
	//Give the user that creates the soc admin privileges
            
            $this->app['db']->insert('relationship', array( 
            
            'uid' => $uid ,
            'sid' => $sid ,
            'permissions' => 2 
            
            ));
            
            return  $sid;

        }
        return 'error';
    }



}
