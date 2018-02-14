<?php  
class Model_Users extends Orm\Model
{
	protected static $_table_name = 'users';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
        'id' => array('data_type' => 'int'),
        'userName' => array('data_type' => 'varchar'),
        'email' => array('data_type' => 'varchar'),
        'password' => array('data_type' => 'varchar'),
        'id_role' => array('data_type' => 'int'),
        'id_device' => array('data_type' => 'varchar'),
        'description' => array('data_type' => 'varchar'),
        'profilePicture' => array('data_type' => 'varchar'),
        'x' => array('data_type' => 'varchar'),
        'y' => array('data_type' => 'varchar')        
    );
    protected static $_has_one = array(
        'privacity' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Privacy',
            'key_to' => 'id_user',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );
    protected static $_has_many = array(
        'list' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Lists',
            'key_to' => 'id_user',
            'cascade_save' => true,
            'cascade_delete' => true
        ),
        'new' => array(
            'key_from' => 'id',
            'model_to' => 'Model_News',
            'key_to' => 'id_user',
            'cascade_save' => true,
            'cascade_delete' => false
        )
    );
    protected static $_belongs_to = array(
        'rol' => array(
            'key_from' => 'id_rol',
            'model_to' => 'Model_Roles',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false
        )
    );
    protected static $_many_many = array(
        'follower' => array(
            'key_from' => 'id',
            'key_through_from' => 'id_friend',
            'table_through' => 'userFollowFriends',
            'key_through_to' => 'id_follower_user',
            'model_to' => 'Model_Users',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false
        ),
        'followed' => array(
            'key_from' => 'id',
            'key_through_from' => 'id_user',
            'table_through' => 'userFollowFriends',
            'key_through_to' => 'id_followed_user',
            'model_to' => 'Model_Users',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false
        )
    );
}
