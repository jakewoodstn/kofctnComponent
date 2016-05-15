<?php
/**
* @package kofctn
*/
 
  class dashboardComponent {

	private $_modx;

	function __construct($modx){
		$this->_modx=$modx;
	}

	function render($name, $params)
	{
		$c = $this->_modx->getChunk($name,$params->parameterArray());
		return $c; 	
 	}
 
 }