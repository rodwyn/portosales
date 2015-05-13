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
			$companiesdb = Usercompanypermission::model()->findAllbyAttributes(array('userid'=>$user->userid,'active'=>1));	
                       
                       $menu_model = new Menu();
                       $type=$user->usertype;
                       $useri=$user->userid;
                       $menu = $menu_model->qryMenu($type,$useri);
                      
                        
                        $items[] = array('label'=>'Cambiar compania');
			foreach( $companiesdb as $row){
				$tax1 = explode(',',$row->company->tax);
				$duration1 = explode(',',$row->company->duration);
				foreach($tax1 as $tx){
						$taxes[$tx]=$tx." %";
				}
				foreach($duration1 as $dur){
					$durations[$dur]=$dur." hrs";
				}
						
				if($row->company->active==1){
					if(!isset($companyid) && !isset($companydsc)){
						$companyid = $row->company->companyid;
						$companydsc = $row->company->companydsc;
						$tax = $taxes;
						$duration = $durations;						
					}
					
					$companies[$row->companyid] = array('companydsc'=>$row->company->companydsc, 'tax'=>$taxes, 'duration'=>$durations);		
					$items[] = array('label'=>$row->company->companydsc, 'url'=>Yii::app()->createAbsoluteUrl('/portoprint/change/company',array('id'=>$row->companyid)));		
			
				}
			}
			
			$items[] = '---';
            $items[] = array('label'=>'Cerrar Sesion');
            $items[] = array('label'=>'Salir', 'url'=>Yii::app()->createAbsoluteUrl("site/logout"));
                        
                        $vars=  Profile::model()->findByAttributes(array('profileid'=>$user->profileid));
                        
			$this->setState('userid',$user->userid);
                        $this->setState('specialpermission',  $vars->specialpermission);
                        $this->setState('profileid',$user->profileid);
			$this->setState('username',$user->employeeuser->firstname." ".$user->employeeuser->plastname);
			$this->setState('usertype',$user->usertype);
			$this->setState('companies',$companies);
			$this->setState('companyid',$companyid);
			$this->setState('companydsc',$companydsc);
			$this->setState('tax',$tax);
			$this->setState('duration',$durations);
			$this->setState('items',$items);
                        $this->setState('menu',$menu);
			
                    } else if($user->usertype==2){
                        
                      
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