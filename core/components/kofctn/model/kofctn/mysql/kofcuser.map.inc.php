<?php
$xpdo_meta_map['kofcuser']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_kofcuser',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'name' => '',
    'createdAt' => NULL,
    'imagePath' => NULL,
    'title' => NULL,
    'firstName' => NULL,
    'preferredFirstName' => NULL,
    'lastName' => NULL,
    'primaryEmail' => NULL,
    'councilId' => NULL,
    'spouseFirstName' => NULL,
    'spouseLastName' => NULL,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'createdAt' => 
    array (
      'dbtype' => 'date',
      'phptype' => 'date',
      'null' => false,
    ),
    'imagePath' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'title' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => true,
    ),
    'firstName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'preferredFirstName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'lastName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'primaryEmail' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'councilId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'spouseFirstName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'spouseLastName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
  'composites' => 
  array (
    'memberMemberAddress' => 
    array (
      'class' => 'memberAddress',
      'local' => 'id',
      'foreign' => 'userId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'memberPhone' => 
    array (
      'class' => 'phone',
      'local' => 'id',
      'foreign' => 'memberId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'memberCouncilOfficerAssignment' => 
    array (
      'class' => 'councilOfficerAssignment',
      'local' => 'id',
      'foreign' => 'memberId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'memberCouncil' => 
    array (
      'class' => 'council',
      'local' => 'councilId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
