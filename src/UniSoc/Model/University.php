<?php
namespace UniSoc\Model;


class University
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
                if ($this->object = $this->app['db']->fetchAssoc("SELECT * FROM college WHERE cid = ?", array($this->uid)))
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
                array($this->uid)
            );

        }
    }


}
