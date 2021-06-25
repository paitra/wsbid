<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Produto extends RestController {

    public function index_get()
    { // sempre fica nulo nos parenteses
        //o primeiro parametro do load é o nome do model que queremos chamar
        //o segundo paramentro"um" é um 'apelido' o qual pode ser usado depois
        $this->load->model('produto_model', 'um');

        $id = $this->get('id');
        if ($id > 0) {
            $retorno = $this->um->get_one($id);  // get de um produto
        } else {
            $retorno = $this->um->get_all();
        }
       //echo  $this->db->last_query();
        $this->response($retorno, (($retorno) ? 200 : 400));
    }

    public function index_post()
    {
        if ((!$this->post('nome')) || (!$this->post('preco'))) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }


        $dados = [
            'nome' => $this->post('nome'),
            'preco' => $this->post('preco'),
            'cod_categoria' => $this->post('cod_categoria'),
            'cod_marca' => $this->post('cod_marca')
        ];

        //carregamos o model
        $this->load->model('produto_model', 'um');
        //mandamos inserir na base através do metodo insert do produto__model
        if ($this->um->insert($dados)) {
            $this->response([
                'status' => true,
                'mensage' => 'produto inserido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao inserir produto'
            ], 400); //400 bad request

        }
    }

    public function index_delete()
    {
        $id = $this->get('id');
        if ($id <= 0 ) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }

        //carregamos o model
        $this->load->model('produto_model', 'um');
        //mandamos inserir na base através do metodo insert do produto__model
        if ($this->um->delete($id)) {
            $this->response([
                'status' => true,
                'mensage' => 'produto excluido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao excluir produto'
            ], 400); //400 bad request

        }
    }
    public function index_put()
    {
        $id = $this->get('id');
        if ((!$this->put('nome')) || (!$this->put('preco')) || $id <= 0) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }
        $dados = [
            'nome' => $this->put('nome'),
            'preco' => $this->put('preco')
        ];

        //carregamos o model
        $this->load->model('produto_model', 'um');
        //mandamos inserir na base através do metodo insert do produto__model
        if ($this->um->update($id, $dados)) {
            $this->response([
                'status' => true,
                'mensage' => 'produto alterado com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Produto não alterado'
            ], 400); //400 bad request

        }
    }

}

/* End of file Usuario.php */
