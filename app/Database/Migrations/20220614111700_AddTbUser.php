<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTbUser extends Migration
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
            'email_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'session_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
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
        $this->forge->addKey('email_address');

        $this->forge->createTable('tb_user');
    }

    public function down()
    {
        $this->forge->dropTable('tb_user');
    }
}