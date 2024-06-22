<?php

namespace App\Controllers;

use App\Models\PedidosModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class PedidosController extends ResourceController
{
    private $pedidosModel;
    private $idClientesModel;
    public function __construct()
    {
        $this->pedidosModel = new \App\Models\PedidosModel();
        $this->idClientesModel = new \App\Models\ClientesModel();
    }
    public function get()
    {
        $data = $this->pedidosModel->findAll();
        return $this->response->setJSON($data); //format data
    }
    public function create()
    {
        $response = [];
        $newPedidos['status'] = $this->request->getPost('status');
        $newPedidos['total'] = $this->request->getPost('total');        
        $cliente_id = $this->request->getPost('cliente_id'); //recebe id do cliente/chave estrangeira
        
        $cliente = $this->idClientesModel->find($cliente_id);

        if(!$cliente){
            //caso nao encontre o cliente
            return $this->response->setJSON([
                    'response' => 'error',
                    'mensage'=> 'Cliente não encontrado'
            ])->setStatusCode(404);
        }
        //caso exista cliente
        $newPedidos['cliente_id'] =$cliente_id;
        
        try {
            if ($this->pedidosModel->insert($newPedidos)) {
                $response = [
                    'response' => 'sucesso',
                    'mensage' => 'Pedido cadastrado com sucesso'
                ];
            } else {
                $response = [
                    'response' => 'error',
                    'mensage' => 'erro ao cadastrar Pedidos '
                ];
            }
        } catch (Exception $e) {
            $response = [
                'response' => 'error',
                'mensage' => 'Erro ao salvar Pedidos',
                'errors' => [
                    'exception' => $e->getMessage()
                ]
            ];
        }
        return $this->response->setJSON($response);
    }
    public function update($id = null)
    { 
        $data = $this->request->getJSON();
        $response = [];

        if ($this->pedidosModel->update($id, $data)) {
            $response = [
                'status' => 200,
                'error' => null,
                'mensage' => [
                    'sucess' => 'Dados atualizado com sucesso'
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->pedidosModel->errors());
        }
    }
    public function delete($id = null)
    {        
        $response = [];
        try {
            $cliente = $this->pedidosModel->find($id);
            if ($cliente) {
                if ($this->pedidosModel->delete($id)) {
                    $response = [
                        'status' => 200,
                        'error' => null,
                        'mensage' => [
                            'sucess' => 'Dados Deletado com sucesso'
                        ]
                    ];
                } else {
                    $response = [
                        'response' => 'error',
                        'mensage' => 'Erro ao deletar cliente'
                    ];
                }                
            }else{
                //caso nao encontre clientes
                return $this->response->setJSON([
                    'response' => 'error',
                    'mensage' => 'Cliente nao encontrado'

                ])->setStatusCode(404);
            }                       
        } catch (Exception $e) {
            $response = [
                'response' => 'error',
                'mensage' => 'erro ao deletar cliente',
                'errors' => [
                    'exception' => $e->getMessage()
                ]
            ];
        }
         return response( $this->response->setJSON($response));
    }
}
