<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	
	public function authenticate()
	{
		$user = User::model()->findByAttributes(array('username'=>$this->username));	
		
		if($user === null)
                    $this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($user->password!==$this->password)
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
		else {
                     if($user->usertype==2){
                        
                      
                        $this->setState('userid',$user->userid);
			$this->setState('username',$user->supplieruser->firstname." ".$user->supplieruser->plastname);
                        $this->setState('usertype',$user->usertype);
                        $this->setState('supplierid',$user->supplieruser->supplierid);
                     
			
                    }else if($user->usertype==3){
                           
                            //$name=$cliente->getal
                         $this->setState('userid',$user->userid);
			$this->setState('username',$user->customeruser->firstname." ".$user->customeruser->plastname);
                        $this->setState('usertype',$user->usertype);                        
                         $this->setState('customerid',$user->customeruser->customerid);
                         $this->setState('tax','');
                         $this->setState('duration','');
                        
                         
                         
                    }
                    
			$this->errorCode=self::ERROR_NONE;
                        $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
	}
}