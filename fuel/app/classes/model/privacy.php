<?php  
class Model_Privacy extends Orm\Model
{
	protected static $_table_name = 'privacy';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
        'id' => array('data_type' => 'int'),
        'profile' => array('data_type' => 'varchar'),
        'friends' => array('data_type' => 'varchar'),
        'lists' => array('data_type' => 'varchar'),
        'notifications' => array('data_type' => 'int'),
        'id_user' => array('data_type' => 'int')
    );
    protected static $_belongs_to = array(
        'user' => array(
            'key_from' => 'id_user',
            'model_to' => 'Model_Users',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false
        )
    );
}