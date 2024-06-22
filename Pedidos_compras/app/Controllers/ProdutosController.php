<?php

namespace App\Controllers;

use App\Models\ProdutosModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ProdutosController extends ResourceController
{
    private $produtosModel;
    public function __construct()
    {
        $this->produtosModel = new \App\Models\ProdutosModel();        
    }
    public function get()
    {
        $data = $this->produtosModel->findAll();
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
        $produtos = $this->produtosModel->find($id);
        if ($produtos) {
            return $this->response->setJSON([
                'status' => 'sucess',
                'data' => $produtos

            ])->setStatusCode(200);
        }else{
            return $this->response->setJSON([
                'status'=> 'error',
                'mensagem' => 'produto não encontrado'
            ])->setStatusCode(404);
        }    
    }
    public function create()
    {
        $response = [];
        $newProdutos['descricao'] = $this->request->getPost('descricao');
        $newProdutos['valor'] = $this->request->getPost('valor');

        try {
            if ($this->produtosModel->insert($newProdutos)) {
                $response = [
                    'response' => 'sucesso',
                    'mensage' => 'Pedido cadastrado com sucesso'
                ];
            } else {
                $response = [
                    'response' => 'error',
                    'mensagem' => 'erro ao cadastrar produtos '
                ];
            }
        } catch (Exception $e) {
            $response = [
                'response' => 'error',
                'mensagem' => 'Erro ao salvar produtos',
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

        if ($this->produtosModel->update($id, $data)) {
            $response = [
                'status' => 200,
                'error' => null,
                'mensagem' => [
                    'sucess' => 'Dados atualizado com sucesso'
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->produtosModel->errors());
        }
    }

    public function delete($id = null)
    {
        $response = [];
        try {
            $produtos = $this->produtosModel->find($id);
            if ($produtos) {
                if ($this->produtosModel->delete($id)) {
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
                        'mensagem' => 'Erro ao deletar Produto'
                    ];
                }
            } else {
                return $this->response->setJSON([
                    'response' => 'error',
                    'mensagem' => 'Produto nao encontrado'

                ])->setStatusCode(404);
            }
        } catch (Exception $e) {
            $response = [
                'response' => 'error',
                'mensagem' => 'erro ao deletar Poduto',
                'errors' => [
                    'exception' => $e->getMessage()
                ]
            ];
        }
        return response($this->response->setJSON($response));
    }

}
