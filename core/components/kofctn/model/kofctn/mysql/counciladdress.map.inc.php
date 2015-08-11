<?php
$xpdo_meta_map['councilAddress']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_councilAddress',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'councilId' => NULL,
    'addressType' => NULL,
    'street1' => NULL,
    'street2' => NULL,
    'city' => NULL,
    'state' => NULL,
    'zip' => NULL,
  ),
  'fieldMeta' => 
  array (
    'councilId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'addressType' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
    ),
    'street1' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'street2' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'city' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'state' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '5',
      'phptype' => 'string',
      'null' => true,
    ),
    'zip' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
  'aggregates' => 
  array (
    'councilAddressCouncil' => 
    array (
      'class' => 'council',
      'local' => 'councilId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
