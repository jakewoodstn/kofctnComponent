<?php
$xpdo_meta_map['officerAssignment']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_officerAssignment_vw',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'memberNumber' => NULL,
    'firstName' => NULL,
    'lastName' => NULL,
    'entityDisplayType' => NULL,
    'entityDisplayId' => NULL,
    'entityDisplayName' => NULL,
    'fraternalYearName' => NULL,
    'roleName' => NULL,
    'isCurrentAssignee' => NULL,
  ),
  'fieldMeta' => 
  array (
    'memberNumber' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => true,
    ),
    'firstName' => 
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
    'entityDisplayType' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'entityDisplayId' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'entityDisplayName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'fraternalYearName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'roleName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'isCurrentAssignee' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
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
        'memberNumber' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'fraternalYearName' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'roleName' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
