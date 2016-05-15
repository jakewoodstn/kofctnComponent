<?php
$xpdo_meta_map['councilOfficerAssignment']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_councilOfficerAssignment',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'districtId' => NULL,
    'councilId' => NULL,
    'memberId' => NULL,
    'fraternalYearId' => NULL,
    'officerRoleId' => NULL,
    'isCurrentAssignee' => NULL,
  ),
  'fieldMeta' => 
  array (
    'districtId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => true,
    ),
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
      'null' => false,
    ),
    'fraternalYearId' => 
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
    'isCurrentAssignee' => 
    array (
      'dbtype' => 'int',
      'precision' => '4',
      'phptype' => '',
      'null' => false,
    ),
  ),
  'aggregates' => 
  array (
    'councilOfficerAssignmentCouncil' => 
    array (
      'class' => 'council',
      'local' => 'councilId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'councilOfficerAssignmentFraternalYear' => 
    array (
      'class' => 'fraternalYear',
      'local' => 'fraternalYearId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'councilOfficerAssignmentMember' => 
    array (
      'class' => 'kofcuser',
      'local' => 'memberId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'councilOfficerAssignmentOfficerRole' => 
    array (
      'class' => 'officerRole',
      'local' => 'officerRoleId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
