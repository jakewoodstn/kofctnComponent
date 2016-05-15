<?php
/**
* @package kofctn
*/
 
 class dashboard {
 
 	protected $_modx;

	
 	function __construct($modx){
		$this->_modx = $modx;
		require_once('dashboardComponent.php');
		require_once('dashboardParameters.php');
	}
	
	private function collapse($contentArray){
		$return = '';
		foreach ($contentArray as $key => $content) {
			$return.=$content;
		}

		return $return;
	}
	
	function getDashboard($region){
		$contentArray=array();
		$dp = new dashboardParameters($modx,$this);
		
		if ($region == 'panel'){
		    $contentArray = $this->getPanels($dp);
		} elseif ($region =='gutter') {
			$contentArray = $this->getGutters($dp);
		}
		
		return $this->collapse($contentArray);
		
	}
	
	
	function getGutters($dp){
		$gutters = $this->_modx->getCollection('memberDashboardComponent',array("memberNumber"=>$this->_modx->user->username,"pageColumn"=>'gutter'));

		$dashgutters = array();
		
		foreach ($gutters as $gutter) {
			$dc = new dashboardComponent($this->_modx);
			$dp->addPanelAttributes($gutter);
			$dashgutters[]=$dc->render($gutter->componentChunkName,$dp);
		}
		
		return $dashgutters;		
	}
	
	function getPanels($dp){
		$panels = $this->_modx->getCollection('memberDashboardComponent',array("memberNumber"=>$this->_modx->user->username,"pageColumn"=>'panel'));
			
		$dashpanels = array();
		
		foreach ($panels as $panel) {
			$dc = new dashboardComponent($this->_modx);
			$dp->addPanelAttributes($panel);
			$dashpanels[]=$dc->render($panel->componentChunkName,$dp);
		}
		
		return $dashpanels;		
	}

}