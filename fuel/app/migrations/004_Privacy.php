<?php

namespace Fuel\Migrations;


class Privacy
{

    function up()
    {
        \DBUtil::create_table('privacy', 
            array(
                'id' => array('type' => 'int', 'constraint' => 100,'auto_increment' => true),
                'profile' => array('type' => 'varchar', 'constraint' => 100),
                'friends' => array('type' => 'varchar', 'constraint' => 300),
                'lists' => array('type' => 'varchar', 'constraint' => 300),
                'notifications' => array('type' => 'varchar', 'constraint' => 300),
                'id_user' => array('type'=> 'int', 'constraint' => 100)

        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
    array(
        array(
            'constraint' => 'claveAjenaPrivacyAUser',
            'key' => 'id_user',
            'reference' => array(
                'table' => 'users',
                'column' => 'id',
            ),
            'on_update' => 'CASCADE',
            'on_delete' => 'RESTRICT'
            ))
        );
           
    }

    function down()
    {
       \DBUtil::drop_table('privacy');
    }
}