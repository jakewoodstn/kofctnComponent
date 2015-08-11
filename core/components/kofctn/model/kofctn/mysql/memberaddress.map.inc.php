<?php
$xpdo_meta_map['memberAddress']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_memberAddress',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'userId' => NULL,
    'addressType' => '',
    'street1' => '',
    'street2' => '',
    'city' => '',
    'state' => '',
    'zip' => '',
  ),
  'fieldMeta' => 
  array (
    'userId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'addressType' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'street1' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'street2' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'city' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'state' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '2',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'zip' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
  'aggregates' => 
  array (
    'memberAddressMember' => 
    array (
      'class' => 'kofcuser',
      'local' => 'userId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
