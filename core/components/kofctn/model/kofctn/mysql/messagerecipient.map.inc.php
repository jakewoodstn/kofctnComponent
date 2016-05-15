<?php
$xpdo_meta_map['messageRecipient']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_messageRecipient',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'messageId' => NULL,
    'memberId' => NULL,
    'sendAttemptedAt' => NULL,
    'targetAddress' => NULL,
    'status' => NULL,
  ),
  'fieldMeta' => 
  array (
    'messageId' => 
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
    'sendAttemptedAt' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'targetAddress' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'status' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '4000',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
);
