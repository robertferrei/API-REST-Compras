<?php

namespace App\Models;
use CodeIgniter\Model;

class ClientesModel extends Model{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome_razao','cpf_cnpj']; //colunas das tabelas que serão pegas
    protected $validationRules = [
        'nome_razao' => 'required|min_length[3]|is_unique[clientes.nome_razao]', //nome é obrigatório com minimo de 3 caracteres
    ];
}
