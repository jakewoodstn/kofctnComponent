<?php
$xpdo_meta_map['rsvpResponseDetail']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_rsvp_responseDetail_vw',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'eventName' => NULL,
    'eventDate' => NULL,
    'firstName' => NULL,
    'lastName' => NULL,
    'numberAttending' => NULL,
    'councilNumber' => NULL,
    'districtNumber' => NULL,
    'StateOfficer' => NULL,
  ),
  'fieldMeta' => 
  array (
    'eventName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'eventDate' => 
    array (
      'dbtype' => 'date',
      'phptype' => 'date',
      'null' => false,
    ),
    'firstName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'lastName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'numberAttending' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'councilNumber' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'districtNumber' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'StateOfficer' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
  'indexes' => 
  array (
    'PRIMARY' => 
    array (
      'alias' => 'PRIMARY',
      'primary' => true,
      'unique' => true,
      'columns' => 
      array (
        'eventName' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'eventDate' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'firstName' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'lastName' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
