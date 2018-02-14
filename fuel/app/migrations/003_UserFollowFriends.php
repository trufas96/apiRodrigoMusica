<?php
namespace Fuel\Migrations;
class UserFollowFriends
{
    function up()
    {
        \DBUtil::create_table('userFollowFriends', array(
            'id_user' => array('constraint' => 11, 'type' => 'int'),
            'id_friend' => array('constraint' => 11, 'type' => 'int')
            ),array('id_user', 'id_friend'), false, 'InnoDB', 'utf8_unicode_ci',
        array(
            array(
                'constraint' => 'claveAjenaFriendAUser',
                'key' => 'id_user',
                'reference' => array(
                    'table' => 'users',
                    'column' => 'id',
                ),
                'on_update' => 'CASCADE',
                'on_delete' => 'RESTRICT'
            ),
            array(
                'constraint' => 'claveAjenaUserAFriend',
                'key' => 'id_friend',
                'reference' => array(
                    'table' => 'users',
                    'column' => 'id',
                ),
                'on_update' => 'CASCADE',
                'on_delete' => 'RESTRICT'
            )
        )
    );
    }
    function down()
    {
       \DBUtil::drop_table('userFollowFriends');
    }
}