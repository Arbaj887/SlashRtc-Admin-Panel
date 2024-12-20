<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Campaign extends Migration
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
            'description' => [
                'type' => 'VARCHAR',

                'constraint' => 255,
                'unique' => true,
                'null' => false,
            ],
            'client' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            
       ]);
       $this->forge->addPrimaryKey('id');
       $this->forge->createTable('campaign');
    }

    public function down()
    {
        $this->forge->dropTable('campaign');
    }
}
