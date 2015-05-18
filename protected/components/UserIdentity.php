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
                    if($user->usertype==1){
			$companiesdb = Usercompany::model()->findByAttributes(array('userid'=>$user->userid,'active'=>1));
                        $companyds=  Company::model()->findByAttributes(array("companyid"=>$companiesdb->companyid));
                        $type=$user->usertype;
                        $useri=$user->userid;
                        $this->setState('userid',$user->userid);
                        $this->setState('profileid',$user->profileid);
			$this->setState('username',$user->employeeuser->firstname." ".$user->employeeuser->plastname);
			$this->setState('usertype',$user->usertype);
			$this->setState('companyid',$companiesdb->companyid);
                        $this->setState('companydsc',$companyds->companydsc);
			
			
                    } else if($user->usertype==2){
                        
                      
                        $this->setState('userid',$user->userid);
			$this->setState('username',$user->supplieruser->firstname." ".$user->supplieruser->plastname);
                        $this->setState('usertype',$user->usertype);
                        $this->setState('supplierid',$user->supplieruser->supplierid);
                     
			
                    }
                    
			$this->errorCode=self::ERROR_NONE;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
	}
}