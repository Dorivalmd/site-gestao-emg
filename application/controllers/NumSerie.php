<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class NumSerie extends CI_Controller {

		function __construct(){	
			parent::__construct();	
			$this->load->model('NumSer_model');
			$this->load->library(array('form_validation','session'));
		}
		public function BuscarNumSerie(){
			$data['Title'] = "Digite o Nº de Série";
			$data['metRout'] = "NumSerie/ChecarNumSerie";
			$data['placeholder'] = "Número de Série";
			$data['name'] = "num_serie";
			$data['id'] = "num_serie";
			$this->load->view('v-search', $data);
		}
		public function	ChecarNumSerie(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('num_serie','Numero de serie ','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$numSerie = $this->input->post();
				$motor = $this->NumSer_model->BuscNumSerie($numSerie['num_serie']);
				if($motor){
					$data['title'] = "Visualizar Número de Série";
					$data['motor'] = $motor;
					$data['success'] = "BUSCA REALIZADA COM SUCESSO";
					$data['error'] = null;
					$this->load->view('v-checkData',$data);
				}
				else{
					$data['Title'] = "Digite o Nº de Série";
					$data['metRout'] = "NumSerie/ChecarNumSerie";
					$data['placeholder'] = "Número de Série";
					$data['name'] = "num_serie";
					$data['id'] = "num_serie";
					$data['error']= "NÚMERO DE SÉRIE NÃO EXISTE";
					$this->load->view('v-search',$data);
				}
			}
		}
	}
?>