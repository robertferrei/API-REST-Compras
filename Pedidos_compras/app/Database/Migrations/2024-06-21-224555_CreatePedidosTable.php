<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidosTable extends Migration
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
                'cliente_id' => [                    
                    'type'=>'INT',
                    'constraint' => 11,
                    'unsigned' =>true,                    
                ],
                'status'=> [
                    'type' => 'ENUM',
                    'constraint' => ['em Aberto','Pago','Cancelado']
                ],
                'total'=>[
                    'type'=>'DOUBLE',                    
                ]
          ]);

            $this->forge->addPrimaryKey('id');
            $this->forge->addForeignKey('cliente_id','clientes', 'id', 'CASCADE', 'CASCADE');
            $this->forge->createTable('pedidos');
        //
    }

    public function down()
    {
        $this->forge->dropTable('pedidos');
        //
    }
}
