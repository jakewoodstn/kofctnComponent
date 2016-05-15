<?php
$xpdo_meta_map['rsvpRequest']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_rsvp_request',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'churchEventId' => NULL,
    'createdBy' => NULL,
    'councilRequired' => NULL,
    'districtRequired' => NULL,
    'stateRequired' => NULL,
  ),
  'fieldMeta' => 
  array (
    'churchEventId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'createdBy' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'councilRequired' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'districtRequired' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'stateRequired' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
  ),
  'aggregates' => 
  array (
    'rsvpRequestChurchEvent' => 
    array (
      'class' => 'ChurchEvents',
      'local' => 'churchEventId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
