<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class Listas extends CI_Controller {

		function __construct(){	
			parent::__construct();
                        $this->output->set_header('Cache-Control: post-check=0, pre-check=0');	
			$this->load->model('List_model');
			$this->load->library(array('form_validation','session'));
		}
		public function	ListarTotal(){
			
			$config['base_url']	= base_url('listarTot');
			$query = $this->db->query('SELECT * FROM equiptb');		
			$config['total_rows'] =  $query->num_rows();   
			$config['per_page']	= 20;
			$config['uri_segment'] = 2;
			$config['num_links'] = 5;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = "<nav><ul class='pagination pagination-sm'>";
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
			$urls = $this->List_model->GetAllByPageTot($config['per_page'],$offset);
			$data['urls'] =	$urls;
			$data['numRegistros'] =	$query->num_rows();
			$data['error'] = null;
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v-listarTot',$data);	
			
		}
		public function buscarClient(){
			$this->load->model('Clientes_model'); //carrega model Clientes_model
			$clien = $this->Clientes_model->GetNomeClient(); //recupera dados da tabela clientestb
			$data['data'] = $clien;//envia os dados p/ o form v-incluir (campo nome do cliente)
			$data['isNumber'] = FALSE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Cliente";
			$data['metRout'] = "Listas/ListClienteInterm";
			$data['placeholder'] = "Cliente";
			$data['name'] = "cliente";
			$data['id'] = "cliente";
			$this->load->view('v-buscaListas', $data);
		}
		
		public function	ListClienteInterm(){
			$this->form_validation->set_rules('cliente','Cliente','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
			$client = $this->input->post('cliente');
			$this->load->model('Clientes_model');
			$resp = $this->Clientes_model->GetIdClient($client);
			$this->session->set_userdata('nomeCliente',$resp->nome);
			$this->session->set_userdata('idCliente',$resp->id);
			redirect('listClient');	
			}
		}

		public function	ListCliente(){
			
			$config['base_url']	= base_url('listClient');
			$numReg = $this->List_model->GetClienteNumRegistros($this->session->userdata('idCliente')); // Implementar em Produção
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
			
			$urls = $this->List_model->GetAllByPageClient($this->session->userdata('idCliente'),$config['per_page'],$offset);
			$data['urls'] =	$urls;
			$data['error'] = null;
			$data['pagin'] = TRUE;
			$data['numRegistros'] =	$numReg;                             //Implementar em produção
			$data['tableTitle'] ="Equipamentos ";
			$data['title'] = $this->session->userdata('nomeCliente');
			$data['voidList'] = "Nenhum resultado para este cliente";
			$data['pagination']	= $this->pagination->create_links();			
			$this->load->view('v-listar',$data);
		}
		
		public function buscarClienSolic(){
			$this->load->model('Clientes_model'); //carrega model Clientes_model
			$clien = $this->Clientes_model->GetNomeClient(); //recupera dados da tabela clientestb
			$data['data'] = $clien;//envia os dados p/ o form v-incluir (campo nome do cliente)
			$data['isNumber'] = FALSE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Selecione o Cliente";
			$data['metRout'] = "Listas/buscarSolic";
			$data['placeholder'] = "Cliente";
			$data['name'] = "cliente";
			$data['id'] = "cliente";
			$this->load->view('v-buscaListas', $data);
		}
		public function buscarSolic(){
			$this->form_validation->set_rules('cliente','Cliente','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$client = $this->input->post('cliente');
				$this->load->model('Clientes_model'); //carrega model Clientes_model
				$idClient = $this->Clientes_model->GetIdClient($client);
				$this->load->model('Solicit_model'); //carrega model Solicit_model
				$solicit = $this->Solicit_model->GetSolicByIdClient($idClient->id); //recupera dados da tabela solicitantetb pelo id_cliente
				$data['data'] = $solicit;//envia os dados p/ o form v-incluir (campo nome do solicitante)
				$data['isNumber'] = FALSE; //se for numero de nota fiscal envia informação para v-buscaListas
				$data['stat'] = FALSE;
				$data['listTitle'] = "Solicitante";
				$data['metRout'] = "Listas/ListSolicitanteInterm";
				$data['placeholder'] = "Solicitante";
				$data['name'] = "solicitante";
				$data['id'] = "solicitante";
				$this->load->view('v-buscaListas', $data);
			}
		}
		public function	ListSolicitanteInterm(){
			$this->form_validation->set_rules('solicitante','Solicitante','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$solic = $this->input->post('solicitante');
				$this->load->model('Solicit_model');
				$resp = $this->Solicit_model->GetIdSolicitante($solic);
				$this->session->set_userdata('nomeSolicitante',$resp->nome);
				$this->session->set_userdata('idSolicitante',$resp->id);
				redirect('listSolicit');
			}
		}

		public function	ListSolicitante(){
			
			$config['base_url']	= base_url('listSolicit');
			$numReg = $this->List_model->GetSolicitNumRegistros($this->session->userdata('idSolicitante')); // Implementar em Produção
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
			
			$urls = $this->List_model->GetAllByPageSolicitante($this->session->userdata('idSolicitante'),$config['per_page'],$offset);
			
			$data['urls'] =	$urls;
			$data['error'] = null;
			$data['pagin'] = TRUE;
			$data['numRegistros'] =	$numReg; 								//implementar em produção
			$data['tableTitle'] ="Equipamentos de ";
			$data['title'] = $this->session->userdata('nomeSolicitante');
			$data['voidList'] = "Nenhum resultado para este solicitante";
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v_listarSolicComStatus',$data);
		}
		public function buscarNotaFisc(){
			$data['isNumber'] = TRUE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Nota Fiscal";
			$data['metRout'] = "Listas/ListNotaFiscal";
			$data['placeholder'] = "Nota Fiscal";
			$data['name'] = "nota_fiscal";
			$data['id'] = "nota_fiscal";
			$this->load->view('v-buscaListas', $data);
		}

		public function	ListNotaFiscal(){
			$this->form_validation->set_rules('nota_fiscal','NotaFiscal','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$notFis = $this->input->post();
				$numReg = $this->List_model->GetNotaFiscalNumRegistros($notFis['nota_fiscal']); // Implementar em Produção
				$urls = $this->List_model->GetAllByPageNotaFiscal($notFis['nota_fiscal']);
				$data['urls'] =	$urls;
				$data['error'] = null;
				$data['pagin'] = FALSE;
				$data['numRegistros'] =	$numReg;                                                 //Implementar em produção
				$data['tableTitle'] ="Equipamentos na Nota Fiscal nº";
				$data['title'] = $notFis['nota_fiscal'];	
				$data['voidList'] = "Nenhum resultado para esta Nota Fiscal";
				$this->load->view('v-listar',$data);
			}
		}
		public function buscarNotaFiscDev(){
			$data['isNumber'] = TRUE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "NF Devolução";
			$data['metRout'] = "Listas/ListNotaFiscalDev";
			$data['placeholder'] = "NF Devolução";
			$data['name'] = "notafiscal_retorno";
			$data['id'] = "notafiscal_retorno";
			$this->load->view('v-buscaListas', $data);
		}

		public function	ListNotaFiscalDev(){
			$this->form_validation->set_rules('notafiscal_retorno','NF Devolução','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$notFisDev = $this->input->post();
				$numReg = $this->List_model->GetNotaFiscalDevolNumRegistros($notFisDev['notafiscal_retorno']); // Implementar em Produção
				$urls = $this->List_model->GetAllByPageNotaFiscalDev($notFisDev['notafiscal_retorno']);
				$data['urls'] =	$urls;
				$data['error'] = null;
				$data['pagin'] = FALSE;
				$data['numRegistros'] =	$numReg;                                                 //Implementar em produção
				$data['tableTitle'] ="Equipamentos na NF Devolução nº";
				$data['title'] = $notFisDev['notafiscal_retorno'];	
				$data['voidList'] = "Nenhum resultado para esta Nota Fiscal";
				$this->load->view('v-listar',$data);
			}
		}
		public function buscarNumeroPedido(){
			$data['isNumber'] = TRUE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Número do Pedido";
			$data['metRout'] = "Listas/ListNumPedido";
			$data['placeholder'] = "Número do Pedido";
			$data['name'] = "num_pedido";
			$data['id'] = "num_pedido";
			$this->load->view('v-buscaListas', $data);
		}
		public function	ListNumPedido(){
			$this->form_validation->set_rules('num_pedido','Pedido','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$numPed = $this->input->post();
				$numReg = $this->List_model->GetNumPedidoNumRegistros($numPed['num_pedido']); // Implementar em Produção
				$urls = $this->List_model->GetAllByPageNumPedido($numPed['num_pedido']);
				$data['urls'] =	$urls;
				$data['error'] = null;
				$data['pagin'] = FALSE;
				$data['numRegistros'] =	$numReg;  											//Implementar em produção
				$data['tableTitle'] ="Equipamentos Pedido nº";
				$data['title'] = $numPed['num_pedido'];	
				$data['voidList'] = "Nenhum resultado para esta Pedido";
				$this->load->view('v-listar',$data);
			}
		}
		public function buscarSetor(){
			$data['isNumber'] = TRUE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Setor";
			$data['metRout'] = "Listas/ListSetorInterm";
			$data['placeholder'] = "Setor";
			$data['name'] = "setor_maquina";
			$data['id'] = "setor_maquina";
			$this->load->view('v-buscaListas', $data);
		}

		public function	ListSetorInterm(){
			$this->form_validation->set_rules('setor_maquina','Setor','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$setor = $this->input->post('setor_maquina');
				$this->session->set_userdata('setor',$setor);
				redirect('listSetor');	
			}
		}


		public function	ListSetor(){
			$config['base_url']	= base_url('listSetor');     
			$numReg = $this->List_model->GetSetorNumRegistros($this->session->userdata('setor')); // Implementar em Produção
			
			$config['total_rows'] =	$numReg;
			$config['per_page']	= 4;
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
			$urls = $this->List_model->GetAllByPageSetor($this->session->userdata('setor'),$config['per_page'],$offset);
			$data['urls'] =	$urls;
			$data['error'] = null;
			$data['pagin'] = TRUE; 
			$data['numRegistros'] =	$numReg;  										
			$data['tableTitle'] ="Equipamentos do setor ";
			$data['title'] = $this->session->userdata('setor');	
			$data['voidList'] = "Nenhum resultado para este setor";
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v-listar',$data);
			
		}

		public function buscarNumMaquina(){
			$data['isNumber'] = TRUE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Nº Maquina";
			$data['metRout'] = "Listas/ListNumMaquinaInterm";
			$data['placeholder'] = "Nº Maquina";
			$data['name'] = "num_maquina";
			$data['id'] = "num_maquina";
			$this->load->view('v-buscaListas', $data);
		}

		public function	ListNumMaquinaInterm(){
			$this->form_validation->set_rules('num_maquina','Maquina','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$numMaquina = $this->input->post('num_maquina');
				$this->session->set_userdata('numMaquina',$numMaquina);
				redirect('listNumMaquina');	
			}
		}
		public function	ListNumMaquina(){
			
			$config['base_url']	= base_url('listNumMaquina');     
			$numReg = $this->List_model->GetNumMaquinaNumRegistros($this->session->userdata('numMaquina')); // Implementar em Produção
			
			$config['total_rows'] =	$numReg;
			$config['per_page']	= 5;
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
			$urls = $this->List_model->GetAllByPageNumMaquina($this->session->userdata('numMaquina'),$config['per_page'],$offset);
			$data['urls'] =	$urls;
			$data['error'] = null;
			$data['pagin'] = TRUE;
			$data['numRegistros'] =	$numReg;  										
			$data['tableTitle'] ="Equipamentos da maquina";
			$data['title'] = $this->session->userdata('numMaquina');	
			$data['voidList'] = "Nenhum resultado para esta máquina";
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v-listar',$data);
			
		}

		public function buscarStatus(){
			$data['isNumber'] = FALSE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = TRUE;
			$data['data'] = array('Aguardando Pedido','Sem Concerto', 'Concluido','Orçamento','Aprovado','Não Aprovado');
			$data['listTitle'] = "Status";
			$data['metRout'] = "Listas/ListStatusInterm";
			$data['placeholder'] = "Status";
			$data['name'] = "status";
			$data['id'] = "status";
			$this->load->view('v-buscaListas', $data);
		}
		public function	ListStatusInterm(){
			$this->form_validation->set_rules('status','Status','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$status = $this->input->post('status');
				$this->session->set_userdata('status',$status);
				redirect('listStatus');	
			}
		}
		public function	ListStatus(){
			
			$config['base_url']	= base_url('listStatus');
			$numReg = $this->List_model->GetStatusNumRegistros($this->session->userdata('status')); // Implementar em Produção
			//$query = $this->db->select('*')->from('equiptb')->where('status',$this->session->userdata('status'));
			
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
			
			$urls = $this->List_model->GetAllByPageStatus($this->session->userdata('status'),$config['per_page'],$offset);
			$data['urls'] =	$urls;
			$data['error'] = null;
			$data['pagin'] = TRUE;
			$data['numRegistros'] =	$numReg; 								 //Implementar em produção
			$data['tableTitle'] ="Equipamentos Status:" ;
			$data['title'] = $this->session->userdata('status');
			$data['voidList'] = "Nenhum resultado para este Status";
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v-listar',$data);
		}
		//Visualizar listas só usuarios
		public function	mostrarClienteUser(){
			$sess = $this->session->userdata('nome');
			$this->load->model('Clientes_model');
			$resp = $this->Clientes_model->GetIdClient($sess);
			$this->session->set_userdata('nomeCliente',$resp->nome);
			$this->session->set_userdata('idCliente',$resp->id);
			redirect('listClientUser');
		}
		
		public function buscarSolicitUser(){
			$sess = $this->session->userdata('nome');
			$this->load->model('Solicit_model'); //carrega model Solicit_model
			$solicit = $this->Solicit_model->GetNomeByClient($sess); //recupera a coluna nome da tabela solicitantetb
			$data['data'] = $solicit;//envia os dados p/ o form v-incluir (campo nome do solicitante)
			$data['isNumber'] = FALSE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Solicitante";
			$data['metRout'] = "Listas/ListSolicitanteInterm";
			$data['placeholder'] = "Solicitante";
			$data['name'] = "solicitante";
			$data['id'] = "solicitante";
			$this->load->view('v-buscaListas', $data);
		}
		
		public function buscarNotaFiscUser(){
			$data['isNumber'] = TRUE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Digite a Nota Fiscal";
			$data['metRout'] = "Listas/ListNotaFiscalUser";
			$data['placeholder'] = "Nota Fiscal";
			$data['name'] = "nota_fiscal";
			$data['id'] = "nota_fiscal";
			$this->load->view('v-buscaListas', $data);
		}

		public function	ListNotaFiscalUser(){
			$this->form_validation->set_rules('nota_fiscal','NotaFiscal','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$notFis = $this->input->post();
				$sessCliente = $this->session->userdata('nome');
				$numReg = $this->List_model->GetNotaFiscalNumRegistrosUser($notFis['nota_fiscal'], $sessCliente); // Implementar em Produção
				$urls = $this->List_model->GetNotaFiscalUser($notFis['nota_fiscal'], $sessCliente);
				$data['urls'] =	$urls;
				$data['error'] = null;
				$data['pagin'] = FALSE;
				$data['numRegistros'] =	$numReg;//Implementar em produção (não esquecer de mudar)
				$data['tableTitle'] ="Relação de Equipamentos na Nota Fiscal nº";
				$data['title'] = $notFis['nota_fiscal'];	
				$data['voidList'] = "Nenhum resultado para esta Nota Fiscal";
				$this->load->view('v-listar',$data);
			}
		}
		public function buscarNumeroPedidoUser(){
			$data['isNumber'] = TRUE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Número do Pedido";
			$data['metRout'] = "Listas/ListNumPedidoUser";
			$data['placeholder'] = "Número do Pedido";
			$data['name'] = "num_pedido";
			$data['id'] = "num_pedido";
			$this->load->view('v-buscaListas', $data);
		}
		public function	ListNumPedidoUser(){
			$this->form_validation->set_rules('num_pedido','Pedido','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$numPed = $this->input->post();
				$numReg = $this->List_model->GetNumPedidoNumRegistrosUser($numPed['num_pedido']); // Implementar em Produção
				$urls = $this->List_model->GetAllByPageNumPedido($numPed['num_pedido']);
				$data['urls'] =	$urls;
				$data['error'] = null;
				$data['pagin'] = FALSE;
				$data['numRegistros'] =	$numReg; 											//Implementar em produção 
				$data['tableTitle'] ="Relação de Equipamentos do Pedido nº";
				$data['title'] = $numPed['num_pedido'];	
				$data['voidList'] = "Nenhum resultado para este Pedido";
				$this->load->view('v-listar',$data);
			}
		}
		
		public function buscarSetorUser(){
			$data['isNumber'] = TRUE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Setor";
			$data['metRout'] = "Listas/ListSetorIntermUser";
			$data['placeholder'] = "Setor";
			$data['name'] = "setor_maquina";
			$data['id'] = "setor_maquina";
			$this->load->view('v-buscaListas', $data);
		}

		public function	ListSetorIntermUser(){
			$this->form_validation->set_rules('setor_maquina','Setor','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$setor = $this->input->post('setor_maquina');
				$this->session->set_userdata('setor',$setor);
				redirect('listSetorUser');	
			}
		}


		public function	ListSetorUser(){
			$config['base_url']	= base_url('listSetorUser');     
			$numReg = $this->List_model->GetSetorUserNumRegistros($this->session->userdata('setor'), $this->session->userdata('nome')); // Implementar em Produção
			
			$config['total_rows'] =	$numReg;
			$config['per_page']	= 4;
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
			$urls = $this->List_model->GetAllByPageSetorUser($this->session->userdata('setor'), $this->session->userdata('nome'), $config['per_page'],$offset);
			$data['urls'] =	$urls;  
			$data['error'] = null;
			$data['pagin'] = TRUE; 
			$data['numRegistros'] =	$numReg;  										
			$data['tableTitle'] ="Equipamentos do setor ";
			$data['title'] = $this->session->userdata('setor');	
			$data['voidList'] = "Nenhum resultado para este setor";
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v-listar',$data);
			
		}
                
        public function buscarStatusUser(){
			$data['isNumber'] = FALSE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = TRUE;
			$data['data'] = array('Aguardando Pedido','Sem Concerto','Concluido','Orçamento','Aprovado','Não Aprovado');
			$data['listTitle'] = "Status";
			$data['metRout'] = "Listas/ListStatusIntermUser";
			$data['placeholder'] = "Status";
			$data['name'] = "status";
			$data['id'] = "status";
			$this->load->view('v-buscaListas', $data);
		}
		
		public function	ListStatusIntermUser(){
			$this->form_validation->set_rules('status','Status','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$status = $this->input->post('status');
				$this->session->set_userdata('status',$status);
				redirect('listStatusUser');	
			}
		}
		
		public function buscarNumMaquinaUser(){
			$data['isNumber'] = TRUE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Nº Maquina";
			$data['metRout'] = "Listas/ListNumMaquinaIntermUser";
			$data['placeholder'] = "Nº Maquina";
			$data['name'] = "num_maquina";
			$data['id'] = "num_maquina";
			$this->load->view('v-buscaListas', $data);
		}

		public function	ListNumMaquinaIntermUser(){
			$this->form_validation->set_rules('num_maquina','Maquina','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$numMaquina = $this->input->post('num_maquina');
				$this->session->set_userdata('numMaquina',$numMaquina);
				redirect('listNumMaquinaUser');	
			}
		}
		public function	ListNumMaquinaUser(){
			
			$config['base_url']	= base_url('listNumMaquinaUser');     
			$numReg = $this->List_model->GetNumMaquinaUserNumRegistros($this->session->userdata('numMaquina'), $this->session->userdata('nome')); // Implementar em Produção
			
			$config['total_rows'] =	$numReg;
			$config['per_page']	= 5;
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
			$urls = $this->List_model->GetAllByPageNumMaquinaUser($this->session->userdata('numMaquina'), $this->session->userdata('nome'), $config['per_page'],$offset);
			$data['urls'] =	$urls;
			$data['error'] = null;
			$data['pagin'] = TRUE;
			$data['numRegistros'] =	$numReg;  										
			$data['tableTitle'] ="Equipamentos da maquina";
			$data['title'] = $this->session->userdata('numMaquina');	
			$data['voidList'] = "Nenhum resultado para esta máquina";
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v-listar',$data);
			
		}

		public function	ListStatusUser(){
			
			$config['base_url']	= base_url('listStatusUser');
			$numReg = $this->List_model->GetStatusUserNumRegistros($this->session->userdata('status'), $this->session->userdata('nome')); // Implementar em Produção
			//$array = array('status' =>  $this->session->userdata('status'), 'cliente' => $this->session->userdata('nome'));
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
			
			$urls = $this->List_model->GetAllByPageStatusUser($this->session->userdata('status'),$this->session->userdata('nome'),$config['per_page'],$offset);
			$data['urls'] =	$urls;
			$data['error'] = null;
			$data['pagin'] = TRUE;
			$data['numRegistros'] =	$numReg; 												 //Implementar em produção
			$data['tableTitle'] ="Equipamentos Status:" ;
			$data['title'] = $this->session->userdata('status');
			$data['voidList'] = "Nenhum resultado para este Status";
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v-listar',$data);
		}
		
		//====================================
		public function buscarStatusSolic(){
			$data['isNumber'] = FALSE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = TRUE;
			$data['data'] = array('Aguardando Pedido','Sem Concerto','Concluido','Orçamento','Aprovado','Não Aprovado');
			$data['listTitle'] = "Status";
			$data['metRout'] = "Listas/ListStatusIntermSolic";
			$data['placeholder'] = "Status";
			$data['name'] = "status";
			$data['id'] = "status";
			$data['nomeSolicUrl'] = $_GET['id'];
			$this->load->view('v_buscaListasStatusSolic', $data);
		}
		
		public function	ListStatusIntermSolic(){
			$this->form_validation->set_rules('status','Status','required|trim');
			$this->form_validation->set_rules('nomeSolicUrl','Solicitante','trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$statusSol = $this->input->post('status');
				$this->session->set_userdata('status',$statusSol);
				//$this->session->set_userdata('status',$statusSol);
				redirect('listStatusSolic');
			}
		}
		
		public function	ListStatusSolic(){
			
			$config['base_url']	= base_url('listStatusSolic');
			$numReg = $this->List_model->GetStatusSolicNumRegistros($this->session->userdata('status'),$this->session->userdata('nome'),$this->session->userdata('nomeSolicitante')); // Implementar em Produção
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
			
			$urls = $this->List_model->GetAllByPageStatusSolic($this->session->userdata('status'),$this->session->userdata('nome'),$this->session->userdata('nomeSolicitante'),$config['per_page'],$offset);
			$data['urls'] =	$urls;
			$data['error'] = null;
			$data['pagin'] = TRUE;
			$data['numRegistros'] =	$numReg;  //Implementar em produção
			$data['tableTitle'] ="Equipamentos " ;
			$data['title'] = $this->session->userdata('status');
			$data['voidList'] = "Nenhum resultado para este Status";
			$data['pagination']	= $this->pagination->create_links();
			$this->load->view('v-listar',$data);
			
		}
		
//===================/========================/================
		public function BuscaDadosPorFiltro(){
			
			$data['Title'] = "Filtrar por";
			$data['metRout'] = "Listas/ListDadosPorFiltro";
			$data['btnSubmit'] = "Buscar";	
			$this->load->view('v_BuscarDadosPorFiltro',$data);
		}

		public function	ListDadosPorFiltro(){
			$this->form_validation->set_rules('marca','Marca','trim');
			$this->form_validation->set_rules('potencia','Potencia','trim');
			$this->form_validation->set_rules('num_polos','Polos','trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$dados = $this->input->post();	
				$urls = $this->List_model->GetAllByFilter($dados['marca'], $dados['potencia'], $dados['num_polos']);
				$data['urls'] =	$urls;
				$data['error'] = null;
				$data['pagin'] = FALSE;
				$data['marca'] = $dados['marca'];
				$data['potencia'] = $dados['potencia'];
				$data['polos'] = $dados['num_polos'];
				$data['voidList'] = "Sua pesquisa não retornou nenhum resultado";
				$this->load->view('v_listDadosPorFiltro',$data);
			}
		}
				
	}