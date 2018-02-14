<?php  
class Model_UserFollowFriends extends Orm\Model
{
	protected static $_table_name = 'userFollowFriends';
	protected static $_primary_key = array('id_user', 'id_friend');
	protected static $_properties = 
	array(
        'id_user'=> array('data_type' => 'int'), 
        'id_friend' => array('data_type' => 'int')
    );
}