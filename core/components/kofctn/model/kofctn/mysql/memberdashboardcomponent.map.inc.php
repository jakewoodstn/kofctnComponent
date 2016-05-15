<?php
$xpdo_meta_map['memberDashboardComponent']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_kofcuser_dashboard_display_vw',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'memberId' => NULL,
    'memberNumber' => NULL,
    'officerRoleId' => NULL,
    'roleName' => NULL,
    'dashboardId' => NULL,
    'componentId' => NULL,
    'dashboardDisplayTitle' => NULL,
    'pageColumn' => NULL,
    'columnRow' => NULL,
    'componentDisplayTitle' => NULL,
    'componentDisplaySubtitle' => NULL,
    'componentTplChunkId' => NULL,
    'componentChunkName' => NULL,
    'componentColumnWidth' => NULL,
  ),
  'fieldMeta' => 
  array (
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
      'precision' => '255',
      'phptype' => 'string',
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
    'dashboardId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'componentId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'dashboardDisplayTitle' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'pageColumn' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'columnRow' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'componentDisplayTitle' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'componentDisplaySubtitle' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'componentTplChunkId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
      'null' => false,
    ),
    'componentChunkName' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'componentColumnWidth' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => '',
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
        'memberId' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'officerRoleId' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'dashboardId' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'componentId' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
