<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Lance extends RestController
{

    public function index_get()
    { // sempre fica nulo nos parenteses
        //o primeiro parametro do load é o nome do model que queremos chamar
        //o segundo paramentro"um" é um 'apelido' o qual pode ser usado depois
        $this->load->model('lance_model', 'um');

        $id = $this->get('id');
        if ($id > 0) {
            $retorno = $this->um->get_one($id);  // get de um lance
        } else {
            $retorno = $this->um->get_all();
        }

        $this->response($retorno, (($retorno) ? 200 : 400));
    }

    public function index_post()
    {
        if ((!$this->post('cod_usuario')) || (!$this->post('cod_leilao') || (!$this->post('time')))) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }


        $dados = [
            'cod_usuario'   => $this->post('cod_usuario'),
            'cod_leilao'    => $this->post('cod_leilao'),
            'time'          => $this->post('time'),
            'ganhador'      => $this->post('ganhador'),
            

        ];

        //carregamos o model
        $this->load->model('lance_model', 'um');
        //mandamos inserir na base através do metodo insert do lance__model
        if ($this->um->insert($dados)) {
            $this->response([
                'status' => true,
                'mensage' => 'lance inserido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao inserir lance'
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
        $this->load->model('lance_model', 'um');
        //mandamos inserir na base através do metodo insert do lance__model
        if ($this->um->delete($id)) {
            $this->response([
                'status'    => true,
                'mensage'   => 'lance excluido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao excluir lance'
            ], 400); //400 bad request

        }
    }
    public function index_put()
    {
        $id = $this->get('id');
        if ((!$this->put('cod_usuario'))  || $id <= 0) {
            $this->response([
                'status'    => false,
                'error'     => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }
        $dados = [
            'cod_usuario'   => $this->put('cod_usuario'),
            'cod_leilao'    => $this->put('cod_leilao'),
            'time'          => $this->put('time'),
            'ganhador'      => $this->put('ganhador'),
        ];

        //carregamos o model
        $this->load->model('lance_model', 'um');
        //mandamos inserir na base através do metodo insert do lance__model
        if ($this->um->update($id, $dados)) {
            $this->response([
                'status'    => true,
                'mensage'   => 'lance alterado com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'lance não alterado'
            ], 400); //400 bad request

        }
    }
}

/* End of file lance.php */
