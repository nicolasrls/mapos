<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Equipamentos_model extends CI_Model
{

    private $table = 'equipamentos';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Função para buscar todos os equipamentos
    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    // Função para buscar equipamento por ID
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['idEquipamentos' => $id])->row();
    }

    // Função para adicionar um novo equipamento
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Função para atualizar um equipamento existente
    public function update($id, $data)
    {
        return $this->db->where('idEquipamentos', $id)->update($this->table, $data);
    }

    // Função para deletar um equipamento
    public function delete($id)
    {
        return $this->db->delete($this->table, ['idEquipamentos' => $id]);
    }
    public function count_all_results($where = array())
    {
        // Aplicando condições de filtro, se passadas
        if (!empty($where)) {
            $this->db->where($where);
        }

        // Contar todos os resultados da tabela de equipamentos
        $this->db->from('equipamentos');
        return $this->db->count_all_results();
    }
}
