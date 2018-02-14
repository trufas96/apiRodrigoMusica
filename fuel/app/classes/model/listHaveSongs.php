<?php  
class Model_ListHaveSongs extends Orm\Model
{
	protected static $_table_name = 'listHaveSongs';
	protected static $_primary_key = array('id_list', 'id_song');
	protected static $_properties = 
	array(
        'id_list'=> array('data_type' => 'int'), 
        'id_song' => array('data_type' => 'int')
    );
}