<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemPedidosTable extends Migration
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
                'pedido_id'=>[
                    'type'=>'INT',
                    'constraint' => 11,
                    'unsigned' =>true
                ],

                'produto_id' => [                    
                    'type'=>'INT',
                    'constraint' => 11,
                    'unsigned' =>true
                ],
                'quantidade'=>[
                    'type'=> 'INT',
                    'constraint' =>11
                ],
          ]);

            $this->forge->addPrimaryKey('id');
            $this->forge->addForeignKey('pedido_id', 'pedidos', 'id', 'CASCADE', 'CASCADE');
            $this->forge->addForeignKey('produto_id', 'produtos', 'id', 'CASCADE', 'CASCADE');
            $this->forge->createTable('item_pedidos');
        //
    }

    public function down()
    {
        $this->forge->dropTable('item_pedidos');
        //
    }
}
