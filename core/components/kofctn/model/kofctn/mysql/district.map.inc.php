<?php
$xpdo_meta_map['district']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_district',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'districtNominalId' => NULL,
    'regionId' => NULL,
  ),
  'fieldMeta' => 
  array (
    'districtNominalId' => 
    array (
      'dbtype' => 'int',
      'precision' => '2',
      'phptype' => 'integer',
      'null' => false,
    ),
    'regionId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
  'composites' => 
  array (
    'districtCouncilOfficerAssignment' => 
    array (
      'class' => 'councilOfficerAssignment',
      'local' => 'id',
      'foreign' => 'districtId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'districtCouncil' => 
    array (
      'class' => 'council',
      'local' => 'id',
      'foreign' => 'districtId',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
