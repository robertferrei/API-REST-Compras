<?php

namespace App\Controllers;

use App\Models\ClientesModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ClientesController extends ResourceController
 {
    private $clientesModel;
    public function __construct()
    {
        $this->clientesModel = new \App\Models\ClientesModel();        
    }
    
    public function get(){
        $data = $this->clientesModel->findAll();
        return $this->response->setJSON($data); //format data
    }
    public function create(){
        $response = [];
        $newCliente['nome_razao'] =$this->request->getPost('nome_razao');
        $newCliente['cpf_cnpj'] = $this->request->getPost('cpf_cnpj');

        try{
            if($this->clientesModel->insert($newCliente)){
                $response = [
                    'response'=> 'sucesso',
                    'mensage' => 'cliente cadastrado com sucesso'
                ];
            }
            else{
                $response = [
                    'response' => 'error',
                    'mensage' => 'erro ao cadastrar clientesss'
                ];
            }

        }catch(Exception $e){
            $response =[
                'response' => 'error',
                'mensage' => 'Erro ao salvar Cliente',
                'errors'=>[
                    'exception'=> $e->getMessage()
                ]
            ];
        }
        return $this->response->setJSON($response);

    }
    
 }
