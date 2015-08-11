<?php
$xpdo_meta_map['officerRole']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_officerRole',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'roleName' => NULL,
    'assignmentTypeName' => NULL,
  ),
  'fieldMeta' => 
  array (
    'roleName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'assignmentTypeName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
  'composites' => 
  array (
    'officerRoleCouncilOfficerAssignment' => 
    array (
      'class' => 'councilOfficerAssignment',
      'local' => 'id',
      'foreign' => 'officerRoleId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
