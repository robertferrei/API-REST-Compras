<?php

namespace App\Models;
use CodeIgniter\Model;

class ItemPedidos extends Model{
    protected $table = 'item_pedidos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pedido_id','produto_id','quantidade']; //colunas das tabelas que serão pegas
    
}
