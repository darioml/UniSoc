<?php

/**
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */

$schema = new \Doctrine\DBAL\Schema\Schema();

$users = $schema->createTable('users');
$users->addColumn('uid', 'integer', array('unsigned' => true, 'autoincrement' => true));
$users->addColumn('email', 'string', array('length' => 255));
$users->addColumn('firstName', 'string', array('length' => 255));
$users->addColumn('lastName', 'string', array('length' => 255));
$users->addColumn('lastLogin', 'datetime');
$users->addColumn('registeredOn', 'datetime');
$users->addColumn('img', 'string', array('length' => 512));
$users->addColumn('permissions', 'integer');
$users->setPrimaryKey(array('uid'));


$soc = $schema->createTable('societies');
$soc->addColumn('sid', 'integer', array('unsigned' => true, 'autoincrement' => true));
$soc->addColumn('cid', 'integer', array('unsigned' => true));
$soc->addColumn('name', 'string', array('length' => 255));
$soc->addColumn('level', 'integer');
$soc->addColumn('homepage', 'string', array('length' => 512));
$soc->setPrimaryKey(array('sid'));


$college = $schema->createTable('college');
$college->addColumn('cid', 'integer', array('unsigned' => true, 'autoincrement' => true));
$college->addColumn('name', 'string', array('length' => 255));
$college->addColumn('location', 'string', array('length' => 255));
$college->addColumn('homepage', 'string', array('length' => 512));
$college->setPrimaryKey(array('cid'));


$relationship = $schema->createTable('relationship');
$relationship->addColumn('uid', 'integer', array('unsigned' => true));
$relationship->addColumn('sid', 'integer', array('unsigned' => true));
$relationship->addColumn('permissions', 'integer');


$logs = $schema->createTable('logs');
$logs->addColumn('lid', 'integer', array('unsigned' => true, 'autoincrement' => true));
$logs->addColumn('model', 'string', array('length' => 255));
$logs->addColumn('action', 'string', array('length' => 255));
$logs->addColumn('actor', 'string', array('length' => 255));
$logs->addColumn('meta', 'text');
$logs->setPrimaryKey(array('lid'));

return $schema;
