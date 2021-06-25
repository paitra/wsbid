<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Leilao extends RestController
{

    public function index_get()
    { // sempre fica nulo nos parenteses
        //o primeiro parametro do load é o nome do model que queremos chamar
        //o segundo paramentro"um" é um 'apelido' o qual pode ser usado depois
        $this->load->model('leilao_model', 'um');

        $id = $this->get('id');
        if ($id > 0) {
            $retorno = $this->um->get_one($id);  // get de um leilao
        } else {
            $retorno = $this->um->get_all();
        }

        $this->response($retorno, (($retorno) ? 200 : 400));
    }

    public function index_post()
    {
        if ((!$this->post('cod_produto')) || (!$this->post('valor_inicial') || (!$this->post('status')))) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }


        $dados = [
            'cod_produto'   => $this->post('cod_produto'),
            'valor_inicial' => $this->post('valor_inicial'),
            'status'        => $this->post('status'),
            'data_inicial'  => $this->post('data_inicial'),
            'data_final'    => $this->post('data_final')

        ];

        //carregamos o model
        $this->load->model('leilao_model', 'um');
        //mandamos inserir na base através do metodo insert do leilao__model
        if ($this->um->insert($dados)) {
            $this->response([
                'status' => true,
                'mensage' => 'leilao inserido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao inserir leilao'
            ], 400); //400 bad request

        }
    }

    public function index_delete()
    {
        $id = $this->get('id');
        if ($id <= 0) {
            $this->response([
                'status'   => false,
                'error'    => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }

        //carregamos o model
        $this->load->model('leilao_model', 'um');
        //mandamos inserir na base através do metodo insert do leilao__model
        if ($this->um->delete($id)) {
            $this->response([
                'status'    => true,
                'mensage'   => 'leilao excluido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao excluir leilao'
            ], 400); //400 bad request

        }
    }
    public function index_put()
    {
        $id = $this->get('id');
        if ((!$this->put('cod_produto')) || (!$this->put('valor_inicial')) || (!$this->put('status')) || $id <= 0) {
            $this->response([
                'status'    => false,
                'error'     => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }
        $dados = [
            'cod_produto'        => $this->put('cod_produputto'),
            'valor_inicial'      => $this->put('valor_inicial'),
            'status'             => $this->put('status'),
            'data_inicial'       => $this->put('data_inicial'),
            'data_final'         => $this->put('data_final')
        ];

        //carregamos o model
        $this->load->model('leilao_model', 'um');
        //mandamos inserir na base através do metodo insert do leilao__model
        if ($this->um->update($id, $dados)) {
            $this->response([
                'status'    => true,
                'mensage'   => 'leilao alterado com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'leilao não alterado'
            ], 400); //400 bad request

        }
    }
}

/* End of file leilao.php */
