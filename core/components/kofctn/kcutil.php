<?php
/**
* @package kofctn
*/
 
 class kcUtil {
 
 	protected $_modx;
 	
	function __construct(&$modx)
	{
		$this->_modx = $modx;
	}
	
	function processAjax($paramarray)
	{
	
	$hasMsg=1;
	if(!array_key_exists('msg',$paramarray)){$hasMsg=null;$paramarray['msg']='';}
		
	foreach($paramarray as $key=>$value){
		switch($key){
		  case 'procname':
			$procname=$value;
			break;
		  case 'showerrors': $showerrors=$value;
		  case 'id': break;
		  case 'msg':
		    $querystring .=", @".$key."='".$value."'";
		   	if ($hasMsg){$fieldlist .=', @'.$key;}				
		  	break;
		  default:
			$querystring .=", @".$key."='".$value."'";
			$fieldlist .=', @'.$key;
		} 
	}
	
	$fieldlist=substr($fieldlist,2);
	$querystring = 'SET '.substr($querystring,2);
	$callstring = "CALL ".$procname."(".$fieldlist.")";
	
	$mysqli = new mysqli("localhost", "modx", "1MfYce1sZKLjGNjdTrNP", "kofctnor_modx");
	if ($mysqli->connect_errno) {
	    echo $showerrors?("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error):"";
		return null;
	}
	
	echo $querystring;
	echo $callstring;
	
	if (!$mysqli->query($querystring) ||!$mysqli->query($callstring)) {
	  if($showerrors){
	    echo $querystring;
	    echo $callstring;
	    echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
	    }
	    return null;
	}
	
	if (!($res = $mysqli->query("SELECT @msg as _p_out"))) {
	    echo $showerrors?("Fetch failed: (" . $mysqli->errno . ") " . $mysqli->error):"";
	    return null;
	}
	
	$row = $res->fetch_assoc();
	return $row['_p_out'];
	
	
	}
	
	function flattenArray($arr,$prefix='',$includeObjects=true){
	
		$prefix = $prefix==''?'':(substr($prefix,-1)=='.'?$prefix:$prefix .'.');
	
		$newArr=array();
		
		foreach ($arr as $key => $value) {
			switch (gettype($value)) {
				case 'array': 
					$newArr = array_merge($newArr,$this->flattenArray($value,$prefix . $key ,$includeObjects));
					break;
				case 'object': 
					if ($includeObjects==true){$newArr[$prefix.$key]=$value;}
					break;
				default:
					$newArr[$prefix . $key]=$value;
					break;
			}
		}
		
		return $newArr;
	
	}

	function canIEditAnyone(){
		$testUser=$this->_modx->user->username;
		$masterEditors = array('4421796','3926722');
		return in_array($testUser,$masterEditors);
	}

	function ordinal($number) {
	    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
	    if ((($number % 100) >= 11) && (($number%100) <= 13))
	        return $number. 'th';
	    else
	        return $number. $ends[$number % 10];
	}
	

	function dayOfWeek($index, $weekStart=1){
		$indexOne= $index-1;
		$weekStartOne=$weekStart-1;
		$days=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		return $days[($indexOne + $weekStartOne) % 7];
	}
	
	function allCouncils(){
	
		$returnArray=array();
	
		$q=$this->_modx->query("Select id councilId,councilNumber,name,concat(councilNumber,' - ',name) shortDisplayName from modx_kofctn_council where id>0 order by cast(councilNumber as signed)"); 
	
		if (!is_object($q)) {
		   $returnArray = array(array("councilId"=>0,'councilNumber'=>'','name'=>'','shortDisplayName'=>'No councils found'));
		}
		else {
			while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
				array_push($returnArray,$row);
			}
		}

		return $returnArray; 	  
	}
}