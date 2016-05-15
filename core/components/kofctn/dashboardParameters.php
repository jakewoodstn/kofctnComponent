<?php
/**
* @package kofctn
*/
 class dashboardParameters{
 
 	private $_modx;
 	private $_params;
    private $_dashboard;

 	function __construct($modx,$d) {
 		$this->_modx = $modx;
 		$this->_params = array();
 		$this->_dashboard = $d;
 	}
 /*
 	private function loadRSVP(){
  	    $myname = "RSVP";
 		return array($myname => $myname);
 	}

	private function loadFirstDegree(){
  		$myname = "FirstDegree";
		return array($myname => $myname);
	}

	private function loadSecondDegree(){
		$myname = "SecondDegree";
		return array($myname => $myname);
	}
	
	private function loadThirdDegree(){
		$myname = "ThirdDegree";
		return array($myname => $myname);
	}
	
	private function loadArray(){*/
 		/* the major workhorse */
 		/* calls each function in order to populate the data on all the different panels and gutters */
/*		$ret = array();
		
		$ret = array_merge($ret, $this->loadRSVP());		
		$ret = array_merge($ret, $this->loadFirstDegree());		
		$ret = array_merge($ret, $this->loadSecondDegree());		
		$ret = array_merge($ret, $this->loadThirdDegree());		

 		return $ret;
 	}
 */
 	function parameterArray(){
 	
 		if (count($this->_params)==0){
 			$this->_params = $this->loadArray();		
 		}
 	
 		return $this->_params;
 	} 
 
 	function setParameter($paramArray){
 	
 		$this->_params = array_merge($this->_params,$paramArray);
 	
 	}
 	
 	function addPanelAttributes($panel){
 	
 		$pname = $panel->componentChunkName;
 	
 		foreach ($panel->_fields as $fieldkey => $fieldvalue) {
 			$this->_params[$pname . '.' . $fieldkey] = $fieldvalue;
 		}
 	
 	}
 
 }