<?php
/**
* @package kofctn
*/
 
/* DO NOT MOVE THESE LINES!!!!*/
$base_path = !empty($base_path) ? $base_path : $modx->getOption('core_path').'components/kofctn/';
$modx->addPackage('kofctn',$base_path.'model/');
/* DO NOT MOVE THESE LINES!!!!*/


 function sendEmail($modx,$email,$name,$subject,$properties = array()) {
        if (empty($properties['tpl'])) $properties['tpl'] = 'lgnForgotPassEmail';
        if (empty($properties['tplType'])) $properties['tplType'] = 'modChunk';

        $msg = $modx->getChunk($properties['tpl'],$properties,$properties['tplType']);
        $msgAlt = '';
        if (!empty($properties['tplAlt'])) {
            $msgAlt = $modx->getChunk($properties['tplAlt'],$properties,$properties['tplType']);
        }


        $modx->getService('mail', 'mail.modPHPMailer');
        $modx->mail->set(modMail::MAIL_BODY, $msg);
        $modx->mail->set(modMail::MAIL_FROM, $modx->getOption('emailsender'));
        $modx->mail->set(modMail::MAIL_FROM_NAME, $modx->getOption('site_name'));
        $modx->mail->set(modMail::MAIL_SENDER, $modx->getOption('emailsender'));
        $modx->mail->set(modMail::MAIL_SUBJECT, $subject);
        if (!empty($msgAlt)) { 
            $modx->mail->set(modMail::MAIL_BODY_TEXT, $msgAlt);
        }
        $modx->mail->address('to', $email, $name);
        $modx->mail->address('reply-to', $modx->getOption('emailsender'));
        $modx->mail->setHTML(true);
        
        $sent = $modx->mail->send();
        if (!$sent) {
            $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email: '.$modx->mail->mailer->ErrorInfo);
        }
        $modx->mail->reset();


        return $sent;
    }

function validateParameters($modx,$params){
	
	
	
	$msg='';
	if (!$params['name']){
		$msg.='Name is a required field.<br/>';
	}

	if (!$params['memberNumber']){
		$msg.='Member Number is a required field.<br/>';
	} else { 
		$ae = checkAccountExists($modx,$params['memberNumber']);
		$msg.=($ae?'An account with this member number already exists.  If you have forgotten your password, please click the \'Forgot Password\' button on the main menu.<br/>':'');
	}
	if (!$params['memberEmail']){
		$msg.='Member Email is a required field.<br/>';
	}
	if (!$params['councilNumber']){
		$msg.='Council Number is a required field.<br/>';
	} else {
	
	
		$c= $modx->getObject('council',array('councilNumber'=>$params['councilNumber']));

		$msg.=($c?'':'Your council number was not recognized.');
	}
	
	return $msg?'<label class="error h4">There are some problems with your request.  Please check the issues below and try your request again.<br/>'.$msg.'</label>':null;
}

function checkAccountExists($modx, $memberNumber){

	$ku = $modx->getObject('kofcuser',array('name'=>$memberNumber));	
	return ($ku?1:null);
	
}

function requestAccess($modx,$params){
	

	
	$send1=sendEmail($modx,'prowler27708@gmail.com','','New Member Request: '.$params['memberNumber'],array_merge($params,array('tpl'=>'requestAccess_email_tpl')));
	$send2=sendEmail($modx,$params['memberEmail'],'','Membership Request Recieved: '.$params['memberNumber'],array_merge($params,array('tpl'=>'requestAccess_email_tpl')));
	return $send1&&$send2;
}


function currentFY($modx){
 	$dval = date('Y-m-d');
 	$q = $modx->newQuery('fraternalYear');
 	$q->where(array('dateStart:<='=>$dval,'dateEnd:>='=>$dval));
 	$q->select('fraternalYearName');
 	$f=$modx->getObject('fraternalYear',$q);
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
 
function officerAssignments($modx,$member,$currentOnly){

	$q=$modx->newQuery('officerAssignment');
	$q->where(array('memberId'=>$member->get('id')));
	if ($currentOnly){
		$q->where(array('isCurrentAssignee'=>1));
	}
	
	$q->select(array('fraternalYearName','roleName','entityDisplayName','isCurrentAssignee'));
	$q->sortby('fraternalYearName','ASC');
	//$q->prepare();
	//print_r($q->toSQL());
	
	$officerAssignments=$modx->getIterator('officerAssignment',$q,false);
	return $officerAssignments;
	
}
 /*
function officerAssignments_dep($modx, $member, $council, $currentOnly){
  	$q = $modx->newQuery('councilOfficerAssignment');
 	
 	if ($member){
 		$ci = $member->get('councilId');
 		if ($currentOnly){
		 	$fi = $modx->getObject('fraternalYear',array('fraternalYearName'=>currentFY($modx)))->get('id');
 			$q->where(array('memberId:='=>$member->get('id'),'councilId:IN'=>array($ci,0),'fraternalYearId:='=>$fi,'isCurrentAssignee:='=>1));
 		} else {
			$q->where(array('memberId:='=>$member->get('id'),'councilId:IN'=>array($ci,0)));
 		}
 	} elseif ($council){
 			if ($currentOnly){
 				$fi = $modx->getObject('fraternalYear',array('fraternalYearName'=>currentFY($modx)))->get('id');
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
	$q->select($modx->getSelectColumns('kofcuser','councilOfficerAssignmentMember','member_',array('id','preferredFirstName','lastName')));
	$q->select($modx->getSelectColumns('council','councilOfficerAssignmentCouncil','council_',array('id','name','councilNumber')));
	$q->select($modx->getSelectColumns('district','councilOfficerAssignmentDistrict','district_',array('id','districtNominalId')));
	$q->select($modx->getSelectColumns('officerRole','councilOfficerAssignmentOfficerRole','role_',array('id','roleName')));
	$q->select($modx->getSelectColumns('councilOfficerAssignment','councilOfficerAssignment','',array('id')));
	$q->select($modx->getSelectColumns('fraternalYear','councilOfficerAssignmentFraternalYear','fy_',array('id','fraternalYearName')));
 	$q->sortby('fy_fraternalYearName','DESC');
// 	$q->prepare();
// 	echo $q->toSQL();
 	$officerAssignments=$modx->getIterator('councilOfficerAssignment',$q);
 	return $officerAssignments;
}
*/
function renderOfficer($modx,$chunkName,$assignments){
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
		$returnText.=$modx->getChunk($chunkName,$propArray);
	}
	return $returnText;
}
/*
function renderOfficer_dep($modx,$chunkName,$assignments){
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
		$returnText.=$modx->getChunk($chunkName,$propArray);
	}
	return $returnText;
}
*/

function renderSearchRow($modx,$result1,$result2,$result3) {
	$prop=array('result1'=>$result1,'result2'=>$result2,'result3'=>$result3);
	$ret=$modx->getChunk('kofctn_searchResultRow_tpl',$prop);
	return $ret;
}

function renderSearchResult($modx,$resultSet){
	$output='';
	if (!($resultSet)){return null;}
	foreach($resultSet as $member){
	
		if($result1 && $result2 && $result3){
			//all 3 positions loaded -> output row chunk
			$rowChunk=renderSearchRow($modx,$result1,$result2,$result3);
			$output.=$rowChunk;
			$result1=null;
			$result2=null;
			$result3=null;
		}
		if (!$result1){
			$prop=$member->toArray();
			$prop=array_merge($prop,array("profileResource"=>53));
			$result1=$modx->getChunk('kofctn_searchResultCell_tpl',$prop);
			
		}
		elseif (!$result2){
			$prop=$member->toArray();
			$prop=array_merge($prop,array("profileResource"=>53));
			$result2=$modx->getChunk('kofctn_searchResultCell_tpl',$prop);
			
		}
		elseif (!$result3){
			$prop=$member->toArray();
			$prop=array_merge($prop,array("profileResource"=>53));
			$result3=$modx->getChunk('kofctn_searchResultCell_tpl',$prop);
			
		}
	}
	$rowChunk=renderSearchRow($modx,$result1,$result2,$result3);
	$output.=$rowChunk;
	$finalProp=array('searchResultBody'=>$output);

	$modx->toPlaceholders(array('searchResults'=>$modx->getChunk('kofctn_searchResults_tpl',$finalProp)));
	
	return null;
}


function search($modx){
	if (!isset($_POST['exist'])){return null;}
	$search=$modx->newQuery('kofcuser');
	$search->innerJoin('council','memberCouncil');
	$search->select($modx->getSelectColumns('kofcuser','kofcuser'));
	$search->select($modx->getSelectColumns('council','memberCouncil','council_',array('name','councilNumber')));
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
	$results=$modx->getIterator('kofcuser',$search);
    return $results;
   }

function profile($modx){ 

$userProbe=isset($_GET['memberId'])?$_GET['memberId']:$modx->user->username;


$myuser=$modx->getObject('kofcuser',array('name'=>$userProbe),false);
$myFY= currentFY($modx);

if($myuser){
	$addr=$myuser->getMany('memberMemberAddress',array('addressType'=>'home'));
	if($addr){
		foreach ($addr as $a) {
		$myAddress = $a->toArray();
		$myFullStreet = $myAddress['street1']. ($myAddress['street2']?('<br/>'.$myAddress['street2']):'');
		$modx->toPlaceholders($a->toArray(),'memberAddress');
		$modx->toPlaceholders(array('fullstreet'=>$myFullStreet),'memberAddress');
		}
	}
	$baseImage = '/assets/images/memberPhotos/';
	$imagePath = $baseImage . $myuser->get('imagePath');

	$mycouncil=getCouncil($modx,$myuser);
	$councilAddress=getCouncilAddress($modx,$mycouncil,'physical');
	$modx->toPlaceholders($councilAddress->toArray(),'councilAddress');

	$modx->toPlaceholders(array("imagePath"=>$imagePath),'');
	$modx->toPlaceholders($myuser->toArray(),'member');
	$modx->toPlaceholders($mycouncil->toArray(),'council');
	
	//Phone Numbers
	$phonePlaceholder='';
	$phoneProps=$myuser->getMany('memberPhone');
   	foreach ($phoneProps as $phoneProp) {
		$propArray= array("phonetype"=>$phoneProp->get('phonetype'), 'formattedNumber'=> formatPhone($phoneProp));
		$phonePlaceholder.=$modx->getChunk('PhoneNumber',$propArray);
	}
	
	$modx->toPlaceholders(array('phoneNumberTpl'=>$phonePlaceholder),'memberPhone');

    //$assignments = officerAssignments($modx,$myuser,null,true);
    $assignments = officerAssignments($modx,$myuser,true);
	$officerText = renderOfficer($modx,'kofctn_currentOfficer',$assignments);
	$modx->toPlaceholders(array('currentOfficerTpl'=>$officerText));
	
//	$assignments = officerAssignments($modx,$myuser,null,false);
	$assignments = officerAssignments($modx,$myuser,false);
	$officerText = renderOfficer($modx,'kofctn_officer',$assignments);
	$modx->toPlaceholders(array('officerRowTpl'=>$officerText));
	
}

return null;}


function getCurrentUserCouncil($modx){

	$member=$modx->getObject('kofcuser',array('name'=>$modx->user->username),false);
	$council=$member->getOne('memberCouncil');
	
	if (!$council) {
		  $modx->log(modX::LOG_LEVEL_ERROR,'Current user\'s council not captured for user id '.$modx->user->username);
	}
	
	return $council;
}

function getCouncil($modx,$user){

	if (isset($_GET['councilNumber'])){
		$council=$modx->getObject('council',array('councilNumber'=>$_GET['councilNumber']));
	} 
	elseif($user){
		$council=$user->getOne('memberCouncil');
	}
	else {
		$council=getCurrentUserCouncil($modx);
    }
    
    return $council;
}

function councilTitle($modx,$council){
	$councilAddress=getCouncilAddress($modx,$council,'physical');
	$params = array_merge(
		$council->toArray(),
		($councilAddress)?($councilAddress->toArray('address.')):array()
	);
	
	$ct=$modx->getChunk('kofctn_councilTitle',$params);	
	
	$modx->toPlaceholders(array('councilTitle'=>$ct));
}

function getCouncilAddress($modx,$council,$addressType){
	
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
function council($modx){

	$council=getCouncil($modx);
	if (!$council){return null;}
	

	//council title
	councilTitle($modx,$council);
	
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

/*
if ($method=='profile') {profile($modx); return null;}

if ($method=='council'){return 'Deprecated council method invoked.';}
//if ($method=='council'){council($modx);return null;}

if ($method=='request') {
	$params = array(
			'name'=>isset($_POST['name'])?$_POST['name']:null
			,'memberEmail'=>isset($_POST['email'])?$_POST['email']:null
			,'memberNumber'=>isset($_POST['memberNumber'])?$_POST['memberNumber']:null
			,'councilNumber'=>isset($_POST['councilNumber'])?$_POST['councilNumber']:null
	);

		$validMsg = validateParameters($modx, $params);

		if ($validMsg){
			echo $validMsg;
		} else {
			$sent=requestAccess($modx,$params); 
			if ($sent) {
				echo("<label class='success h4'>Your request was received.  Please check your email for confirmation.  If you do not see the confirmation within 1 day, please email webmaster@kofc-tn.org.</label>");
			}
		}
		
		return null;
		
}

if ($method=='search') {$searchResults=search($modx); renderSearchResult($modx,$searchResults); return null;}
*/
return null;