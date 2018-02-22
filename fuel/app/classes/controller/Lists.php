<?php
use \Model\Users;
use Firebase\JWT\JWT;
class Controller_Lists extends Controller_Base
{
	public function post_create()
    {
        try {
            if ( !isset($_POST['title']) &&  empty($_POST['title']))
            {
            	return $this->respuesta(400, 'Nombre vacio', '');
            
            
				$input = $_POST;
	            $newUser = $this->newUser($input);
	           	$json = $this->saveUser($newUser);
	        }
	        else
	        {
	        	return $this->respuesta(400, 'Algun campo vacio', '');
	        }
        }
        catch (Exception $e)
        {
        	return $this->respuesta(500, $e->getMessage(), '');
        }      
    }
}

    private function newUser($input)
    {
    		$user = new Model_Users();
            $user->name = $input['name'];
            $user->name = $input['name'];
            $user->id_user = $input['id_device'];
            $user->editable = $input['editable']
            return $user;
    }

    private function saveUser($user)
    {
    	$userExists = Model_Users::find('all', 
    								array('where' => array(
    													array('email', '=', $user->email),
    														)
    									)
    							);
    	if(empty($userExists)){
    		$userToSave = $user;
    		$userToSave->save();
    		$arrayData = array();
    		$arrayData['userName'] = $user->userName;
    		return $this->respuesta(201, 'Usuario creado', $arrayData);
    	}else{
    		return $this->respuesta(204, 'Usuario ya registrado', '');
    	}
    }