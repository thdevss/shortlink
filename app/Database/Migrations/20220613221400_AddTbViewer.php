<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTbViewer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'link_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'raw_useragent' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'raw_referrer' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'v_ipaddr' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'v_useragent' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'v_referrer' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->addKey('link_id');

        $this->forge->createTable('tb_viewer');
    }

    public function down()
    {
        $this->forge->dropTable('tb_viewer');
    }
}