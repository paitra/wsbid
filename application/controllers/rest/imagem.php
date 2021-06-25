<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Imagem extends RestController
{

    public function index_get()
    { // sempre fica nulo nos parenteses
        //o primeiro parametro do load é o nome do model que queremos chamar
        //o segundo paramentro"um" é um 'apelido' o qual pode ser usado depois
        $this->load->model('imagem_model', 'um');

        $id = $this->get('id');
        if ($id > 0) {
            $retorno = $this->um->get_one($id);  // get de um imagem
        } else {
            $retorno = $this->um->get_all();
        }

        $this->response($retorno, (($retorno) ? 200 : 400));
    }

    public function index_post()
    {
        if ((!$this->post('produto_id'))) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }


        $dados = [
            'produto_id'        => $this->post('produto_id'),
            'capa'              => $this->post('capa'),
            'arquivo'           => $this->post('arquivo'),


        ];

        //carregamos o model
        $this->load->model('imagem_model', 'um');
        //mandamos inserir na base através do metodo insert do imagem__model
        if ($this->um->insert($dados)) {
            $this->response([
                'status' => true,
                'mensage' => 'imagem inserido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao inserir imagem'
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
        $this->load->model('imagem_model', 'um');
        //mandamos inserir na base através do metodo insert do imagem__model
        if ($this->um->delete($id)) {
            $this->response([
                'status'    => true,
                'mensage'   => 'imagem excluido com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao excluir imagem'
            ], 400); //400 bad request

        }
    }
    public function index_put()
    {
        $id = $this->get('id');
        if ((!$this->put('produto_id'))  || $id <= 0) {
            $this->response([
                'status'    => false,
                'error'     => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }
        $dados = [
            'produto_id'        => $this->put('produto_id'),
            'capa'              => $this->put('capa'),
            'arquivo'           => $this->put('arquivo'),
        ];

        //carregamos o model
        $this->load->model('imagem_model', 'um');
        //mandamos inserir na base através do metodo insert do imagem__model
        if ($this->um->update($id, $dados)) {
            $this->response([
                'status'    => true,
                'mensage'   => 'imagem alterado com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'imagem não alterado'
            ], 400); //400 bad request

        }
    }
}

/* End of file imagem.php */
