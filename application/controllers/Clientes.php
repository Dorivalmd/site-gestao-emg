<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class Clientes extends CI_Controller {

		function __construct(){	
			parent::__construct();	
			$this->load->model('Clientes_model');
			$this->load->library(array('form_validation','session'));
		}
		public function incluiClient(){
			$data['Title'] = "Cadastrar Novo Cliente";
			$data['metRout'] = "Clientes/IncluiDataClient";
			$data['btnSubmit'] = "Cadastrar";				
			$this->load->view('v-incluirClient', $data);
		}
		public function	IncluiDataClient() {
			if(!isset($_SESSION["logged"]) || (($_SESSION["permissao"]) == 'N')) {
				redirect('User/Login');
			}
			$this->form_validation->set_rules('nome','Nome','required|min_length[3]|trim');
			$this->form_validation->set_rules('telefone_a','Telefone','trim');
			$this->form_validation->set_rules('telefone_b','Telefone','trim');	
			$this->form_validation->set_rules('rua','Rua','trim');
			$this->form_validation->set_rules('numero','Numero','trim');
			$this->form_validation->set_rules('bairro','Bairro','trim');
			$this->form_validation->set_rules('cidade','Cidade','trim');
			$this->form_validation->set_rules('estado','Estado','trim');
			$this->form_validation->set_rules('complemento','Complemento','trim');
			$this->form_validation->set_rules('cep','CEP','trim');			
			$this->form_validation->set_rules('cpf_cnpj','cpf-cnpj','trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}	
			else{
				$dataReg =	$this->input->post();
				$res = $this->Clientes_model->IncluirCliente($dataReg);
				$clien = $this->Clientes_model->BuscarClient($dataReg['nome']);
				if($res){
					$data['Title'] = "Cadastrar Novo Cliente";
					$data['metRout'] = "Clientes/IncluiClient";
					$data['btnSubmit'] = "Cadastrar Outro";
					$data['clien'] = $clien;
					$data['error'] = null;
					$data['success'] = "Cliente cadastrado com sucesso.";
					$this->load->view('v-checkCliente',$data);
				}
				else{
					$data['Title'] = "Cadastrar Novo Cliente";
					$data['metRout'] = "Clientes/IncluiClient";
					$data['btnSubmit'] = "Repetir";
					$data['error'] = "Não foi possível cadastrar este cliente.";
					$this->load->view('v-incluirClient',$data);
				}
			}
		}
		public function alterCliente(){
			$data['Title'] = "Alterar Cliente";
			$data['metRout'] = "Clientes/alterarCliente";
			$data['placeholder'] = "Nome do Cliente";
			$data['name'] = "nome";
			$data['id'] = "nome";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	alterarCliente(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('nome','Nome','required|min_length[2]|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$nome = $this->input->post('nome');
				$clien = $this->Clientes_model->BuscarClient($nome);
				if($clien){
					$data['Title'] = "Alterar Cliente";
					$data['metRout'] = "Clientes/alterarClien";
					$data['btnSubmit'] = "Alterar";				
					$data['clien'] = $clien;
					$data['success'] = "Faça as alterações necessarias.";
					$data['error'] = null;
					$this->load->view('v-alterarClient',$data);
				}
				else{
					$data['Title'] = "Alterar Cliente";
					$data['metRout'] = "Clientes/alterarCliente";
					$data['placeholder'] = "Nome do Cliente";
					$data['name'] = "nome";
					$data['id'] = "nome";
					$data['error'] = "Cliente não cadastrado.";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		public function	alterarClien() {
			if(!isset($_SESSION["logged"]) || (($_SESSION["permissao"]) == 'N')) {
				redirect('User/Login');
			}
			$this->form_validation->set_rules('nome','Nome','trim');
			$this->form_validation->set_rules('telefone_a','Telefone','trim');
			$this->form_validation->set_rules('telefone_b','Telefone','trim');	
			$this->form_validation->set_rules('rua','Rua','trim');
			$this->form_validation->set_rules('numero','Numero','trim');
			$this->form_validation->set_rules('bairro','Bairro','trim');
			$this->form_validation->set_rules('cidade','Cidade','trim');
			$this->form_validation->set_rules('estado','Estado','trim');
			$this->form_validation->set_rules('complemento','Complemento','trim');
			$this->form_validation->set_rules('cep','CEP','trim');			
			$this->form_validation->set_rules('cpf_cnpj','cpf-cnpj','trim');
			$this->form_validation->set_rules('id','id','trim');

			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}	
			else{
				$dataReg =	$this->input->post();
				$res = $this->Clientes_model->AlterarClient($dataReg);
				$clien = $this->Clientes_model->BuscarClient($dataReg['nome']);
				if($res){
					$data['Title'] = "Alterar Cliente";
					$data['metRout'] = "Clientes/alterCliente";
					$data['btnSubmit'] = "Alterar Outro";
					$data['clien'] = $clien;
					$data['error'] = null;
					$data['success'] = "Dados de cliente alterados com sucesso.";

					$this->load->view('v-checkCliente',$data);
				}
				else{
					$data['Title'] = "Alterar Cliente";
					$data['metRout'] = "Clientes/alterCliente";
					$data['btnSubmit'] = "Repetir";
					$data['error'] = "Não foi possível alterar esses dados.";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		public function	excluiClient(){
			$data['Title'] = "Excluir Cliente";
			$data['metRout'] = "Clientes/BuscarDatClient";
			$data['placeholder'] = "Nome do  cliente";
			$data['name'] = "nome";
			$data['id'] = "nome";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	BuscarDatClient(){
			$this->form_validation->set_rules('nome','Nome','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$client = $this->input->post('nome');
				$clien = $this->Clientes_model->BuscarClient($client);
				if($clien){
					$data['Title'] = "Excluir Cliente";
					$data['metRout'] = "Clientes/DeleteClient";
					$data['btnSubmit'] = "Deletar";
					$data['clien'] = $clien;
					$data['success'] = "Esses dados serão excluidos irreversivelmente!";
					$data['error'] = null;
					$this->load->view('v-checkCliente',$data);
				}
				else{
					$data['Title'] = "Excluir Cliente";
					$data['metRout'] = "Clientes/BuscarDatClient";
					$data['placeholder'] = "Nome do cliente";
					$data['name'] = "nome";
					$data['id'] = "nome";
					$data['error']= "Cliente não cadastrado";
					$this->load->view('v-searchRestrict',$data);
				}
			}	
		}
		public function	DeleteClient(){
			$data['success'] = null;
			$data['error'] = null;
			$dataReg = $this->input->post('client-del');
			$results = $this->Clientes_model->deletarClient($dataReg);
			if($results){
				$data['Title'] = "Excluir Cliente";
				$data['metRout'] = "Clientes/BuscarDatClient";
				$data['placeholder'] = "Nome do cliente";
				$data['name'] = "nome";
				$data['id'] = "nome";
				$data['success'] = "Exclusão realizada com sucesso!";	
				$data['error'] = null;
				$this->load->view('v-searchRestrict',$data);
			}
			else{
				$data['Title'] = "Excluir Cliente";
				$data['metRout'] = "Clientes/BuscarDatClient";
				$data['placeholder'] = "Nome do Cliente";
				$data['name'] = "nome";
				$data['id'] = "nome";
				$data['error'] = "Não foi possível excluir os dados.";
				$data['success'] = null;
				$this->load->view('v-searchRestrict', $data);
			}
		}
		public function	ListClient(){
			$numReg = $this->Clientes_model->GetClienttNumRegistros(); // Implementar em produção
			$ListClien = $this->Clientes_model->GetAllClient();
			$data['client'] = $ListClien;
			$data['error'] = null;
			$data['numRegistros'] =	$numReg;			// Implementar em produção
			$data['Title'] ="Relação de clientes cadastrados ";
			$data['voidList'] = "Nenhum cliente cadastrado";	
			$this->load->view('v-listClient',$data);
		}
	}