<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class Solicit extends CI_Controller {

		function __construct(){	
			parent::__construct();	
			$this->load->model('Solicit_model');
			$this->load->library(array('form_validation','session'));
		}
		public function	showIncluiSolic(){ //Mostra tela de cadastro de solicitante
			$this->load->model('Clientes_model'); //carrega model Clientes_model
			$clien = $this->Clientes_model->GetNomeClient(); //recupera dados da tabela clientestb
			$data['clien'] = $clien;//envia os dados p/ o form v-incluirSolic (campo nome da empresa)
			$data['Title'] = "Cadastrar Solicitante";
			$data['metRout'] = "Solicit/incluirSolic";
			$data['btnSubmit'] = "Cadastrar";
			$this->load->view('v-incluirSolic',$data);
		}
		public function	showIncluiSolicPorCheckCliente(){ //Mostra tela de cadastro de solicitante
			//$this->load->model('Clientes_model'); //carrega model Clientes_model
			//$clien = $this->Clientes_model->GetNomeClient(); //recupera dados da tabela clientestb
			$nomeClient = $_GET['id'];
			$data['clien'] = $nomeClient;//envia os dados p/ o form v-incluirSolic (campo nome da empresa)			
			$data['Title'] = "Cadastrar Solicitante";
			$data['metRout'] = "Solicit/incluirSolic";
			$data['btnSubmit'] = "Cadastrar";
			$this->load->view('v_incluirSolicPorCheckCliente',$data);
		}
		
		public function	IncluirSolic() { //Registra novo solicitante
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('nome','Nome','required|min_length[2]|trim');
			$this->form_validation->set_rules('email','Email','trim');
			$this->form_validation->set_rules('empresa','Empresa','trim');
			$this->form_validation->set_rules('setor','Setor','trim');
			$this->form_validation->set_rules('tel_empresa','Tel_empresa','trim');
			$this->form_validation->set_rules('ramal','Ramal','trim');
			$this->form_validation->set_rules('cel_empresa','Cel_empresa','trim');
			$this->form_validation->set_rules('cel_pessoal','Cel_pessoal','trim');
			$this->form_validation->set_rules('id_cliente','Cliente ID','trim');

			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$dataSolic = $this->input->post();
				$clien = $this->Solicit_model->GetIdClient($dataSolic ['empresa']);
				$dataSolic ['id_cliente']= $clien->id;
				$res = $this->Solicit_model->IncluirSolicit($dataSolic );
				$solic = $this->Solicit_model->BuscarSolicit($dataSolic['nome']);
				if($res){
					$data['Title'] = "Cadastrar Solicitante";
					$data['metRout'] = "Solicit/showIncluiSolic";
					$data['solic'] = $solic;
					$data['btnSubmit'] = "Cadastrar Outro";
					$data['error'] = null;
					$data['success'] = "Solicitante cadastrado com sucesso.";
					$this->load->view('v-checkSolic',$data);
				}
				else{
					$data['Title'] = "Cadastrar Solicitante";
					$data['metRout'] = "Solicit/incluirSolic";
					$data['btnSubmit'] = "Cadastrar";
					$data['error'] = "Não foi possível cadastrar o solicitante.";
					$data['success'] = null;
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		
		/*
		public function	IncluirSolic() { //Registra novo solicitante
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('nome','Nome','required|min_length[2]|trim');
			$this->form_validation->set_rules('email','Email','trim');
			$this->form_validation->set_rules('empresa','Empresa','trim');
			$this->form_validation->set_rules('setor','Setor','trim');
			$this->form_validation->set_rules('tel_empresa','Tel_empresa','trim');
			$this->form_validation->set_rules('ramal','Ramal','trim');
			$this->form_validation->set_rules('cel_empresa','Cel_empresa','trim');
			$this->form_validation->set_rules('cel_pessoal','Cel_pessoal','trim');
			$this->form_validation->set_rules('id_cliente','Cliente ID','trim');

			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$solic = $this->input->post();
				$clien = $this->Solicit_model->GetIdClient($solic['empresa']);
				$solic['id_cliente']= $clien->id;
				$res = $this->Solicit_model->IncluirSolicit($solic);
				if($res){
					$data['Title'] = "Cadastrar Solicitante";
					$data['metRout'] = "Solicit/incluirSolic";
					$data['btnSubmit'] = "Cadastrar";
					$data['error'] = null;
					$data['success'] = "Solicitante cadastrado com sucesso.";
				}
				else{
					$data['Title'] = "Cadastrar Solicitante";
					$data['metRout'] = "Solicit/incluirSolic";
					$data['btnSubmit'] = "Cadastrar";
					$data['error'] = "Não foi possível cadastrar o solicitante.";
					$data['success'] = null;
				}
			}
			$this->load->view('v-incluirSolic', $data);
		}
		*/
		public function alterSolicit(){
			$data['Title'] = "Alterar Solicitante";
			$data['metRout'] = "Solicit/alterarSolicit";
			$data['placeholder'] = "Nome do Solicitante";
			$data['name'] = "nome";
			$data['id'] = "nome";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	alterarSolicit(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('nome','Nome','required|min_length[2]|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$nome = $this->input->post('nome');
				$solic = $this->Solicit_model->BuscarSolicit($nome);
				if($solic){
					$data['Title'] = "Alterar Dados de Solicitante";
					$data['metRout'] = "Solicit/alterarSolicitante";
					$data['btnSubmit'] = "Alterar";				
					$data['solic'] = $solic;
					$data['success'] = "Faça as alterações necessarias.";
					$data['error'] = null;
					$this->load->view('v-alterarSolicit',$data);
				}
				else{
					$data['Title'] = "Alterar Solicitante";
					$data['metRout'] = "Solicit/alterarSolicit";
					$data['placeholder'] = "Nome do Solicitante";
					$data['name'] = "nome";
					$data['id'] = "nome";
					$data['error'] = "Solicitante não cadastrado.";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		public function	alterarSolicitante() {
			if(!isset($_SESSION["logged"]) || (($_SESSION["permissao"]) == 'N')) {
				redirect('User/Login');
			}
			$this->form_validation->set_rules('nome','Nome','required|min_length[3]|trim');
			$this->form_validation->set_rules('empresa','Empresa','trim');
			$this->form_validation->set_rules('tel_empresa','tel_empresa','trim');	
			$this->form_validation->set_rules('ramal','ramal','trim');
			$this->form_validation->set_rules('email','Email','trim');
			$this->form_validation->set_rules('setor','Setor','trim');
			$this->form_validation->set_rules('cel_empresa','cel-empresa','trim');
			$this->form_validation->set_rules('cel_pessoal','cel_pessoal','trim');
			$this->form_validation->set_rules('id','id','trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}	
			else{
				$dataReg =	$this->input->post();
				$res = $this->Solicit_model->AlterarSolicit($dataReg);
				$solic = $this->Solicit_model->BuscarSolicit($dataReg['nome']);
				if($res){
					$data['Title'] = "Alterar Dados de Solicitante";
					$data['metRout'] = "Solicit/alterSolicit";
					$data['btnSubmit'] = "Alterar Outro";
					$data['solic'] = $solic;
					$data['error'] = null;
					$data['success'] = "Dados alterado com sucesso.";

					$this->load->view('v-checkSolic',$data);
				}
				else{
					$data['Title'] = "Alterar Dados de Cliente";
					$data['metRout'] = "Solicit/alterCliente";
					$data['btnSubmit'] = "Repetir";
					$data['error'] = "Alteração não completada.";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		public function	excluiSolic(){
			$data['Title'] = "Excluir Solicitante";
			$data['metRout'] = "Solicit/BuscarDatSolicit";
			$data['placeholder'] = "Nome do  Solicitante";
			$data['name'] = "nome";
			$data['id'] = "nome";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	BuscarDatSolicit(){
			$this->form_validation->set_rules('nome','Nome','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$solicit = $this->input->post('nome');
				$solic = $this->Solicit_model->BuscarSolicit($solicit);
				if($solic){
					$data['Title'] = "Excluir Solicitante";
					$data['metRout'] = "Solicit/DeleteSolicit";
					$data['btnSubmit'] = "Deletar";
					$data['solic'] = $solic;
					$data['success'] = "Esses dados serão excluidos irreversivelmente!";
					$data['error'] = null;
					$this->load->view('v-checkSolic',$data);
				}
				else{
					$data['Title'] = "Excluir Solicitante";
					$data['metRout'] = "Solicit/BuscarDatSolicit";
					$data['placeholder'] = "Nome do Solicitante";
					$data['name'] = "nome";
					$data['id'] = "nome";
					$data['error']= "Cliente não cadastrado";
					$this->load->view('v-searchRestrict',$data);
				}
			}	
		}
		public function	DeleteSolicit(){
			$data['success'] = null;
			$data['error'] = null;
			$dataReg = $this->input->post('solic-del');
			$results = $this->Solicit_model->deletarSolicit($dataReg);
			if($results){
				$data['Title'] = "Excluir Solicitante";
				$data['metRout'] = "Solicit/BuscarDatSolicit";
				$data['placeholder'] = "Nome do solicitante";
				$data['name'] = "nome";
				$data['id'] = "nome";
				$data['success'] = "Exclusão realizada com sucesso!";	
				$data['error'] = null;
				$this->load->view('v-searchRestrict',$data);
			}
			else{
				$data['Title'] = "Excluir Solicitante";
				$data['metRout'] = "Solicit/BuscarDatSolicit";
				$data['placeholder'] = "Nome do solicitante";
				$data['name'] = "nome";
				$data['id'] = "nome";
				$data['error'] = "Não foi possível excluir os dados.";
				$data['success'] = null;
				$this->load->view('v-searchRestrict', $data);
			}
		}
		/*public function	ListSolicit(){
			$ListSolic = $this->Solicit_model->GetAllSolicit();
			$data['solicit'] = $ListSolic;
			$data['error'] = null;
			$data['Title'] ="Relação de solicitantes cadastrados ";
			$data['voidList'] = "Nenhum solicitante cadastrado";	
			$this->load->view('v-listSolic',$data);
		}*/
		public function	ListSolicit(){
			$config['base_url']	= base_url('showListSolic');
			$numReg = $this->Solicit_model->GetSolicitNumRegistros();			 // Implementar em Produção
			$config['total_rows'] =	$numReg;
			$config['per_page']	= 20;
			$config['uri_segment'] = 2;
			$config['num_links'] = 5;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = "<nav><ul class='pagination pagination-sm '>";
			$config['full_tag_close'] =	"<ul></nav>";	
			$config['first_link'] =	"Primeira";		
			$config['first_tag_open'] = "<li>";
			$config['first_tag_close'] = "</li>";
			$config['last_link'] = "Última";
			$config['last_tag_open'] = "<li>";
			$config['last_tag_close'] = "</li>";
			$config['next_link'] = "Próxima";
			$config['next_tag_open'] = "<li>";
			$config['next_tag_close'] =	"</li>";
			$config['prev_link'] = "Anterior";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tag_close'] = "</li>";
			$config['cur_tag_open']	= "<li class='active'><a href='#'>";
			$config['cur_tag_close'] = "</a></li>";
			$config['num_tag_open']	= "<li>";
			$config['num_tag_close'] = "</li>";
			
			$this->pagination->initialize($config);
			if($this->uri->segment(2))
				$offset	= ($this->uri->segment(2) - 1) * $config['per_page'];	
			else
				$offset	= 0;
						
			$ListSolic = $this->Solicit_model->GetAllSolicit($config['per_page'],$offset);
			$data['solicit'] = $ListSolic;
			$data['error'] = null;
			$data['numRegistros'] =	$numReg;
			$data['Title'] ="Relação de solicitantes cadastrados ";
			$data['voidList'] = "Nenhum solicitante cadastrado";
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v-listSolic',$data);
		}
	}