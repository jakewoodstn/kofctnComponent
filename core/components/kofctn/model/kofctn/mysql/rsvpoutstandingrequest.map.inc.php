<?php
$xpdo_meta_map['rsvpOutstandingRequest']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_rsvp_responseRequired_vw',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'eventName' => NULL,
    'eventDate' => NULL,
    'requestId' => NULL,
    'memberId' => NULL,
    'memberNumber' => NULL,
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
    'requestId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'memberId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'memberNumber' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'null' => false,
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
        'requestId' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'memberId' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
