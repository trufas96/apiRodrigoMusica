<?php  
class Model_Roles extends Orm\Model
{
	protected static $_table_name = 'roles';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
        'id'=> array('data_type' => 'int'),
        'type' => array('data_type' => 'varchar')
    );
    protected static $_has_many = array(
        'user' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Users',
            'key_to' => 'id_role',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );
}
