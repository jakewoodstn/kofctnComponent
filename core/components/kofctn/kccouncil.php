<?php
/**
* @package kofctn
*/
 
 class kccouncil {
 
 	protected $_modx;
	protected $_id; 	
	protected $_attr;
 	
	function __construct($modx, $searchParams)
	{
		$this->_modx = $modx;
		if($searchParams){
			$this->loadCouncilInfo($searchParams);
		}
		$this->_attr=array();
	}

	function loadMinimalCouncilInfo($searchParams){
	
		if (!$searchParams){
				$kofcuser=$this->_modx->getObject('kofcuser',array('name'=>$this->_modx->user->username));
				if ($kofcuser){$searchParams=array('id'=>$kofcuser->get('councilId'));} else {return null;}
			}
				
			$_innerCouncil=$this->_modx->getObject('council',$searchParams);
	
			if ($_innerCouncil){
				$this->_attr = $_innerCouncil->toArray();
			}
			
			//council Title
			$this->_attr['councilTitle']=$this->getCouncilTitle();
			
		}

	function loadCouncilInfo($searchParams){

	
		if (!$searchParams){
			
			$kofcuser=$this->_modx->getObject('kofcuser',array('name'=>$this->_modx->user->username));
			if ($kofcuser){$searchParams=array('id'=>$kofcuser->get('councilId'));} else {return null;}
		}
			
		$_innerCouncil=$this->_modx->getObject('council',$searchParams);

		if ($_innerCouncil){
		
			$this->_attr = $_innerCouncil->toArray();
		
			$this->_attr['addresses']=array();
		
			//council Address

			$pa = $this->getCouncilAddress('physical');	
			$ma = $this->getCouncilAddress('mailing');

			$this->_attr['addresses']['mailingAddress']=($ma?$ma:$this->_modx->newObject('councilAddress',array('addressType'=>'mailing')));
			$this->_attr['addresses']['physicalAddress']=($pa?$pa:$this->_modx->newObject('councilAddress',array('addressType'=>'physical')));

			$this->_attr['addresses']['raw']['mailing'] = $this->_attr['addresses']['mailingAddress']->toArray();
			$this->_attr['addresses']['raw']['physical'] = $this->_attr['addresses']['physicalAddress']->toArray();

			$this->_attr['addresses']['rendered']['table'] = $this->getCouncilAddressTable();
						
			//council Title
			$this->_attr['councilTitle']=$this->getCouncilTitle();

			//council image
			$this->_attr['imagePath'] = 'assets/images/headshots/' .$this->_attr['imagePath'];
			
			//council Officers
			$bm=$this->getCouncilMeeting('business');
			$om=$this->getCouncilMeeting('officer');
			
			$this->_attr['meetings']['objects']['business']=($bm?$bm:$this->_modx->newObject('councilMeeting',array('meetingId'=>1)));
			$this->_attr['meetings']['objects']['officer']=($om?$om:$this->_modx->newObject('councilMeeting',array('meetingId'=>2)));

			$this->_attr['meetings']['raw']['business'] = $this->_attr['meetings']['objects']['business']->toArray();
			$this->_attr['meetings']['raw']['officer'] = $this->_attr['meetings']['objects']['officer']->toArray();
			
			$this->_attr['meetings']['rendered']['table']= $this->getCouncilMeetingTable();	
			
			$this->_attr = array_merge($this->_attr,$this->getCouncilOfficerRoster());
			
			return 0;
		} else { return 1;}

	}

	function councilInfo($key)
	
	{
		if ($key){

			return $this->_attr[$key];
		} else {
			return $this->_attr;
		}
		
	}
	
	private function testQuery($objType){
		$q=$this->_modx->newQuery($objType);
		$q->prepare();
		print_r($q->toSQL());
	}
	
	private function getCouncilAddress($addressType){
		$criteria=$this->_modx->newQuery('councilAddress');
		$criteria->where(array('addressType'=>$addressType,'councilId'=>$this->_attr['id']));

		$ca=$this->_modx->getCollection('councilAddress',$criteria,false);

		return reset($ca);
	}
	
	private function getCouncilTitle(){

		$ca = $this->_attr['addresses']['physicalAddress'];
		if (!$ca->id){$ca = $this->_attr['addresses']['mailingAddress'];}
		

		$params = array_merge(
			$this->_attr,($ca)?($ca->toArray('address.')):array()
		);
		
		$ct=$this->_modx->getChunk('kofctn_councilTitle',$params);	
		return $ct;

	}
	
	private function getCouncilAddressTable(){
			$rows='';
			foreach ($this->_attr['addresses']['raw'] as $key => $value) {
				$rows .= $this->_modx->getChunk('kofctn_councilAddress_tableRow',$value);	
				
			}
			
			return $this->_modx->getChunk('kofctn_councilAddress_table',array('kofctn_councilAddress_tableRow'=>$rows));
	}
	
	
	private function getCouncilMeeting($meetingType){
		$criteria=$this->_modx->newQuery('councilMeeting');
		$criteria->innerJoin('meeting','councilMeetingMeeting');
		$criteria->where(array('councilMeetingMeeting.meetingName'=>$meetingType,'councilId'=>$this->_attr['id']));
		
//		$criteria->prepare();
//		print_r($criteria->toSQL());
		$cm=$this->_modx->getCollection('councilMeeting',$criteria,false);

		return reset($cm);

	}

	
	private function getCouncilMeetingTable(){
		$rows='';
		
		foreach($this->_attr['meetings']['raw'] as $key=>$value){
			
			$q=$this->_modx->newQuery('meeting');
			$q->where(array('id'=>$value['meetingId']));
			$q->select(array('meetingName'));
			$m=$this->_modx->getObject('meeting',$q,false);
			$value['meetingType']=$m->get('meetingName');
						
			$ku=new kcUtil($this->_modx);
			$value['meetingDay']=$ku->ordinal($value['weekOfMonth']) .' '. $ku->dayOfWeek($value['dayOfWeek'],1);
			$d=new DateTime($value['timeOfDay']);
			$value['meetingTime'] = $d->format('g:i A');

			$rows .= $this->_modx->getChunk('kofctn_councilMeeting_tableRow',$value);
		}

		return $this->_modx->getChunk('kofctn_councilMeeting_table',array('kofctn_councilMeeting_tableRow'=>$rows));
		}
		
	private function getCouncilOfficerRoster(){
		$officerRoster=array();
		$rosters=$this->_modx->getCollection('councilOfficerRoster',array('councilId'=>$this->_attr['id']));
		if($rosters){
			foreach ($rosters as $key => $roster) {
				$officerRoster[$roster->roleName] = $roster->firstName . ' ' . $roster->lastName;
			}
		}
		return $officerRoster;
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}