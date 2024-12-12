<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Marcas extends MY_Controller{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->model('marcas_model');

    }

    public function autoCompleteMarcas()
    {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->marcas_model->autoCompleteMarcas($q);
        }
    }


}


?>