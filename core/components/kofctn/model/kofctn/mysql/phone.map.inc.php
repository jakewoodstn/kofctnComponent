<?php
$xpdo_meta_map['phone']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_phone',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'councilId' => NULL,
    'memberId' => NULL,
    'phonetype' => NULL,
    'rawnumber' => NULL,
    'extension' => NULL,
  ),
  'fieldMeta' => 
  array (
    'councilId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => true,
    ),
    'memberId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => true,
    ),
    'phonetype' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => false,
    ),
    'rawnumber' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => false,
    ),
    'extension' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
  'aggregates' => 
  array (
    'phoneMember' => 
    array (
      'class' => 'kofcuser',
      'local' => 'memberId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'phoneCouncil' => 
    array (
      'class' => 'council',
      'local' => 'councilId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
