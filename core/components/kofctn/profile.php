<?php
/**
* @package kofctn
*/

class profile{
	protected $_modx;
	
	function __construct(&$modx){
		$this->_modx=$modx;
		require_once('kcutil.php');
		$this->_ku=new kcUtil();
	}
	
	function process($method){
	
	if ($method=='profile') {$this->getProfile(); return null;}
	
	if ($method=='council'){return 'Deprecated council method invoked.';}
	//if ($method=='council'){council();return null;}
	
	if ($method=='request') {
		$params = array(
				'name'=>isset($_POST['name'])?$_POST['name']:null
				,'memberEmail'=>isset($_POST['email'])?$_POST['email']:null
				,'memberNumber'=>isset($_POST['memberNumber'])?$_POST['memberNumber']:null
				,'councilNumber'=>isset($_POST['councilNumber'])?$_POST['councilNumber']:null
		);
	
			$validMsg = $this->validateParameters($params);
	
			if ($validMsg){
				echo $validMsg;
			} else {
				$sent=$this->requestAccess($params); 
				if ($sent) {
					echo("<label class='success h4'>Your request was received.  Please check your email for confirmation.  If you do not see the confirmation within 1 day, please email webmaster@kofc-tn.org.</label>");
				}
			}
			
			return null;
			
	}
	
	if ($method=='search') {
		$searchResults=$this->search(); 
		$this->renderSearchResult($searchResults); 
		return null;
	}

	if ($method=='renderEditForm'){
		renderEditForm();
	}
	
	return null;
	
	}


 function renderEditForm(){
 
 	
 	
 	//capture most of the necessary information in placeholders
 	$params=$this->getProfile();
 	$kcuser = $this->getKCUser();
	
 	
 	
 	//render chunk for editor form

 
 }

 function sendEmail($email,$name,$subject,$properties = array()) {
        if (empty($properties['tpl'])) $properties['tpl'] = 'lgnForgotPassEmail';
        if (empty($properties['tplType'])) $properties['tplType'] = 'modChunk';

        $msg = $this->_modx->getChunk($properties['tpl'],$properties,$properties['tplType']);
        $msgAlt = '';
        if (!empty($properties['tplAlt'])) {
            $msgAlt = $this->_modx->getChunk($properties['tplAlt'],$properties,$properties['tplType']);
        }


        $this->_modx->getService('mail', 'mail.modPHPMailer');
        $this->_modx->mail->set(modMail::MAIL_BODY, $msg);
        $this->_modx->mail->set(modMail::MAIL_FROM, $this->_modx->getOption('emailsender'));
        $this->_modx->mail->set(modMail::MAIL_FROM_NAME, $this->_modx->getOption('site_name'));
        $this->_modx->mail->set(modMail::MAIL_SENDER, $this->_modx->getOption('emailsender'));
        $this->_modx->mail->set(modMail::MAIL_SUBJECT, $subject);
        if (!empty($msgAlt)) { 
            $this->_modx->mail->set(modMail::MAIL_BODY_TEXT, $msgAlt);
        }
        $this->_modx->mail->address('to', $email, $name);
        $this->_modx->mail->address('reply-to', $this->_modx->getOption('emailsender'));
        $this->_modx->mail->setHTML(true);
        
        $sent = $this->_modx->mail->send();
        if (!$sent) {
            $this->_modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email: '.$this->_modx->mail->mailer->ErrorInfo);
        }
        $this->_modx->mail->reset();


        return $sent;
    }

function validateParameters($params){
	
	
	
	$msg='';
	if (!$params['name']){
		$msg.='Name is a required field.<br/>';
	}

	if (!$params['memberNumber']){
		$msg.='Member Number is a required field.<br/>';
	} else { 
		$ae = $this->checkAccountExists($params['memberNumber']);
		$msg.=($ae?'An account with this member number already exists.  If you have forgotten your password, please click the \'Forgot Password\' button on the main menu.<br/>':'');
	}
	if (!$params['memberEmail']){
		$msg.='Member Email is a required field.<br/>';
	}
	if (!$params['councilNumber']){
		$msg.='Council Number is a required field.<br/>';
	} else {
	
	
		$c= $this->_modx->getObject('council',array('councilNumber'=>$params['councilNumber']));

		$msg.=($c?'':'Your council number was not recognized.');
	}
	
	return $msg?'<label class="error h4">There are some problems with your request.  Please check the issues below and try your request again.<br/>'.$msg.'</label>':null;
}

function checkAccountExists($memberNumber){

	$ku = $this->_modx->getObject('kofcuser',array('name'=>$memberNumber));	
	return ($ku?1:null);
	
}

function requestAccess($params){
	

	
	$send1=$this->sendEmail('prowler27708@gmail.com','','New Member Request: '.$params['memberNumber'],array_merge($params,array('tpl'=>'requestAccess_email_tpl')));
	$send2=$this->sendEmail($params['memberEmail'],'','Membership Request Recieved: '.$params['memberNumber'],array_merge($params,array('tpl'=>'requestAccess_email_tpl')));
	return $send1&&$send2;
}


function currentFY(){
 	$dval = date('Y-m-d');
 	$q = $this->_modx->newQuery('fraternalYear');
 	$q->where(array('dateStart:<='=>$dval,'dateEnd:>='=>$dval));
 	$q->select('fraternalYearName');
 	$f=$this->_modx->getObject('fraternalYear',$q);
	$ret = ''; 
	if ($f){
		$ret=$f->get('fraternalYearName');
	}
	return $ret;
}


function formatPhone($phoneProp){
	$ret="(xxx) xxx-xxxx";
 	if ($phoneProp){
 		
 		$raw=$phoneProp->get('rawnumber');
 		if (strlen($raw) ==10){
 			$area = substr($raw,0,3);
 			$exch = substr($raw,3,3);
 			$num =  substr($raw,6,4);
 			$ret = '('.$area.') '.$exch.'-'.$num; 
 		} else {	
 			$exch = (substr($raw,0,3));
			$num = (substr($raw,3,4));
			$ret = $exch.'-'.$num; 
		} 		
	}
 	return $ret;
}
 
function officerAssignments($member,$currentOnly){

	$q=$this->_modx->newQuery('officerAssignment');
	$q->where(array('memberId'=>$member->get('id')));
	if ($currentOnly){
		$q->where(array('isCurrentAssignee'=>1));
	}
	
	$q->select(array('fraternalYearName','roleName','entityDisplayName','isCurrentAssignee'));
	$q->sortby('fraternalYearName','ASC');
	//$q->prepare();
	//print_r($q->toSQL());
	
	$officerAssignments=$this->_modx->getIterator('officerAssignment',$q,false);
	return $officerAssignments;
	
}
 /*
function officerAssignments_dep( $member, $council, $currentOnly){
  	$q = $this->_modx->newQuery('councilOfficerAssignment');
 	
 	if ($member){
 		$ci = $member->get('councilId');
 		if ($currentOnly){
		 	$fi = $this->_modx->getObject('fraternalYear',array('fraternalYearName'=>$this->currentFY()))->get('id');
 			$q->where(array('memberId:='=>$member->get('id'),'councilId:IN'=>array($ci,0),'fraternalYearId:='=>$fi,'isCurrentAssignee:='=>1));
 		} else {
			$q->where(array('memberId:='=>$member->get('id'),'councilId:IN'=>array($ci,0)));
 		}
 	} elseif ($council){
 			if ($currentOnly){
 				$fi = $this->_modx->getObject('fraternalYear',array('fraternalYearName'=>$this->currentFY()))->get('id');
 				$q->where(array('councilId:='=>$council-get('id'),'fraternalYearId:='=>$fi,'isCurrentAssignee:='=>1));
 			} else {
 				$q->where(array('councilId:='=>$council-get('id')));
 			}
	}
 	
 	$q->innerJoin('officerRole','councilOfficerAssignmentOfficerRole');
 	$q->innerJoin('kofcuser','councilOfficerAssignmentMember');
  	$q->innerJoin('fraternalYear','councilOfficerAssignmentFraternalYear');
 	$q->leftJoin('council','councilOfficerAssignmentCouncil');
 	$q->leftJoin('district','councilOfficerAssignmentDistrict');
	$q->select(->getSelectColumns('kofcuser','councilOfficerAssignmentMember','member_',array('id','preferredFirstName','lastName')));
	$q->select(->getSelectColumns('council','councilOfficerAssignmentCouncil','council_',array('id','name','councilNumber')));
	$q->select(->getSelectColumns('district','councilOfficerAssignmentDistrict','district_',array('id','districtNominalId')));
	$q->select(->getSelectColumns('officerRole','councilOfficerAssignmentOfficerRole','role_',array('id','roleName')));
	$q->select(->getSelectColumns('councilOfficerAssignment','councilOfficerAssignment','',array('id')));
	$q->select(->getSelectColumns('fraternalYear','councilOfficerAssignmentFraternalYear','fy_',array('id','fraternalYearName')));
 	$q->sortby('fy_fraternalYearName','DESC');
// 	$q->prepare();
// 	echo $q->toSQL();
 	$officerAssignments=$this->_modx->getIterator('councilOfficerAssignment',$q);
 	return $officerAssignments;
}
*/
function renderOfficer($chunkName,$assignments){
	$returnText = '';
	foreach ($assignments as $assignment) {
		$role=$assignment->get('roleName');
		$councilDisplay=$assignment->get('entityDisplayName');
		$fy=$assignment->get('fraternalYearName');
		$officerDisplay = $role . ', ' . $councilDisplay . ' - FY ' . $fy;
		
		$propArray = array(
			'councilDisplay'=>$councilDisplay,
			'role'=>$role,
			'fy'=>$fy,
			'officerDisplay'=>$officerDisplay);
		$returnText.=$this->_modx->getChunk($chunkName,$propArray);
	}
	return $returnText;
}
/*
function renderOfficer_dep($chunkName,$assignments){
	$returnText = '';
	foreach ($assignments as $assignment) {
		$role=$assignment->get('role_roleName');
		$council=$assignment->get('council_id')==0?'TN State Council':$assignment->get('council_name').' Council #'.$assignment->get('council_councilNumber');
		$councilNumber=$assignment->get('council_councilNumber');
		if (!$councilNumber){
			$districtNumber=$assignment->get('district_districtNominalId');
		}		
		$member=$assignment->get('member_preferredFirstName').' '.$assignment->get('member_lastName');
		$fy=$assignment->get('fy_fraternalYearName');
		$officerDisplay = $role.($districtNumber?' #'.$districtNumber:'').', '.$council.' (FY '.$fy.')';
		
		$propArray = array(
			'member'=>$member,
			'council'=>$council, 
			'councilNumber'=>$councilNumber?$councilNumber:$districtNumber,
			'role'=>$role,
			'fy'=>$fy,
			'officerDisplay'=>$officerDisplay);
		$returnText.=$this->_modx->getChunk($chunkName,$propArray);
	}
	return $returnText;
}
*/

function renderSearchRow($result1,$result2,$result3) {
	$prop=array('result1'=>$result1,'result2'=>$result2,'result3'=>$result3);
	$ret=$this->_modx->getChunk('kofctn_searchResultRow_tpl',$prop);
	return $ret;
}

function renderSearchResult($resultSet){
	$output='';
	if (!($resultSet)){return null;}
	foreach($resultSet as $member){
	
		if($result1 && $result2 && $result3){
			//all 3 positions loaded -> output row chunk
			$rowChunk=$this->renderSearchRow($result1,$result2,$result3);
			$output.=$rowChunk;
			$result1=null;
			$result2=null;
			$result3=null;
		}
		if (!$result1){
			$prop=$member->toArray();
			$prop=array_merge($prop,array("profileResource"=>53));
			$result1=$this->_modx->getChunk('kofctn_searchResultCell_tpl',$prop);
			
		}
		elseif (!$result2){
			$prop=$member->toArray();
			$prop=array_merge($prop,array("profileResource"=>53));
			$result2=$this->_modx->getChunk('kofctn_searchResultCell_tpl',$prop);
			
		}
		elseif (!$result3){
			$prop=$member->toArray();
			$prop=array_merge($prop,array("profileResource"=>53));
			$result3=$this->_modx->getChunk('kofctn_searchResultCell_tpl',$prop);
			
		}
	}
	$rowChunk=$this->renderSearchRow($result1,$result2,$result3);
	$output.=$rowChunk;
	$finalProp=array('searchResultBody'=>$output);

	$this->_modx->toPlaceholders(array('searchResults'=>$this->_modx->getChunk('kofctn_searchResults_tpl',$finalProp)));
	
	return null;
}


function search(){
	if (!isset($_POST['exist'])){return null;}
	$search=$this->_modx->newQuery('kofcuser');
	$search->innerJoin('council','memberCouncil');
	$search->select($this->_modx->getSelectColumns('kofcuser','kofcuser'));
	$search->select($this->_modx->getSelectColumns('council','memberCouncil','council_',array('name','councilNumber')));
	$searchParams=array();
	if(isset($_POST['firstname'])){
		$fname=$_POST['firstname'];
		if($fname){
		$fnameSearch = array('firstName:LIKE'=>$fname.'%','OR:preferredFirstName:LIKE'=>$fname.'%');
		array_push($searchParams,$fnameSearch);	
		}
	}
	if(isset($_POST['lastname'])){
		$lname=$_POST['lastname'];
		if($lname){
		$lnameSearch = array('lastName:LIKE'=>$lname.'%');
		array_push($searchParams,$lnameSearch);	
		}
	}
	if(isset($_POST['councilnumber'])){
		$cnum=$_POST['councilnumber'];
		if($cnum){
			$cnumSearch = array('memberCouncil.councilNumber:='=>$cnum);
			array_push($searchParams,$cnumSearch);	
		}
	}
	$search->where($searchParams);
	$results=$this->_modx->getIterator('kofcuser',$search);
    return $results;
   }

function getKCUser(){
	
	$userProbe=isset($_GET['memberId'])?$_GET['memberId']:$this->_modx->user->username;
	
	
	$myuser=$this->_modx->getObject('kofcuser',array('name'=>$userProbe),false);
	return $myuser;
}

function getProfile(){ 

$myuser=$this->getKCUser();
$myFY= $this->currentFY();

if($myuser){
	$addr=$myuser->getMany('memberMemberAddress',array('addressType'=>'home'));
	if($addr){
		foreach ($addr as $a) {
		$myAddress = $a->toArray();
		$myFullStreet = $myAddress['street1']. ($myAddress['street2']?('<br/>'.$myAddress['street2']):'');
		$this->_modx->toPlaceholders($a->toArray(),'memberAddress');
		$this->_modx->toPlaceholders(array('fullstreet'=>$myFullStreet),'memberAddress');
		}
	}
	$baseImage = '/assets/images/memberPhotos/';
	$imagePath = $baseImage . $myuser->get('imagePath');

	$mycouncil=$this->getCouncil($myuser);
	$councilAddress=$this->getCouncilAddress($mycouncil,'physical');
	$this->_modx->toPlaceholders($councilAddress->toArray(),'councilAddress');

	$this->_modx->toPlaceholders(array("imagePath"=>$imagePath),'');
	$this->_modx->toPlaceholders($myuser->toArray(),'member');
	$this->_modx->toPlaceholders($mycouncil->toArray(),'council');
	
	//Phone Numbers
	$phonePlaceholder='';
	$phoneProps=$myuser->getMany('memberPhone');
   	foreach ($phoneProps as $phoneProp) {
		$propArray= array("phonetype"=>$phoneProp->get('phonetype'), 'formattedNumber'=> $this->formatPhone($phoneProp));
		  $this->_modx->toPlaceholders(array($propArray['phonetype']=>$propArray['formattedNumber']),'memberPhone');
		$phonePlaceholder.=$this->_modx->getChunk('PhoneNumber',$propArray);
	}
	
	$this->_modx->toPlaceholders(array('phoneNumberTpl'=>$phonePlaceholder),'memberPhone');

    //$assignments = $this->officerAssignments($myuser,null,true);
    $assignments = $this->officerAssignments($myuser,true);
	$officerText = $this->renderOfficer('kofctn_currentOfficer',$assignments);
	$this->_modx->toPlaceholders(array('currentOfficerTpl'=>$officerText));
	
//	$assignments = $this->officerAssignments($myuser,null,false);
	$assignments = $this->officerAssignments($myuser,false);
	$officerText = $this->renderOfficer('kofctn_officer',$assignments);
	$this->_modx->toPlaceholders(array('officerRowTpl'=>$officerText));
	
}

return null;

}


function getCurrentUserCouncil(){

	$member=$this->_modx->getObject('kofcuser',array('name'=>$this->_modx->user->username),false);
	$council=$member->getOne('memberCouncil');
	
	if (!$council) {
		  $this->_modx->log(modX::LOG_LEVEL_ERROR,'Current user\'s council not captured for user id '.$this->_modx->user->username);
	}
	
	return $council;
}

function getCouncil($user){

	if (isset($_GET['councilNumber'])){
		$council=$this->_modx->getObject('council',array('councilNumber'=>$_GET['councilNumber']));
	} 
	elseif($user){
		$council=$user->getOne('memberCouncil');
	}
	else {
		$council=$this->getCurrentUserCouncil();
    }
    
    return $council;
}

function councilTitle($council){
	$councilAddress=$this->getCouncilAddress($council,'physical');
	$params = array_merge(
		$council->toArray(),
		($councilAddress)?($councilAddress->toArray('address.')):array()
	);
	
	$ct=$this->_modx->getChunk('kofctn_councilTitle',$params);	
	
	$this->_modx->toPlaceholders(array('councilTitle'=>$ct));
}

function getCouncilAddress($council,$addressType){
	
	$councilAddress=$council->getMany('councilCouncilAddress',array("addressType"=>$addressType));
	
	if (!$councilAddress){
		$councilAddress=$council->getMany('councilCouncilAddress');
	}
	
	if ($councilAddress){
		foreach($councilAddress as $ca){	
			$returnVal=$ca;
		}
	}
	
	return $returnVal;
}
/*
function council(){

	$council=getCouncil();
	if (!$council){return null;}
	

	//council title
	councilTitle($council);
	
	//council district
	//council image
	//council address
	//council map
	//council meetings
	//council officers
	//council awards
	//council members

	return null;
	
}
*/


}