<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTbLink extends Migration
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
            'link_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '8',
                'unique'     => true,
            ],
            'destination_link' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'remark' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'ipaddr_created' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null' => true,
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('tb_link');
    }

    public function down()
    {
        $this->forge->dropTable('tb_link');
    }
}