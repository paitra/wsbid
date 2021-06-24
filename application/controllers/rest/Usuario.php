<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Usuario extends RestController
{

    public function index_get()
    { // sempre fica nulo nos parenteses
        //o primeiro parametro do load é o nome do model que queremos chamar
        //o segundo paramentro"um" é um 'apelido' o qual pode ser usado depois
        $this->load->model('usuario_model', 'um');

        $id = $this->get('id');
        if ($id > 0) {
            $retorno = $this->um->get_one($id);  // get de um usuario
        } else {
            $retorno = $this->um->get_all();
        }

        $this->response($retorno, (($retorno) ? 200 : 400));
    }

    public function index_post()
    {
        if ((!$this->post('nome')) || (!$this->post('login') || (!$this->post('senha')))) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }


        $dados = [
            'nome' => $this->post('nome'),
            'login' => $this->post('login'),
            'senha' => $this->post('senha'),
            'saldo' => $this->post('saldo')

        ];

        //carregamos o model
        $this->load->model('usuario_model', 'um');
        //mandamos inserir na base através do metodo insert do usuario__model
        if ($this->um->insert($dados)) {
            $this->response([
                'status' => true,
                'mensage' => 'usuario inserido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao inserir usuario'
            ], 400); //400 bad request

        }
    }

    public function index_delete()
    {
        $id = $this->get('id');
        if ($id <= 0) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }

        //carregamos o model
        $this->load->model('usuario_model', 'um');
        //mandamos inserir na base através do metodo insert do usuario__model
        if ($this->um->delete($id)) {
            $this->response([
                'status' => true,
                'mensage' => 'usuario excluido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao excluir usuario'
            ], 400); //400 bad request

        }
    }
    public function index_put()
    {
        $id = $this->get('id');
        if ((!$this->put('nome')) || (!$this->put('login')) || (!$this->put('senha')) || $id <= 0) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }
        $dados = [
            'nome' => $this->put('nome'),
            'login' => $this->put('login'),
            'senha' => $this->put('senha'),
            'saldo' => $this->put('saldo')
        ];

        //carregamos o model
        $this->load->model('usuario_model', 'um');
        //mandamos inserir na base através do metodo insert do usuario__model
        if ($this->um->update($id, $dados)) {
            $this->response([
                'status' => true,
                'mensage' => 'usuario alterado com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'usuario não alterado'
            ], 400); //400 bad request

        }
    }
}

/* End of file Usuario.php */
