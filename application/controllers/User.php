<?php 
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class User extends CI_Controller{
		function __construct(){	
			parent::__construct();
			$this->output->delete_cache("Orcamentos/incluirDadosOrcam");//?????????
			$this->output->delete_cache("Orcamentos/ChecarDadosOrcam");//?????????
			$this->output->delete_cache("Orcamentos/VoltarChecarDadosOrcam");//?????????
			$this->output->delete_cache("Orcamentos/IncluirItemPedido");//?????????
			$this->output->delete_cache("Orcamentos/GravarItensPed");//?????????
			$this->output->delete_cache("Orcamentos/incluirDadosOrcamCheckData");//?????????
			$this->output->delete_cache("Orcamentos/ChecarDadosOrcCheckData");//?????????
			$this->output->delete_cache("Orcamentos/ChecarDadosOrcMenu");//?????????
			$this->output->delete_cache("Orcamentos/BuscarOrcamAlter");//?????????
			$this->output->delete_cache("Orcamentos/VoltarAlterDadosOrcam");//?????????
			$this->output->delete_cache("Orcamentos/ChecarOrcamAlter");//?????????
			$this->output->delete_cache("Orcamentos/AlterarDadosOrcam");//?????????
			$this->output->delete_cache("Orcamentos/ChecarOrcamDel");//?????????
			$this->output->delete_cache("Orcamentos/ExcluirDadosOrcam");//?????????
			$this->output->delete_cache("Orcamentos/FinalizarPedido");//?????????
			$this->output->delete_cache("Orcamentos/ExecutarDesconto");//?????????
			$this->output->delete_cache("Orcamentos/concluir_pedido");//?????????
			$this->output->delete_cache("Orcamentos/ChecarPedidoConcluido");//?????????
			$this->output->delete_cache("Orcamentos/EditarItemOrcam");//?????????
			$this->output->delete_cache("Orcamentos/AlterarItemOrcam");//?????????
			$this->output->delete_cache("Orcamentos/ExcluirItemOrcam");//?????????		
			$this->load->model('User_model');
			$this->load->library(array('form_validation','session'));
		}
		/*public function loadHome(){
			$this->load->view('v_home');
		}*/
		
		public function loadHome(){
			redirect('home');	
		}
		public function carregarPaginaPrincipal(){
			$this->load->view('v_home');
		}
		
		public function carregarPaginaBemvindo(){
			$this->load->view('v_bemvindo');
		}
		
		public function	Login() {	
			$this->form_validation->set_rules('name','Nome','required|min_length[2]|trim');
			$this->form_validation->set_rules('passw','Senha','required|min_length[6]|trim');	
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();	
			}
			else{
				$dataLogin = $this->input->post();
				$res = $this->User_model->Login($dataLogin);
				if($res){
					foreach($res as	$result){
						if (password_verify($dataLogin['passw'], $result->passw)){	
							$data['error'] = null;	
							$this->session->set_userdata('logged',true);
							$this->session->set_userdata('nome',$result->name);
							$this->session->set_userdata('id',$result->id);
							$this->session->set_userdata('permissao',$result->permissao);
							redirect('bemvindo');	
						}
						else{
							$data['error'] = "Senha incorreta.";
						}	
					}
				}
				else{
					$data['error'] = "Usuário não cadastrado.";
				}	
			}
			$this->load->view('v-login',$data);
		}
			
		public function	Logout() {	
			$this->session->unset_userdata('logged');
			$this->session->unset_userdata('nome');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('id');
			$this->session->unset_userdata('permissao');
			$this->session->unset_userdata('nomeCliente');
			$this->session->unset_userdata('idCliente');
			$this->session->unset_userdata('nomeSolicitante');
			$this->session->unset_userdata('idSolicitante');
			$this->session->unset_userdata('status');
			redirect(); 
		}
		public function	ShowCad(){ //Mostra tela de cadastro
			$this->load->view('v-cadastrar');
		}
		public function	Register() { //Registra novo usuario
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('name','Nome','required|min_length[2]|trim');
			$this->form_validation->set_rules('email','Email','valid_email|trim');
			$this->form_validation->set_rules('passw','Senha','required|min_length[6]|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$dataRegister =	$this->input->post();
				$res = $this->User_model->Save($dataRegister);
				if($res){
					$data['error'] = null;
					$data['success'] = "Usuário cadastrado com sucesso.";
				}
				else{			
					$data['error'] = "Não foi possível cadastrar o usuário.";
					$data['success'] = null;
				}
			}
			$this->load->view('v-cadastrar', $data);
		}
		public function UpdatePassw() {	//Altera senha de usuario
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('name','Nome','required|min_length[3]|trim');
			$this->form_validation->set_rules('passw','Senha','required|min_length[6]|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$data = $this->input->post();	
				$this->User_model->Update($data);
				$data['success'] = "Senha alterada com sucesso!";	
				$data['error'] = null;
			}	
			$data['user'] = $this->User_model->GetUser($this->session->userdata('id'));	
			$this->load->view('v-alterar-senha',$data); 
		}
		public function	ListUser(){
			$ListUser = $this->User_model->GetAllUser();
			$data['users'] = $ListUser;
			$data['error'] = null;
			$data['Title'] ="Relação de usuários cadastrados ";
			$data['voidList'] = "Nenhum usuário cadastrado";	
			$this->load->view('v-listUser',$data);
		}
	}