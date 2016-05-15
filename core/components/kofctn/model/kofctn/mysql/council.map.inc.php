<?php
$xpdo_meta_map['council']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_council',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'councilNumber' => NULL,
    'name' => NULL,
    'created_at' => NULL,
    'imagePath' => NULL,
    'districtId' => NULL,
  ),
  'fieldMeta' => 
  array (
    'councilNumber' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '6',
      'phptype' => 'string',
      'null' => false,
    ),
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => true,
    ),
    'created_at' => 
    array (
      'dbtype' => 'date',
      'phptype' => 'date',
      'null' => false,
    ),
    'imagePath' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'districtId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'integer',
      'null' => true,
    ),
  ),
  'composites' => 
  array (
    'councilMember' => 
    array (
      'class' => 'kofcuser',
      'local' => 'id',
      'foreign' => 'councilId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'councilCouncilAddress' => 
    array (
      'class' => 'councilAddress',
      'local' => 'id',
      'foreign' => 'councilId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'councilPhone' => 
    array (
      'class' => 'phone',
      'local' => 'id',
      'foreign' => 'councilId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'councilCouncilOfficerAssignment' => 
    array (
      'class' => 'councilOfficerAssignment',
      'local' => 'id',
      'foreign' => 'councilId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'councilCouncilMeeting' => 
    array (
      'class' => 'councilMeeting',
      'local' => 'id',
      'foreign' => 'councilId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'councilDistrict' => 
    array (
      'class' => 'district',
      'local' => 'districtId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foriegn',
    ),
  ),
);
