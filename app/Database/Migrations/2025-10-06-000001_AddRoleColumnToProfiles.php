<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleColumnToProfiles extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('profiles')) {
            return;
        }

        if ($this->db->fieldExists('role', 'profiles')) {
            return;
        }

        $this->forge->addColumn('profiles', [
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'user',
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        if (! $this->db->tableExists('profiles')) {
            return;
        }

        if (! $this->db->fieldExists('role', 'profiles')) {
            return;
        }

        $this->forge->dropColumn('profiles', 'role');
    }
}
