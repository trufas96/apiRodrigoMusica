<?php
namespace Fuel\Migrations;
class ListHaveSongs
{
    function up()
    {
        \DBUtil::create_table('listHaveSongs', array(
            'id_list' => array('constraint' => 11, 'type' => 'int'),
            'id_song' => array('constraint' => 11, 'type' => 'int')
            ),array('id_list', 'id_song'), false, 'InnoDB', 'utf8_unicode_ci',
        array(
            array(
                'constraint' => 'claveAjenalistASong',
                'key' => 'id_list',
                'reference' => array(
                    'table' => 'lists',
                    'column' => 'id',
                ),
                'on_update' => 'CASCADE',
                'on_delete' => 'RESTRICT'
            ),
            array(
                'constraint' => 'claveAjenaSongAList',
                'key' => 'id_list',
                'reference' => array(
                    'table' => 'songs',
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
       \DBUtil::drop_table('listHaveSongs');
    }
}
