<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' =>true,
                'auto_increment' => true
            ],
            'nome_razao' => [
                'type'=>'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'cpf_cnpj' =>[
                'type'=>'VARCHAR',
                'constraint'=>20
            ]        
            ]);
            $this->forge->addPrimaryKey('id');
            $this->forge->createTable('clientes');
        //
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
        //
    }
}
