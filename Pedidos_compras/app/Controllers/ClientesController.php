<?php

namespace App\Controllers;

use App\Models\ClientesModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use PHPUnit\Framework\MockObject\ReturnValueGenerator;

class ClientesController extends ResourceController
{
    private $clientesModel;
    public function __construct()
    {
        $this->clientesModel = new \App\Models\ClientesModel();
    }
    public function get()
    {
        $data = $this->clientesModel->findAll();
        return $this->response->setJSON($data); //format data
    }
    public function getList($id = null)
    {       
        if ($id === null) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Id não encontrado'
            ])->setStatusCode(400);            
        }


        $cliente = $this->clientesModel->find($id);
        if ($cliente) {
            return $this->response->setJSON([
                'status' => 'sucess',
                'data' => $cliente

            ])->setStatusCode(200);
        }else{
            return $this->response->setJSON([
                'status'=> 'error',
                'mensagem' => 'Cliente não encontrado'
            ])->setStatusCode(404);
        }


        //if ($this->clientesModel->update($id, $data)) {
    }

    public function create()
    {
        $response = [];
        $newCliente['nome_razao'] = $this->request->getPost('nome_razao');
        $newCliente['cpf_cnpj'] = $this->request->getPost('cpf_cnpj');

        try {
            if ($this->clientesModel->insert($newCliente)) {
                $response = [
                    'response' => 'sucesso',
                    'mensage' => 'cliente cadastrado com sucesso'
                ];
            } else {
                $response = [
                    'response' => 'error',
                    'mensage' => 'erro ao cadastrar cliente digite um nome com mais de 3 caracteres, verefique se o nome ja é existente '
                ];
            }
        } catch (Exception $e) {
            $response = [
                'response' => 'error',
                'mensage' => 'Erro ao salvar Cliente',
                'errors' => [
                    'exception' => $e->getMessage()
                ]
            ];
        }
        return $this->response->setJSON($response);
    }
    public function update($id = null)
    { //id cliente
        $data = $this->request->getJSON();
        $response = [];

        if ($this->clientesModel->update($id, $data)) {
            $response = [
                'status' => 200,
                'error' => null,
                'mensage' => [
                    'sucess' => 'Dados atualizado com sucesso'
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->clientesModel->errors());
        }
    }
    public function delete($id = null)
    {
        $response = [];
        try {
            $cliente = $this->clientesModel->find($id);
            if ($cliente) {
                if ($this->clientesModel->delete($id)) {
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
            } else {
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
        return response($this->response->setJSON($response));
    }
}
