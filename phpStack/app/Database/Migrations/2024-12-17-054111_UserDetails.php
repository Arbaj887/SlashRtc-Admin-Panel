<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;


class UserDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,

            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',

                'constraint' => 255,
                'unique' => true,
                'null' => false,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'userRole' => [
                'type' => 'ENUM',
                'constraint' => array('user', 'admin'),
                'default' => 'user'
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('userDetails');
    }

    public function down()
    {
        $this->forge->dropTable('userDetails');
    }
}
