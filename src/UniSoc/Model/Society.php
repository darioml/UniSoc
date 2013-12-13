<?php
namespace UniSoc\Model;


class Society
{
    private $app,
        $sid,
        $object;

    function __construct($app, $sid = null)
    {
        $this->app = $app;

        if ($sid != null) {
            $this->sid = $sid;
            $this->dbload();
        }
    }

    function dbload() // load the data from database. Returns true if successful, false otherwise.
    {
        if (!$this->object) //if object is not set...
            if ($this->sid) // and if we have a uni id
                if ($this->object = $this->app['db']->fetchAssoc("SELECT * FROM societies WHERE sid = ?", array($this->sid)))
                    return true;
                else
                    $this->object = null; //if we found nothing, let's set it to null to avoid returning false or nulls. This is more memory efficient than other methods..
        return false;
    }

    function getMembersSoc($limit = null) // return all users of Society
    {
        if ($this->object) { //if we exist
            return $this->app['db']->fetchAll(
                "SELECT uid FROM relationship WHERE sid = ?" . ( (is_int($limit)) ? " LIMIT $limit" : "" ), 
                array($this->sid)
            );

        }
    }
	
	function setRelationship($uid, $permissions) // return all users of Society
    {
        if ($this->object) { //if we exist
           	$sql_request = $this->app['db']->fetchAssoc('SELECT * FROM relationship WHERE sid = ? AND uid = ?', array($this->sid, $uid));
		if(!$sql_request)
			{
			//if relationship doesnt already exist insert new one
			$this->app['db']->insert('relationship', array( 
			
				'uid' => $uid ,
				'sid' => $this->sid ,
				'permissions' => $permissions
			
				));
			 }
         else
			 {
			 if(!($sql_request['permissions'] = $permissions))
				 {
				 //relationship does already exist update
				 $this->app['db']->update('relationship', array('permissions' => $permissions), array('uid' => $uid , 'sid' => $this->sid  ));
				 }
			 }      
         //identical relationship does already exist do nothing

        }
    }


}
