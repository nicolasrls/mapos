<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Carregar a biblioteca de banco de dados
        $this->load->database();
    }

    // Função para obter todas as marcas
    public function get_all_marcas()
    {
        $query = $this->db->get('Marcas');
        return $query->result();
    }

    // Função para inserir uma nova marca
    public function insert_marca($data)
    {
        $this->db->insert('Marcas', $data);
        return $this->db->insert_id();
    }

    // Função para buscar uma marca pelo id
    public function get_marca_by_id($id)
    {
        $query = $this->db->get_where('Marcas', array('id' => $id));
        return $query->row();
    }

    // Função para atualizar uma marca
    public function update_marca($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('Marcas', $data);
    }

    // Função para excluir uma marca
    public function delete_marca($id)
    {
        $this->db->delete('Marcas', array('id' => $id));
    }

    public function autoCompleteMarcas($q)
    {
        $this->db->select('*');
        $this->db->limit(25);
        $this->db->like('nome', $q); // Aqui você vai procurar pela coluna 'nome' da tabela 'marcas'
        $query = $this->db->get('marcas');
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set[] = [
                    'label' => $row['nome'], // Nome da marca para exibição no autocomplete
                ];
            }
            echo json_encode($row_set); // Retorna os resultados em formato JSON
        }
    }
    
}
