<?php
$xpdo_meta_map['fraternalYear']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_fraternalYear',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'fraternalYearName' => NULL,
    'dateStart' => NULL,
    'dateEnd' => NULL,
  ),
  'fieldMeta' => 
  array (
    'fraternalYearName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => false,
    ),
    'dateStart' => 
    array (
      'dbtype' => 'date',
      'phptype' => 'date',
      'null' => false,
    ),
    'dateEnd' => 
    array (
      'dbtype' => 'date',
      'phptype' => 'date',
      'null' => false,
    ),
  ),
  'composites' => 
  array (
    'fraternalYearCouncilOfficerAssignment' => 
    array (
      'class' => 'councilOfficerAssignment',
      'local' => 'id',
      'foreign' => 'fraternalYearId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
