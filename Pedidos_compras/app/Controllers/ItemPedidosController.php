<?php

namespace App\Controllers;

use App\Models\ItemPedidos;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ItemPedidosController extends ResourceController
{
    private $itemPedidosModel;
    private $idPedidosModel;
    private $idProdutosModel;
    public function __construct()
    {
        $this->itemPedidosModel = new \App\Models\ItemPedidos();
        $this->idPedidosModel = new \App\Models\PedidosModel();
        $this->idProdutosModel = new \App\Models\ProdutosModel();
    }
    public function get()
    {
        $data = $this->itemPedidosModel->findAll();
        return $this->response->setJSON($data); //format data
    }
    public function getList($id = null)
    {       
        if ($id === null) {
            return $this->response->setJSON([
                'status' => 'error',
                'mensagem' => 'Id não encontrado'
            ])->setStatusCode(400);            
        }
        $item = $this->itemPedidosModel->find($id);
        if ($item) {
            return $this->response->setJSON([
                'status' => 'sucess',
                'data' => $item

            ])->setStatusCode(200);
        }else{
            return $this->response->setJSON([
                'status'=> 'error',
                'mensagem' => 'Item não encontrado'
            ])->setStatusCode(404);
        }    
    }
    public function create()
    {
        $response = [];

        $newItem['quantidade'] = $this->request->getPost('quantidade');
        $pedido_id = $this->request->getPost('pedido_id');
        $produtos_id = $this->request->getPost('produto_id');

        $pedidos = $this->idPedidosModel->find($pedido_id);
        $produtos = $this->idProdutosModel->find($produtos_id);

        if (!$pedidos) {
            return $this->response->setJSON([
                'response' => 'error',
                'mensagem' => 'Pedido não encontrado'
            ])->setStatusCode(400);;
        }
        if (!$produtos) {
            return $this->response->setJSON([
                'response' => 'error',
                'mensagem' => 'Produto nao encontrado'
            ])->setStatusCode(400);;
        }
        $newItem['pedido_id'] = $pedido_id;
        $newItem['produto_id'] = $produtos_id;

        try {
            if ($this->itemPedidosModel->insert($newItem)) {
                $response = [
                    'response' => 'sucesso',
                    'mensage' => 'item cadastrado com sucesso'
                ];
            } else {
                $response = [
                    'response' => 'error',
                    'mensage' => 'erro ao cadastrar Item '
                ];
            }
        } catch (Exception $e) {
            $response = [
                'response' => 'error',
                'mensagem' => 'Erro ao salvar Item',
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

        if ($this->itemPedidosModel->update($id, $data)) {
            $response = [
                'status' => 200,
                'error' => null,
                'mensage' => [
                    'sucess' => 'Dados atualizado com sucesso'
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->itemPedidosModel->errors());
        }
    }
    public function delete($id = null)
    {
        $response = [];
        try {
            $produtos = $this->itemPedidosModel->find($id);
            if ($produtos) {
                if ($this->itemPedidosModel->delete($id)) {
                    $response = [
                        'status' => 200,
                        'error' => null,
                        'mensagem' => [
                            'sucess' => 'Dados Deletado com sucesso'
                        ]
                    ];
                } else {
                    $response = [
                        'response' => 'error',
                        'mensagem' => 'Erro ao deletar Item'
                    ];
                }
            } else {
                return $this->response->setJSON([
                    'response' => 'error',
                    'mensagem' => 'Item nao encontrado'

                ])->setStatusCode(404);
            }
        } catch (Exception $e) {
            $response = [
                'response' => 'error',
                'mensagem' => 'erro ao deletar Item',
                'errors' => [
                    'exception' => $e->getMessage()
                ]
            ];
        }
        return response($this->response->setJSON($response));
    }
}
