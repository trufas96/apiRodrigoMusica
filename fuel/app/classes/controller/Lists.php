<?php
use \Model\Users;
use Firebase\JWT\JWT;
class Controller_Lists extends Controller_Base
{
	public function post_create()
    {
        $authenticated = $this->authenticate();
        $arrayAuthenticated = json_decode($authenticated, true);
        if($arrayAuthenticated['authenticated'])
        {
            $decodedToken = JWT::decode($arrayAuthenticated["data"], MY_KEY, array('HS256'));

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




    public function get_show()
    {   
        $authenticated = $this->authenticate();
        $arrayAuthenticated = json_decode($authenticated, true);
         $decodedToken = JWT::decode($arrayAuthenticated["data"], MY_KEY, array('HS256'));
         if($arrayAuthenticated['authenticated'])
         {
                if(isset($_GET['idlist']))
                {
                    $idlist = $_GET['idlist'];
                    $list = Model_Lists::find('all',
                                                    array('where' => array(
                                                    array('id_user', '=', $decodedToken->id),
                                                    array('id', '=', $idlist) 
                                                    )
                                                )
                                            );
                    if(!empty($list)){
                        return $this->respuesta(200, 'mostrando el recuerdo', Arr::reindex($list));                            
                    }
                    else
                    {
                            $json = $this->response(array(
                                 'code' => 202,
                                 'message' => 'Aun no tienes ningun recuerdo',
                                    'data' => ''
                                ));
                                return $json;
                    }
            
                }
                else
                {
                    $stories = Model_Stories::find('all', 
                                                    array('where' => array(
                                                        array('id_user', '=', $decodedToken->id), 
                                                        )
                                                    )
                                                );
                    if(!empty($stories)){
                        return $this->respuesta(200, 'mostrando lista de recuerdos del usuario', Arr::reindex($stories));                           
                    }else{
                        
                        $json = $this->response(array(
                                     'code' => 202,
                                     'message' => 'Aun no tienes ningun recuerdo',
                                        'data' => ''
                                    ));
                                    return $json;
                        }
                }
        }
        else
        {
                
                $json = $this->response(array(
                             'code' => 401,
                             'message' => 'NO AUTORIZACION',
                                'data' => ''
                            ));
                            return $json;
        }
    }





    public function post_delete()
    {
        $authenticated = $this->authenticate();
        $arrayAuthenticated = json_decode($authenticated, true);
        
         if($arrayAuthenticated['authenticated']){
             $decodedToken = JWT::decode($arrayAuthenticated["data"], MY_KEY, array('HS256'));
             if(!empty($_POST['id'])){
                 $list = Model_Lists::find($_POST['id']);
                 if(isset($list)){
                     if($decodedToken->id == $list->id_user){
                         $list->delete(); 
                    
                         $json = $this->response(array(
                             'code' => 200,
                             'message' => 'recuerdo borrado',
                                'data' => ''
                         ));
                         return $json;
                        }else{
                            $json = $this->response(array(
                             'code' => 401,
                             'message' => 'No puede borrar un recuerdo que no es tuyo',
                                'data' => ''
                            ));
                            return $json;
                    }
                    }else{
                        $json = $this->response(array(
                             'code' => 401,
                             'message' => 'Recuerdo no valido',
                                'data' => ''
                            ));
                            return $json;
                        }
                    }else{
                        $json = $this->response(array(
                             'code' => 400,
                             'message' => 'El id no puede estar vacio',
                                'data' => ''
                            ));
                            return $json;
                        }
            }else{
                    $json = $this->response(array(
                     'code' => 400,
                     'message' => 'Falta el autorizacion',
                     'data' => ''
                    ));
                    return $json;
                }
        }