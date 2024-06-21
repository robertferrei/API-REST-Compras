<?php

namespace App\Controllers;

use App\Models\ProdutosModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ProdutosController extends ResourceController
{
    private $produtoModel;
    private $token = '1234555';
    public function __construct()
    {
        $this->produtoModel = new \App\Models\ProdutosModel();
    }

    //validação de token
    private function _validaToken()
    {
        return $this->request->getHeaderLine('token') == $this->token;
    }

    //retorno de todos os produtos cadastrados(GET)        
    public function list()
    {
        $data = $this->produtoModel->findAll(); //buscando todos os produtos da tabela produtos
        return $this->response->setJSON($data); //formatando o resultado para json
    }
    //criando produtos

    public function create()
    {
        $response = [];

        //validando token
        if ($this->_validaToken() == true) {
            $newProduto['produto'] = $this->request->getPost('produto');
            $newProduto['valor'] = $this->request->getPost('valor');

            try {
                if ($this->produtoModel->insert($newProduto)) {
                    //produto adicionado
                    $response = [
                        'response' => 'sucesso',
                        'msg' => 'Produto criado com sucesso'
                    ];
                }
                //criando erros
                else {
                    $response = [
                        'response' => 'error',
                        'msg' => 'Erro ao salvar produto tente novamente',
                        'erros' => $this->produtoModel->errors()
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'response' => 'error',
                    'msg' => 'Erro ao salvar produto ',
                    'erros' => [
                        'exception' => $e->getMessage()
                    ]
                ];
            }
        } else {
            $response = [
                'response' => 'error',
                'msg' => 'token inválido'
            ];
        }
        return $this->response->setJSON($response); //formatando para que venha em formato Json
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON();
        $response = [];

        if ($this->produtoModel->update($id, $data)) {
            $response = [
                'status' => 200,
                'error' => null,
                'msg' => [
                    'sucess' => 'Dados atualizado com Sucesso'
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->produtoModel->errors()); //retorna o erro        
        }
    }
}
