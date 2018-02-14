<?php
namespace Fuel\Migrations;
class Songs
{
    function up()
    {
        \DBUtil::create_table('songs', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'title' => array('type' => 'varchar', 'constraint' => 100),
            'url' => array('type' => 'varchar', 'constraint' => 100),
            'artist' => array('type' => 'varchar', 'constraint' => 100),
            ), array('id'));
    }
    function down()
    {
       \DBUtil::drop_table('songs');
    }
}