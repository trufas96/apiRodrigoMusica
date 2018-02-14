<?php

namespace Fuel\Migrations;


class News
{

    function up()
    {
        \DBUtil::create_table('news', 
            array(
                'id' => array('type' => 'int', 'constraint' => 100,'auto_increment' => true),
                'title' => array('type' => 'varchar', 'constraint' => 100),
                'description' => array('type' => 'varchar', 'constraint' => 300),
                'id_user' => array('type'=> 'int', 'constraint' => 100)

        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
    array(
        array(
            'constraint' => 'claveForaneaNewsAUser',
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
       \DBUtil::drop_table('news');
    }
}