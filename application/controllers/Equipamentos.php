<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Equipamentos extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->model('equipamentos_model');
        $this->data['menuEquipamentos'] = 'Equipamentos';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar equipamentos.');
            redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('equipamentos/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->equipamentos_model->count_all_results();

        if ($pesquisa) {
            $this->data['configuration']['suffix'] = "?pesquisa={$pesquisa}";
            $this->data['configuration']['first_url'] = base_url("index.php/equipamentos") . "?pesquisa={$pesquisa}";
        }

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->equipamentos_model->get_all();

        $this->data['view'] = 'equipamentos/equipamentos';
        return $this->layout();
    }

    public function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar equipamentos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('equipamentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
            
        } else {
            log_message('info', 'Método adicionarEquipamento foi chamado');
            $data = [
                'idClientes' => set_value('idClientes'),
                'modelo' => set_value('modelo'),
                'marca' => set_value('marca'),
                'numero_serie' => set_value('numero_serie'),
                'boolAcessorio' => set_value('boolAcessorio'),
                'acessorioRecebido' => set_value('acessorioRecebido'),
                'data_registro' => date('Y-m-d H:i:s'),
                'tipo' => set_value('tipo'),
            ];
            if ($this->equipamentos_model->insert($data)) {
                $this->session->set_flashdata('success', 'Equipamento adicionado com sucesso!');
                log_info('Adicionou um equipamento');
                redirect(site_url('equipamentos/adicionar/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro ao adicionar o equipamento.</p></div>';
            }
        }

        $this->data['view'] = 'equipamentos/adicionarEquipamentos';
        return $this->layout();
    }

    public function editar()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('equipamentos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar equipamentos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('equipamentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'modelo' => set_value('modelo'),
                'marca' => set_value('marca'),
                'numero_serie' => set_value('numero_serie'),
                'boolAcessorio' => set_value('boolAcessorio'),
                'acessorioRecebido' => set_value('acessorioRecebido'),
                'tipo' => set_value('tipo'),
            ];

            if ($this->equipamentos_model->update($this->uri->segment(3), $data)) {
                $this->session->set_flashdata('success', 'Equipamento editado com sucesso!');
                log_info('Alterou um equipamento. ID: ' . $this->uri->segment(3));
                redirect(site_url('equipamentos/editar/') . $this->uri->segment(3));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro ao editar o equipamento.</p></div>';
            }
        }

        $this->data['result'] = $this->equipamentos_model->get_by_id($this->uri->segment(3));
        $this->data['view'] = 'equipamentos/editarEquipamento';
        return $this->layout();
    }

    public function excluir()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir equipamentos.');
            redirect(base_url());
        }

        $id = $this->input->post('id');

        if (!$id) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir o equipamento.');
            redirect(site_url('equipamentos/gerenciar/'));
        }

        if ($this->equipamentos_model->delete($id)) {
            log_info('Removeu um equipamento. ID: ' . $id);
            $this->session->set_flashdata('success', 'Equipamento excluído com sucesso!');
        } else {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir o equipamento.');
        }

        redirect(site_url('equipamentos/gerenciar/'));
    }
}
