<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class PesqEquipUser extends CI_Controller {

		function __construct(){	
			parent::__construct();	
			$this->load->model('PesqEquipUser_model');
			$this->load->library(array('form_validation','session'));
		}
		public function BuscarOsUser(){
			$data['Title'] = "Digite a OS";
			$data['metRout'] = "PesqEquipUser/ChecarOsUser";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-search', $data);
		}
		public function	ChecarOsUser(){
			$osAt = $this->input->post('os_atual');
			$sess = $this->session->userdata('nome');
			$motor = $this->PesqEquipUser_model->BuscarOsUser($osAt,$sess );
			if($motor){
				$data['title'] = "Visualizar OS atual";
				$data['motor'] = $motor;
				$data['success'] = "BUSCA REALIZADA COM SUCESSO";
				$data['error'] = null;
				$this->load->view('v-checkData',$data);
			}
			else{
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "PesqEquipUser/ChecarOsUser";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$data['error']= "OS NÃO EXISTE";
				$this->load->view('v-search',$data);
			}
		}
		public function BuscarOcUser(){
			$data['Title'] = "Digite a OC";
			$data['metRout'] = "PesqEquipUser/ChecarOcUser";
			$data['placeholder'] = "Número da OC";
			$data['name'] = "ordem_compra";
			$data['id'] = "ordem_compra";
			$this->load->view('v-search', $data);
		}
		public function	ChecarOcUser(){
			$ordComp = $this->input->post('ordem_compra');
			$sess = $this->session->userdata('nome');
			$motor = $this->PesqEquipUser_model->BuscarOcUser($ordComp,$sess );
			if($motor){
				$data['title'] = "Visualizar Ordem de Compra";
				$data['motor'] = $motor;
				$data['success'] = "BUSCA REALIZADA COM SUCESSO";
				$data['error'] = null;
				$this->load->view('v-checkData',$data);
			}
			else{
				$data['Title'] = "Digite a OC";
				$data['metRout'] = "PesqEquipUser/ChecarOsUser";
				$data['placeholder'] = "Número da OC";
				$data['name'] = "ordem_compra";
				$data['id'] = "ordem_compra";
				$data['error']= "OC NÃO EXISTE";
				$this->load->view('v-search',$data);
			}
		}
		public function BuscarNumPedUser (){
			$data['Title'] = "Digite Nº Pedido";
			$data['metRout'] = "PesqEquipUser/ChecarNumPedUser";
			$data['placeholder'] = "Número de Pedido";
			$data['name'] = "num_pedido";
			$data['id'] = "num_pedido";
			$this->load->view('v-search', $data);
		}
		public function	ChecarNumPedUser(){
			$numPed = $this->input->post('num_pedido');
			$sess = $this->session->userdata('nome');
			$motor = $this->PesqEquipUser_model->BuscarNumPedidoUser($numPed,$sess);
			if($motor){
				$data['title'] = "Visualizar Numero de Pedido";
				$data['motor'] = $motor;
				$data['success'] = "BUSCA REALIZADA COM SUCESSO";
				$data['error'] = null;
				$this->load->view('v-checkData',$data);
			}
			else{
				$data['Title'] = "Digite Nº Pedido";
				$data['metRout'] = "PesqEquipUser/ChecarNumPedUser";
				$data['placeholder'] = "Número de Pedido";
				$data['name'] = "num_pedido";
				$data['id'] = "num_pedido";
				$data['error']= "NUMERO DE PEDIDO NÃO EXISTE";
				$this->load->view('v-search',$data);
			}
		}
	}