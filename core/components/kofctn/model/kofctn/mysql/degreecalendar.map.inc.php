<?php
$xpdo_meta_map['degreeCalendar']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_degreeCalendar_vw',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'degreeLevel' => NULL,
    'degreeDate' => NULL,
    'districtNumber' => NULL,
    'regionName' => NULL,
    'councilNumber' => NULL,
    'location' => NULL,
    'startTime' => NULL,
    'candidateTime' => NULL,
    'address' => NULL,
    'city' => NULL,
    'state' => NULL,
    'zip' => NULL,
  ),
  'fieldMeta' => 
  array (
    'degreeLevel' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '25',
      'phptype' => 'string',
    ),
    'degreeDate' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
    ),
    'districtNumber' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
    ),
    'regionName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
    ),
    'councilNumber' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
    ),
    'location' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
    ),
    'startTime' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '25',
      'phptype' => 'string',
    ),
    'candidateTime' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '25',
      'phptype' => 'string',
    ),
    'address' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
    ),
    'city' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
    ),
    'state' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '2',
      'phptype' => 'string',
    ),
    'zip' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
    ),
  ),
);
