<?php
$xpdo_meta_map['councilOfficerRoster']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_councilOfficerRoster_vw',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'councilId' => NULL,
    'officerRoleId' => NULL,
    'roleName' => NULL,
    'fraternalYearName' => NULL,
    'memberId' => NULL,
    'firstName' => NULL,
    'lastName' => NULL,
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
    'officerRoleId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'roleName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'fraternalYearName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '4',
      'phptype' => 'string',
      'null' => true,
    ),
    'memberId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'string',
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
        'councilId' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'officerRoleId' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'fraternalYearName' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
