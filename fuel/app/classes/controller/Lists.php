<?php
use \Model\Users;
use Firebase\JWT\JWT;
class Controller_lists extends Controller_Base
{
	public function post_create()
    {
        try {
            if ( !isset($_POST['userName']) || !isset($_POST['password']) || !isset($_POST['email'])) 
            {
            	return $this->respuesta(400, 'Algun paramentro esta vacio', '');
            }if(isset($_POST['x']) || isset($_POST['y'])){
            		
            		if(empty($_POST['x']) || empty($_POST['y'])){
	            		return $this->respuesta(400, 'Coordenadas vacias', '');
	            	}
            	}
            	else
            	{
            		return $this->respuesta(400, 'Coordenadas no definidas', '');
            	}
            if(!empty($_POST['userName']) && !empty($_POST['password']) && !empty($_POST['email']))
            {
            	if(strlen($_POST['password']) < 5)
            	{
            		return $this->respuesta(400, 'La contraseña debe tener al menos 5 caracteres', '');
            	}
				$input = $_POST;
	            $newUser = $this->newUser($input);
	           	$json = $this->saveUser($newUser);
	        }
	        else
	        {
	        	return $this->respuesta(400, 'Algun campo vacio', '');
	        }
        }catch (Exception $e){
        	return $this->respuesta(500, $e->getMessage(), '');
        }      
    }
    private function newUser($input)
    {
    		$user = new Model_Users();
            $user->name = $input['name'];
            $user->name = $input['name'];
            $user->id_user = $input['id_device'];
            $user->editable = $input['ediitable']
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