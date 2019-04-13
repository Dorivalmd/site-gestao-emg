<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class OrdemCompra extends CI_Controller {

		function __construct(){	
			parent::__construct();	
			$this->load->model('OrdemComp_model');
			$this->load->library(array('form_validation','session'));
		}
		public function BuscarOc(){
			$data['Title'] = "Digite a OC";
			$data['metRout'] = "OrdemCompra/checarOc";
			$data['placeholder'] = "Número da OC";
			$data['name'] = "ordem_compra";
			$data['id'] = "ordem_compra";
			$this->load->view('v-search', $data);
		}
		public function	ChecarOc(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('ordem_compra','Numero da OC','required|min_length[2]|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$oc = $this->input->post('ordem_compra');
				$motor = $this->OrdemComp_model->BuscOc($oc);
				if($motor){
					$data['title'] = "Visualizar Ordem de Compra";
					$data['motor'] = $motor;
					$data['success'] = "BUSCA REALIZADA COM SUCESSO";
					$data['error'] = null;
					$this->load->view('v-checkData',$data);
				}
				else{
					$data['Title'] = "Digite a OC";
					$data['metRout'] = "OrdemCompra/checarOc";
					$data['placeholder'] = "Número da OC";
					$data['name'] = "ordem_compra";
					$data['id'] = "ordem_compra";
					$data['error']= "NÚMERO DE OC NÃO EXISTE ";
					$this->load->view('v-search',$data);
				}
			}
		}
	}
?>