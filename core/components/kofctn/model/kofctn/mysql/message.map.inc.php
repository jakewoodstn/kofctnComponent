<?php
$xpdo_meta_map['message']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_message',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'sendingMemberId' => NULL,
    'createdAt' => NULL,
    'completedAt' => NULL,
    'messageSubject' => NULL,
    'messageText' => NULL,
  ),
  'fieldMeta' => 
  array (
    'sendingMemberId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'createdAt' => 
    array (
      'dbtype' => 'timestamp',
      'precision' => '',
      'phptype' => 'datetime',
      'null' => false,
    ),
    'completedAt' => 
    array (
      'dbtype' => 'timestamp',
      'precision' => '',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'messageSubject' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'messageText' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '32768',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
);
