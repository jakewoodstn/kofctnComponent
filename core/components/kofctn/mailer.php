<?php
/**
* @package kofctn
*/
 
 class kcEmail {
 
 	public $paramArray;

 	function __construct(){
	 	
 		$this->paramArray=array();
 	}
 	
 	function setParam($incomingParam){
 		$this->paramArray=array_merge($this->paramArray,$incomingParam);
  	} 	
 	
 	function getParam($key){return $key?$this->paramArray[$key]:$this->paramArray;}
 
 	function checkReadyToSend(){
		$ready=false;
 		$required=array('replyTo','to','subject','message');
 		foreach ($required as $value) {
 			if (!$ready && array_key_exists($value, $this->paramArray)){$ready=true;}
  		}
 		return $ready;		
 	}
 	
 }
 
 
 class kcMailer {
 
 	protected $_modx;
 	protected $queued;
 	private $email;
	function __construct(&$modx)
	{
		$this->_modx = $modx;
		$this->_modx->getService('mail', 'mail.modPHPMailer');
		$this->setHeader(modMail::MAIL_SENDER,$this->_modx->getOption('emailsender'));
		$this->setHeader(modMail::MAIL_FROM, $this->_modx->getOption('emailsender'));
		$this->queued=false;
	}
	
	private function setHeader($header,$value){
        $this->_modx->mail->set($header,$value );
	}
	
	function queueEmail($kcEmail) {
		if ($kcEmail->checkReadyToSend()){
			$this->email=$kcEmail;
			$email=$this->email->getParam();
			$this->setHeader(modMail::MAIL_BODY, $email['message']);
	        $this->setHeader(modMail::MAIL_FROM_NAME, $email['fromName']?$email['fromName']:($email['from']?$email['from']:$email['replyTo']));
	        $this->setHeader(modMail::MAIL_SUBJECT, $email['subject']);
	        $this->_modx->mail->address('to', $email['to'], $email['toName']?$email['toName']:$email['to']);
	        $this->_modx->mail->address('reply-to', $email['replyTo']);
	        $this->_modx->mail->setHTML($email['html']?$email['html']:true);
	        $this->queued=true;
		}
	}
	
	function sendEmail() {
        if (!$this->queued){return false;}
        else{
	        $sent = $this->_modx->mail->send();
	        if (!$sent) {
	            $this->_modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email: '.$this->_modx->mail->mailer->ErrorInfo);
		    }
			$this->_modx->mail->reset();
			$this->setHeader(modMail::MAIL_SENDER,$this->_modx->getOption('emailsender'));
			$this->setHeader(modMail::MAIL_FROM, $this->_modx->getOption('emailsender'));
		    $this->queued=false;
		    return $sent;
		}
	}

}