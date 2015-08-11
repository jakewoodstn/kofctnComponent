<?php
/**
 * @package kofctn
 */
 
 function init($modx){
 
 /* DO NOT MOVE THESE LINES!!!!*/
 $base_path = !empty($base_path) ? $base_path : $modx->getOption('core_path').'components/kofctn/';
 $modx->addPackage('kofctn',$base_path.'model/');
 /* DO NOT MOVE THESE LINES!!!!*/
  }

  
 
/*
$fyear = $modx->newObject('fraternalYear');
$fyear->fromArray(array('fraternalYearName'=>'2015','dateStart'=>'7/1/2015','dateEnd'=>'6/30/2016'));
$fyear->save();




$council=$modx->newObject('council');
$council->fromArray(
	array(
	'councilNumber'=>7764,
	'name'=>'St. Philip',
	'mailingCity'=>'Franklin',
	'mailingState'=>'TN',
	'mailingZip'=>'37064'
	));
$council->save();

if (!$myuser){
	$stpCouncil=$modx->getObject('council',array('councilNumber'=>7764),false);
	$kcusers=$modx->getCollection('kofcuser',null,false);
	$myuser = $modx->newObject('kofcuser');
	$myuser-> fromArray(array('name'=>$modx->user->username,'created_at' =>'1/1/2015','councilId'=>$stpCouncil->get('id')));
	$myuser->save(); 
}
*/
function userPage($modx){

init($modx);

$myuser=$modx->getObject('kofcuser',array('name'=>$modx->user->username),false);

if($myuser){

	$addr=$myuser->getMany('memberMemberAddress',array('addressType'=>'home'));
	foreach ($addr as $a){
		echo $a->get('street1');
	}

	/*
	$addr=$modx->newObject('memberAddress');
	$addr->fromArray(array('addressType'=>'home','street1' => '412 Crofton Park Lane' ,'city'=>'Franklin','state'=>'TN','zip'=>'37069'));
	$myuser->addMany($addr);
 	$myuser->save();
 	*/
$baseImage = '/assets/images/memberPhotos/';

if ($myuser)
{
	$imagePath = $baseImage . $myuser->get('imagePath');
}

//$mycouncil=$modx->getObject('council',array('id'=>$myuser->get('councilId')));
$mycouncil=$myuser->getOne('memberCouncil');

$modx->toPlaceholders(array("imagePath"=>$imagePath),'');
$modx->toPlaceholders($myuser->toArray(),'member');
$modx->toPlaceholders($mycouncil->toArray(),'council');

	}

return null;}