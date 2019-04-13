<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class NumPedido extends CI_Controller {

		function __construct(){	
			parent::__construct();	
			$this->load->model('NumPed_model');
			$this->load->library(array('form_validation','session'));
		}
		public function BuscarNumPed(){
			$data['Title'] = "Digite Nº do Pedido ";
			$data['metRout'] = "NumPedido/ChecarNumPed";
			$data['placeholder'] = "Número do pedido";
			$data['name'] = "num_pedido";
			$data['id'] = "num_pedido";
			$this->load->view('v-search', $data);
		}
		public function	ChecarNumPed(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('num_pedido','Numero do pedido','required|min_length[2]|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$NumPed = $this->input->post('num_pedido');
				$motor = $this->NumPed_model->BuscNumPed($NumPed);
				if($motor){
					$data['title'] = "Visualizar Nº Pedido";
					$data['motor'] = $motor;
					$data['success'] = "BUSCA RELIZADA COM SUCESSO";
					$data['error'] = null;
					$this->load->view('v-checkData',$data);
				}
				else{
					$data['Title'] = "Digite Nº do Pedido ";
					$data['metRout'] = "NumPedido/ChecarNumPed";
					$data['placeholder'] = "Número do Pedido";
					$data['name'] = "num_pedido";
					$data['id'] = "num_pedido";
					$data['error']= "NÚMERO DE PEDIDO NÃO EXISTE";
					$this->load->view('v-search',$data);
				}
			}
		}		
	}
?>