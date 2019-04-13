<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class Orcamentos extends CI_Controller {

		function __construct(){	
			parent::__construct();	
			$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
			$this->load->model(array('OrdServ_model','Orcam_model','Solicit_model'));
			$this->load->library(array('form_validation','session'));
		}
		
		
		public function BuscarOrcamIncluir(){
			$data['Title'] = "Incluir Orçam.";
			$data['metRout'] = "Orcamentos/incluirDadosOrcam";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-searchRestrict', $data);
		}

		public function	incluirDadosOrcam(){
			$this->form_validation->set_rules('os_atual','OS','required|trim|callback_os_atual_check');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "Orcamentos/incluirDadosOrcam";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
			}
			else{
				$os = $this->input->post('os_atual');
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor){
					$this->load->model('Clientes_model'); //carrega model Clientes_model
					$this->load->model('Solicit_model'); //carrega model Solicit_model
					$clien = $this->Clientes_model->GetNomeClient(); //recupera dados da tabela clientestb
					//$solicit = $this->Solicit_model->GetNomeSolicit(); //recupera dados da tabela solicitantetb
					
					$idClient = $this->Solicit_model->GetIdClient($motor->cliente);
					$solicit = $this->Solicit_model->GetSolicByIdClient($idClient->id); //recupera dados da tabela solicitantetb
					$emailSolic = $this->Solicit_model->GetEmailSolic($motor->solicitante);

					$data['clien'] = $clien;//envia os dados p/ o form v-checkDataRestrict (campo nome do cliente)
					$data['solicit'] = $solicit;//envia os dados p/ o form v-checkDataRestrict (campo nome do solicitante)
					$data['Title'] = "Orçamentos";
					$data['metRout'] = "Orcamentos/ChecarDadosOrcam";
					$data['btnSubmit'] = "Iniciar";				
					$data['motor'] = $motor;
					$data['solic'] = $emailSolic;
					$data['error'] = null;
					$this->load->view('v_incluirDadosOrcam',$data);
				}
				else{
					$data['Title'] = "Orçamentos";
					$data['metRout'] = "Orcamentos/incluirDadosOrcam";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "Essa Os não existe.";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		function os_atual_check($os){
			$osExist = $this->Orcam_model->GetOsExist($os);
			if ($osExist){
				if ($os == $osExist){
					$this->form_validation->set_message('os_atual_check', 'ESSE ORÇAMENTO JÁ EXISTE');
					return FALSE;
				}else{
					return TRUE;
				}
			}else{
				return TRUE;
			}
		}
		public function	ChecarDadosOrcam() {
			$this->form_validation->set_rules('os_atual','OS atual','required|trim|callback_os_atual_check');
			$this->form_validation->set_rules('data_orcam','Data Orçamento','required|trim');
			$this->form_validation->set_rules('contato','Contato','trim');
			$this->form_validation->set_rules('email','Email Contato','trim');
			$this->form_validation->set_rules('forma_pgto','Forma de Pgto','trim');
			$this->form_validation->set_rules('prazo_pgto','Prazo de Pgto','trim');
			$this->form_validation->set_rules('prazo_entrega','Prazo de Entrega','trim');
			$this->form_validation->set_rules('valid_proposta','Validade','trim');			
			$this->form_validation->set_rules('garantia',' Garantia','trim');
			$this->form_validation->set_rules('impostos',' Impostos','trim');
			$this->form_validation->set_rules('status_orc',' Status do Orçam','trim');
			$this->form_validation->set_rules('causa_falha_orc','Causa da falha no orçam.','trim');
			$this->form_validation->set_rules('descr_falha_orc',' Descrição da falha no orçam.','trim');
			$this->form_validation->set_rules('id_equip','Id equip','trim');
			$this->form_validation->set_rules('obs_orcam','Id equip','trim');
			$this->form_validation->set_rules('formato_pagina','Formato pagina','trim');
			
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
				$data['Title'] = "Incluir Orçam.";
				$data['metRout'] = "Orcamentos/incluirDadosOrcam";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
			}
			else{
				$dataReg = $this->input->post();
				$os = $dataReg['os_atual'];

				$incluiPed = $this->Orcam_model->IncluirDadosPed($dataReg); //Inclui dados de orçam. na tabela pedidotb

				$alterCampos = $this->Orcam_model->AlterCampos($dataReg); //Altera os campos na tb equiptb em OrdServ_model

				$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
				$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
				$motor = $this->OrdServ_model->BuscarOs($os);

				if($dadosPed && $motor){
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/IncluirItemPedido";
					//$data['orcam'] = $dadosPed;
					$data['dadosPed'] = $dadosPed;
					$data['itemOrcam'] = $itemOrcam;
					$data['motor'] = $motor;
					$data['btnSubmit'] = null;
					$data['voidList'] = "Lista vazia";				
					$this->load->view('v_ChecarPagOrc',$data);
				}
				else{
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/incluirDadosOrcam";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "Dados não foram incluidos";
					$this->load->view('v-searchRestrict',$data);
				}
			
			}
		}
		public function	VoltarChecarDadosOrcam() {
			
			$os = $_GET['os'];

			$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
			$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
			$motor = $this->OrdServ_model->BuscarOs($os);

			if($dadosPed && $motor){
				$data['Title'] = "Orçamento";
				$data['metRout'] = "Orcamentos/IncluirItemPedido";
				$data['dadosPed'] = $dadosPed;
				$data['itemOrcam'] = $itemOrcam;
				$data['motor'] = $motor;
				$data['btnSubmit'] = null;
				$data['voidList'] = "Lista vazia";				
				$this->load->view('v_ChecarPagOrc',$data);
			}
			else{
				$data['Title'] = "Orçamento";
				$data['metRout'] = "Orcamentos/incluirDadosOrcam";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$data['error'] = "Dados não foram incluidos";
				$this->load->view('v-searchRestrict',$data);
			}
			
		}
		
		public function	IncluirItemPedido() {

				$item = $this->input->post('item');
				$os = $this->input->post('os_atual');
				$orcam = $this->Orcam_model->BuscarDadosPed($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor){
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/GravarItensPed";
					$data['orcam'] = $orcam;
					$data['motor'] = $motor;
					$data['item'] = $item +1;
					$data['btnSubmit'] = "Salvar";				
					$this->load->view('v_IncluirItemPedido',$data);
				}
				else{
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/IncluirItemPedido";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "Dados não foram incluidos";
					$this->load->view('v-searchRestrict',$data);
				}
				
			
		}
		public function	GravarItensPed() {
			if(!isset($_SESSION["logged"]) || (($_SESSION["permissao"]) == 'N')) {
				redirect('User/Login');
			}
			$this->form_validation->set_rules('produto','Produto','required|trim'); //  |callback_os_atual_check');  não está em uso
			$this->form_validation->set_rules('quantidade','Quantidade','required|trim');
			$this->form_validation->set_rules('unidade','Unidade','required|trim');
			$this->form_validation->set_rules('descricao','Descricao','required|trim');
			$this->form_validation->set_rules('valor_unit','Valor Unit','trim');
			$this->form_validation->set_rules('valor_total','Valor Total','trim');
			$this->form_validation->set_rules('os_atual','OS','trim');
			$this->form_validation->set_rules('id_equip','ID Cliente','trim');
			$this->form_validation->set_rules('item','Item','trim'); // |callback_ordem_compra_check'); não está em uso
			
			if($this->form_validation->run() ==	FALSE){	
				$os = $this->input->post('os_atual');
				$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
				$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				$data['Title'] = "Orçamento";
				$data['metRout'] = "Orcamentos/#";
				$data['dadosPed'] = $dadosPed;
				$data['itemOrcam'] = $itemOrcam;
				$data['motor'] = $motor;
				$data['btnSubmit'] = null;	
				$data['error'] = validation_errors();			
				$this->load->view('v_ChecarPagOrc',$data);
			}	
			else{			
				$dataReg =	$this->input->post();
				$os = $dataReg['os_atual'];
				$item =$dataReg['item'];
				$itemExist = $this->Orcam_model->ChecarItemExist($os, $item);
				if ($itemExist == false ){
					$quant = $dataReg['quantidade'];
					$valUnit = $dataReg['valor_unit'];
					$dataReg['valor_total'] = $quant * $valUnit;
					$incluiItem = $this->Orcam_model->IncluirItemOrcam($dataReg);
					
					$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
					$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
					$motor = $this->OrdServ_model->BuscarOs($os);
					if($itemOrcam && $motor && $dadosPed ){

						$data['Title'] = "Orçamento";
						$data['metRout'] = "Orcamentos/#";
						$data['dadosPed'] = $dadosPed;
						$data['itemOrcam'] = $itemOrcam;
						$data['motor'] = $motor;
						$data['voidList'] = "Lista de itens vazia";
						$data['btnSubmit'] = null;				
						$this->load->view('v_ChecarPagOrc',$data);
					}
					else{
						$data['motor'] = $motor;
						$data['Title'] ="Orçamento" ;
						$data['metRout'] = "Orcamentos/GravarItensPedido";
					 	$data['btnSubmit'] = "Incluir orçamentos";	
						$data['error'] = "Os dados Não foram incluidos.";
						$this->load->view('v_IncluirOrcam',$data);
					}
				}
				else{
					$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
					$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
					$motor = $this->OrdServ_model->BuscarOs($os);
					if($itemOrcam && $motor && $dadosPed ){

						$data['Title'] = "Orçamento";
						$data['metRout'] = "Orcamentos/#";
						$data['dadosPed'] = $dadosPed;
						$data['itemOrcam'] = $itemOrcam;
						$data['motor'] = $motor;
						$data['voidList'] = "Lista de itens vazia";
						$data['btnSubmit'] = null;
						$data['error'] = "Esse item já existe";					
						$this->load->view('v_ChecarPagOrc',$data);
					}
				}
			}
			
		}
		public function	incluirDadosOrcamCheckData(){
			
				$os = $_GET['id'];
				$osExist = $this->Orcam_model->GetOsExist($os);
				if ($osExist == $os){
					redirect("Orcamentos/ChecarDadosOrcCheckDat?id=$os");
				}else{
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor){
					$this->load->model('Clientes_model'); //carrega model Clientes_model
					$this->load->model('Solicit_model'); //carrega model Solicit_model
					$clien = $this->Clientes_model->GetNomeClient(); //recupera dados da tabela clientestb
					
					$idClient = $this->Solicit_model->GetIdClient($motor->cliente);
					$solicit = $this->Solicit_model->GetSolicByIdClient($idClient->id); //recupera dados da tabela solicitantetb
					$emailSolic = $this->Solicit_model->GetEmailSolic($motor->solicitante);

					$data['clien'] = $clien;//envia os dados p/ o form v-checkDataRestrict (campo nome do cliente)
					$data['solicit'] = $solicit;//envia os dados p/ o form v-checkDataRestrict (campo nome do solicitante)
					$data['Title'] = "Orçamentos";
					$data['metRout'] = "Orcamentos/ChecarDadosOrcam";
					$data['btnSubmit'] = "Iniciar";				
					$data['motor'] = $motor;
					$data['solic'] = $emailSolic;
					$data['error'] = null;
					$this->load->view('v_incluirDadosOrcam',$data);
				}
				else{
					$data['Title'] = "Orçamentos";
					$data['metRout'] = "Orcamentos/incluirDadosOrcam";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "Dados não foram incluidos.";
					$this->load->view('v-searchRestrict',$data);
				}
			}
			
		}
		public function	ChecarDadosOrcCheckData(){
			$os = $_GET['id'];
			$dadosped = $this->Orcam_model->BuscarDadosPedido($os);
			$motor = $this->OrdServ_model->BuscarOs($os);
			$solic = $this->Solicit_model->BuscarSolicit($motor->solicitante);
			if($dadosped && $motor ){
				$valPed = $this->Orcam_model->BuscarValoresPed($os);
				$itemOrc = $this->Orcam_model->BuscarItemOrcam($os);
					
				if($valPed && $itemOrc){
					$data['Title'] = "Orçamento";
					$data['dadosped'] = $dadosped;
					$data['valPed'] = $valPed;
					$data['motor'] = $motor;
					$data['solic'] = $solic;
					$data['itemOrc'] = $itemOrc;
					$data['CheckDataPage'] = false;
					$this->load->view('v_ChecarPagPedido',$data);		
				}
				else{
					$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
					$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
					$motor = $this->OrdServ_model->BuscarOs($os);

					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/#";
					$data['dadosPed'] = $dadosPed;
					$data['itemOrcam'] = $itemOrcam;
					$data['motor'] = $motor;
					$data['btnSubmit'] = null;
					$data['voidList'] = "Lista vazia";		
					$data['error'] = "Esse orçameto não foi concluido";			
					$this->load->view('v_ChecarPagOrc',$data);
				}
			}
			else{
				$data['error'] = "Esse equipamento não possui orçamento";
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "Orcamentos/ChecarDadosOrcMenu";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
			}
			/*
			$dadosped = $this->Orcam_model->BuscarDadosPedido($os);
			$valPed = $this->Orcam_model->BuscarValoresPed($os);
			$itemOrc = $this->Orcam_model->BuscarItemOrcam($os);
			$motor = $this->OrdServ_model->BuscarOs($os);
			$solic = $this->Solicit_model->BuscarSolicit($motor->solicitante);
			if($dadosped && $motor){
				$data['Title'] = "Orçamento";
				$data['dadosped'] = $dadosped;
				$data['valPed'] = $valPed;
				$data['motor'] = $motor;
				$data['solic'] = $solic;
				$data['itemOrc'] = $itemOrc;
				$data['CheckDataPage'] = false;
				$this->load->view('v_ChecarPagPedido',$data);		
			}
			else{
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "Orcamentos/IncluirDadosOrcam";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$data['error']= "ESTA OS NÃO POSSUI ORÇAMENTO";
				$this->load->view('v-searchRestrict',$data);
			}
		
			*/
		}
		public function BuscarOrcamPesq(){
			$data['Title'] = "Digite a OS";
			$data['metRout'] = "Orcamentos/ChecarDadosOrcMenu";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	ChecarDadosOrcCheckDat(){
		if(!isset($_GET['id'])){	
				$data['error'] = "Por favor, digite a os aqui!";
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "Orcamentos/ChecarDadosOrcMenu";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
			}
			else{
				$os = $_GET['id'];			
				$dadosped = $this->Orcam_model->BuscarDadosPedido($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($dadosped && $motor){
					$valPed = $this->Orcam_model->BuscarValoresPed($os);
					$itemOrc = $this->Orcam_model->BuscarItemOrcam($os);
					$solic = $this->Solicit_model->BuscarSolicit($motor->solicitante);
					if($dadosped && $motor && $valPed &&$itemOrc){
						$data['Title'] = "Orçamento";
						$data['dadosped'] = $dadosped;
						$data['valPed'] = $valPed;
						$data['motor'] = $motor;
						$data['solic'] = $solic;
						$data['itemOrc'] = $itemOrc;
						$data['CheckDataPage'] = false;
						$data['voidList'] = "Lista vazia";	
						$this->load->view('v_ChecarPagPedido',$data);		
					}
					else{
						$os = $this->input->post('os_atual');
						$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
						$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
						$motor = $this->OrdServ_model->BuscarOs($os);

						$data['Title'] = "Orçamento";
						$data['metRout'] = "Orcamentos/#";
						$data['dadosPed'] = $dadosPed;
						$data['itemOrcam'] = $itemOrcam;
						$data['motor'] = $motor;
						$data['btnSubmit'] = null;
						$data['voidList'] = "Lista vazia";		
						$data['error'] = "Esse orçameto não foi concluido";			
						$this->load->view('v_ChecarPagOrc',$data);
					}
				}
				else{
					$data['error'] = "Esse orçamento não existe.";
					$data['Title'] = "Digite a OS";
					$data['metRout'] = "Orcamentos/ChecarDadosOrcMenu";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$this->load->view('v-searchRestrict', $data);
				}
			}
		}
		
		
		public function	ChecarDadosOrcMenu(){
			$this->form_validation->set_rules('os_atual','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "Orcamentos/ChecarDadosOrcMenu";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
			}
			else{
				$os = $this->input->post('os_atual');			
				$dadosped = $this->Orcam_model->BuscarDadosPedido($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($dadosped && $motor){
					$valPed = $this->Orcam_model->BuscarValoresPed($os);
					$itemOrc = $this->Orcam_model->BuscarItemOrcam($os);
					$solic = $this->Solicit_model->BuscarSolicit($motor->solicitante);
					if($dadosped && $motor && $valPed &&$itemOrc){
						$data['Title'] = "Orçamento";
						$data['dadosped'] = $dadosped;
						$data['valPed'] = $valPed;
						$data['motor'] = $motor;
						$data['solic'] = $solic;
						$data['itemOrc'] = $itemOrc;
						$data['CheckDataPage'] = false;
						$data['voidList'] = "Lista vazia";	
						$this->load->view('v_ChecarPagPedido',$data);		
					}
					else{
						$os = $this->input->post('os_atual');
						$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
						$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
						$motor = $this->OrdServ_model->BuscarOs($os);

						$data['Title'] = "Orçamento";
						$data['metRout'] = "Orcamentos/#";
						$data['dadosPed'] = $dadosPed;
						$data['itemOrcam'] = $itemOrcam;
						$data['motor'] = $motor;
						$data['btnSubmit'] = null;
						$data['voidList'] = "Lista vazia";		
						$data['error'] = "Esse orçameto não foi concluido";			
						$this->load->view('v_ChecarPagOrc',$data);
					}
				}
				else{
					$data['error'] = "Esse orçamento não existe.";
					$data['Title'] = "Digite a OS";
					$data['metRout'] = "Orcamentos/ChecarDadosOrcMenu";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$this->load->view('v-searchRestrict', $data);
				}
			}
		}
		public function BuscarOrcamAlter(){
			$data['Title'] = "Digite a OS";
			$data['metRout'] = "Orcamentos/ChecarOrcamAlter";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	VoltarAlterDadosOrcam() {   //====++++++++++Verificar!!!!!!!!
			
			$os = $_GET['os'];

			$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
			$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
			$motor = $this->OrdServ_model->BuscarOs($os);

			if($dadosPed && $motor){
				$data['Title'] = "Orçamento";
				$data['metRout'] = "Orcamentos/AlterarDadosOrcam";
				$data['dadosPed'] = $dadosPed;
				$data['itemOrcam'] = $itemOrcam;
				$data['motor'] = $motor;
				$data['btnSubmit'] = "Alterar";
				$data['voidList'] = "Lista vazia";				
				$this->load->view('v_AlterarPagOrc',$data);
			}
			else{
				$data['Title'] = "Orçamento";
				$data['metRout'] = "Orcamentos/ChecarOrcamAlter";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$data['error'] = "Dados não foram incluidos";
				$this->load->view('v-searchRestrict',$data);
			}
			
		}
		public function	ChecarOrcamAlter(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os_atual','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "Orcamentos/ChecarOrcamPesq";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
			}
			else{
				$os = $this->input->post('os_atual');


				$dadosPed = $this->Orcam_model->BuscarDadosPed($os);
				$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($dadosPed && $motor){
					$data['Title'] = "Alterar Orçamento";
					$data['metRout'] = "Orcamentos/AlterarDadosOrcam";
					$data['btnSubmit'] = "Alterar";
					$data['dadosPed'] = $dadosPed;
					$data['motor'] = $motor;
					$data['itemOrcam'] = $itemOrcam;
					//$data['metodoAltExclui'] = true;
					$data['voidList'] = "Lista de itens vazia";
					$data['error'] = null;
					$data['success'] = "BUSCA REALIZADA COM SUCESSO.";
					$data['CheckDataPage'] = false;
					$this->load->view('v_AlterarPagOrc',$data);
				}
				else{
				$data['error'] = "Dados não encontrados";
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "Orcamentos/ChecarOrcamAlter";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
				}
			}
		}
		public function	AlterarDadosOrcam() {
			$this->form_validation->set_rules('os_atual','OS atual','required|trim');
			$this->form_validation->set_rules('data_orcam','Data Orçamento','required|trim');
			$this->form_validation->set_rules('contato','Contato','trim');
			$this->form_validation->set_rules('email','Email Contato','trim');
			$this->form_validation->set_rules('forma_pgto','Forma de Pgto','trim');
			$this->form_validation->set_rules('prazo_pgto','Prazo de Pgto','trim');
			$this->form_validation->set_rules('prazo_entrega','Prazo de Entrega','trim');
			$this->form_validation->set_rules('valid_proposta','Validade','trim');			
			$this->form_validation->set_rules('garantia',' Garantia','trim');
			$this->form_validation->set_rules('impostos',' Impostos','trim');
			$this->form_validation->set_rules('status_orc',' Status do Orçam','trim');
			$this->form_validation->set_rules('causa_falha_orc','Causa da falha no orçam.','trim');
			$this->form_validation->set_rules('descr_falha_orc',' Descrição da falha no orçam.','trim');
			$this->form_validation->set_rules('id_equip','Id equip','trim');
			$this->form_validation->set_rules('formato_pagina','Formato pagina','trim');

			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "Orcamentos/AlterarDadosOrcam";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
			}
			else{
				$dataReg = $this->input->post();
				$os = $dataReg['os_atual'];
				$alterPed = $this->Orcam_model->AlterDadosPed($dataReg); //Altera dados de orçam. na tabela pedidotb

				$alterCampos = $this->Orcam_model->AlterCampos($dataReg); //Altera os campos na tb equiptb em OrdServ_model

				$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
				$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
				$motor = $this->OrdServ_model->BuscarOs($os);

				if($motor && $dadosPed ){
					$data['Title'] = "Alterar Orçamento";
					$data['metRout'] = "Orcamentos/AlterarDadosOrcam";
					$data['dadosPed'] = $dadosPed;
					$data['itemOrcam'] = $itemOrcam;
					$data['motor'] = $motor;
					$data['btnSubmit'] = null;	
					$data['voidList'] = "Lista vazia";			
					$this->load->view('v_ChecarPagOrc',$data);
				}
				else{
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/AlterarDadosOrcam";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "Dados não foram incluidos";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		public function BuscarOrcamDel(){
			$data['Title'] = "Excluir Orçam.";
			$data['metRout'] = "Orcamentos/ChecarOrcamDel";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	ChecarOrcamDel(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os_atual','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
				$data['Title'] = "Digite a OS";
				$data['metRout'] = "Orcamentos/ChecarOrcamDel";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
			}
			else{
				$os = $this->input->post('os_atual');


				$dadosPed = $this->Orcam_model->BuscarDadosPed($os);
				$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($dadosPed && $motor){
					$data['Title'] = "Excluir Orçamento";
					$data['metRout'] = "Orcamentos/ExcluirDadosOrcam";
					$data['btnSubmit'] = "Excluir";
					$data['dadosPed'] = $dadosPed;
					$data['motor'] = $motor;
					$data['itemOrcam'] = $itemOrcam;
					$data['voidList'] = "Lista de itens vazia";
					$data['error'] = "Todos esses dados serão excluido irreversivelmente";
					$data['CheckDataPage'] = false;
					$this->load->view('v_CheckPagOrcDel',$data);
				}
				else{
				$data['error'] = "Dados não encontrados";
				$data['Title'] = "Excluir Orçam.";
				$data['metRout'] = "Orcamentos/ChecarOrcamDel";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict', $data);
				}
			}
		}
		public function	ExcluirDadosOrcam() {
			$dataReg = $this->input->post();
			$os = $dataReg['os_atual'];
			$excluirPed = $this->Orcam_model->ExcluirDadosPed($os); //Exclui todos os dados na tabela pedidotb.
			$excluirItens = $this->Orcam_model->ExcluirItensPed($os); //Exclui todos os dados na tabela item_pedidotb.
			$excluirVal = $this->Orcam_model->ExcluirValoresPed($os); //Exclui todos os dados na tabela valores_orcamtb.

			$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
			$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
			$motor = $this->OrdServ_model->BuscarOs($os);

			if($excluirPed == false || $excluirItens == false || $excluirVal == false){
				$data['Title'] = "Excluir Orçamento";
				$data['metRout'] = "Orcamentos/AlterarDadosOrcam";
				$data['dadosPed'] = $dadosPed;
				$data['itemOrcam'] = $itemOrcam;
				$data['motor'] = $motor;
				$data['btnSubmit'] = "Alterar";	
				$data['error'] = "Não foram excluidos todos os dados, favor avisar suporte";
				$data['voidList'] = "Lista vazia";			
				$this->load->view('v_ChecarPagOrc',$data);
			}
			else{
				$data['Title'] = "Excluir Orçam.";
				$data['metRout'] = "Orcamentos/ChecarOrcamDel";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$data['success'] = "Dados excluidos com sucesso";
				$this->load->view('v-searchRestrict',$data);
			}
		}
		
		public function	FinalizarPedido() {
			
			$os = $_GET['id'];
			$orcam = $this->Orcam_model->BuscarItemOrcam($os);
			$motor = $this->OrdServ_model->BuscarOs($os);

			$valPecas = $this->Orcam_model->BuscarValPecas($os);
			$valServicos = $this->Orcam_model->BuscarValServicos($os);
			$subTotal = $this->Orcam_model->BuscarSubTotal($os);
			
			if($orcam){
				
				$data['Title'] = "Finalizar Orçamento";
				$data['metRout'] = "Orcamentos/ExecutarDesconto";
				$data['motor'] = $motor;
				$data['orcam'] = $orcam;
				$data['valPecas'] = $valPecas;
				$data['valServicos'] = $valServicos;
				$data['subTotal'] = $subTotal;
				$data['btnSubmit'] = "Executar";
				//$data['error'] = "Por favor, digite a porcentagem ou  valor";
				$this->load->view('v_FinalizarPedido',$data);		
			}
			else{
				$data['motor'] = $motor;
				$data['Title'] ="Orçamento" ;
				$data['metRout'] = "Orcamentos/GravarDadosOrcam";   //Verificar
			 	$data['btnSubmit'] = "Incluir orçamentos";	
				$data['error'] = "Os dados Não foram incluidos.";
				$this->load->view('v_IncluirOrcam',$data);
			}
			
		}

		public function	ExecutarDesconto() {
			$this->form_validation->set_rules('val_pecas','Valor Peças','trim'); //  |callback_os_atual_check');  não está em uso
			$this->form_validation->set_rules('val_servicos','Valor Serviços','trim');
			$this->form_validation->set_rules('SubTotal','SubTotal','required|trim');
			$this->form_validation->set_rules('desc_percento','Desc %','trim');
			$this->form_validation->set_rules('desc_valor','Valor Desc','trim');
			$this->form_validation->set_rules('valor_final','Valor Final','trim');
			$this->form_validation->set_rules('os_atual','OS','trim');
			$this->form_validation->set_rules('id_equip','ID Cliente','trim');
			
			if($this->form_validation->run() ==	FALSE){	
				$os = $this->input->post('os_atual');
				$motor = $this->OrdServ_model->BuscarOs($os);
				$data['motor'] = $motor;
				$data['Title'] ="Orçamento" ;
				$data['metRout'] = "Orcamentos/GravarItensPedido";
				$data['btnSubmit'] = "Incluir orçamento";
				$data['error'] = validation_errors();
				$this->load->view('v_IncluirItemPedido',$data);
			}
			else{
			
				$data = $this->input->post();
				$orcam = $this->Orcam_model->BuscarItemOrcam($data['os_atual']);
				$motor = $this->OrdServ_model->BuscarOs($data['os_atual']);

				$valPecas = $this->Orcam_model->BuscarValPecas($data['os_atual']);
				$valServicos = $this->Orcam_model->BuscarValServicos($data['os_atual']);
				$subTotal = $this->Orcam_model->BuscarSubTotal($data['os_atual']);

				if($orcam){

					if (!empty($data['desc_percento']) && empty($data['desc_valor']) && empty($data['acresc_percento']) && empty($data['acresc_valor'])) {
						$taxa = $data['desc_percento']/100;
						$valDesc = $data['desc_valor'];
						$desc_percento = $data['desc_percento'];
						$acresc_perc = $data['acresc_percento'];
						$acresc_val = $data['acresc_valor'];
						$valor_final = $subTotal*(1-$taxa);
						$valDesc = $subTotal - $valor_final;

						$data['Title'] = "Checar Desconto em %";
						$data['metRout'] = "Orcamentos/concluir_pedido";
						$data['motor'] = $motor;
						$data['orcam'] = $orcam;
						$data['valPecas'] = number_format($valPecas, 2, ".", "");
						$data['valServicos'] = number_format($valServicos, 2, ".", "");
						$data['subTotal'] = number_format($subTotal, 2, ".", "");
						$data['valor_final'] = number_format($valor_final, 2, ".", "");
						$data['desc_valor'] =  number_format($valDesc, 2, ".", "");
						$data['desc_percento'] = number_format($desc_percento, 2, ".", "").'%';
						$data['btnSubmit'] = "Concluir";
						$this->load->view('v_ChecarDesconto',$data);	

					}
					elseif (empty($data['desc_percento']) && !empty($data['desc_valor']) && empty($data['acresc_percento']) && empty($data['acresc_valor'])) {
						$valDesc = $data['desc_valor'];
						$valor_final = $subTotal - $valDesc;
						$desc_percento = ($valDesc * 100) / $subTotal;

						$data['Title'] = "Checar Desconto em valor";
						$data['metRout'] = "Orcamentos/concluir_pedido";
						$data['motor'] = $motor;
						$data['orcam'] = $orcam;
						$data['valPecas'] = number_format($valPecas, 2, ".", "");
						$data['valServicos'] = number_format($valServicos, 2, ".", "");
						$data['subTotal'] = number_format($subTotal, 2, ".", "");
						$data['valor_final'] =  number_format($valor_final, 2, ".", "");
						$data['desc_valor'] =  number_format($valDesc, 2, ".", "");
						$data['desc_percento'] = number_format($desc_percento, 2, ".", "").'%';
						$data['btnSubmit'] = "Concluir";
						$this->load->view('v_ChecarDesconto',$data);
					}
					elseif (empty($data['desc_percento']) && empty($data['desc_valor']) && !empty($data['acresc_percento']) && empty($data['acresc_valor'])) {
						$taxa = $data['acresc_percento']/100;
						$valDesc = $data['desc_valor'];
						$desc_percento = $data['desc_percento'];
						$acresc_perc = $data['acresc_percento'];
						$acresc_val = $data['acresc_valor'];
						$valor_final = $subTotal*(1+$taxa);
						$valAcresc = $valor_final - $subTotal;

						$data['Title'] = "Checar Acréscimo em %";
						$data['metRout'] = "Orcamentos/concluir_pedido";
						$data['motor'] = $motor;
						$data['orcam'] = $orcam;
						$data['valPecas'] = number_format($valPecas, 2, ".", "");
						$data['valServicos'] = number_format($valServicos, 2, ".", "");
						$data['subTotal'] = number_format($subTotal, 2, ".", "");
						$data['valor_final'] = number_format($valor_final, 2, ".", "");
						$data['acresc_valor'] = number_format($valAcresc, 2, ".", "");
						$data['acresc_percento'] = number_format($acresc_perc, 2, ".", "").'%';
						$data['btnSubmit'] = "Concluir";
						$this->load->view('v_ChecarAcrescimo',$data);
					}
					elseif (empty($data['desc_percento']) && empty($data['desc_valor']) && empty($data['acresc_percento']) && !empty($data['acresc_valor'])) {
						$valAcresc = $data['acresc_valor'];
						$valor_final = $subTotal + $valAcresc;
						$acresc_perc = ($valAcresc * 100) / $subTotal;

						$data['Title'] = "Checar Acréscimo em valor";
						$data['metRout'] = "Orcamentos/concluir_pedido";
						$data['motor'] = $motor;
						$data['orcam'] = $orcam;
						$data['valPecas'] = number_format($valPecas, 2, ".", "");
						$data['valServicos'] = number_format($valServicos, 2, ".", "");
						$data['subTotal'] = number_format($subTotal, 2, ".", "");
						$data['valor_final'] = number_format($valor_final, 2, ".", "");
						$data['acresc_valor'] = number_format($valAcresc, 2, ".", "");
						$data['acresc_percento'] = number_format($acresc_perc, 2, ".", "").'%';
						$data['btnSubmit'] = "Concluir";
						$this->load->view('v_ChecarAcrescimo',$data);
					}
					elseif (empty($data['desc_percento']) && empty($data['desc_valor']) && empty($data['acresc_percento']) && empty($data['acresc_valor'])) {
						$valDesc = $data['desc_valor'];
						$desc_percento = $data['desc_percento'];
						$valor_final = $subTotal;

						$data['Title'] = "Checar Valor Sem Desconto";
						$data['metRout'] = "Orcamentos/concluir_pedido";
						$data['motor'] = $motor;
						$data['orcam'] = $orcam;
						$data['valPecas'] = number_format($valPecas, 2, ".", "");
						$data['valServicos'] = number_format($valServicos, 2, ".", "");
						$data['subTotal'] = number_format($subTotal, 2, ".", "");
						$data['valor_final'] = number_format($valor_final, 2, ".", "");
						$data['desc_valor'] = $valDesc;
						$data['desc_percento'] = $desc_percento;
						$data['btnSubmit'] = "Concluir";
						$this->load->view('v_ChecarDesconto',$data);
					}
					elseif (!empty($data['desc_percento']) && !empty($data['desc_valor']) || !empty($data['acresc_percento']) && !empty($data['acresc_valor'])) {
						$data['Title'] = "Finalizar Orçamento";
						$data['metRout'] = "Orcamentos/ExecutarDesconto";
						$data['motor'] = $motor;
						$data['orcam'] = $orcam;
						$data['valPecas'] = $valPecas;
						$data['valServicos'] = $valServicos;
						$data['subTotal'] = $subTotal;
						$data['btnSubmit'] = "Executar";
						$data['error'] = "Por favor, preencha sómente um campo";
						$this->load->view('v_FinalizarPedido',$data);	
					}
					elseif (!empty($data['desc_percento']) && empty($data['desc_valor']) || !empty($data['acresc_percento']) && empty($data['acresc_valor'])) {
						$data['Title'] = "Finalizar Orçamento";
						$data['metRout'] = "Orcamentos/ExecutarDesconto";
						$data['motor'] = $motor;
						$data['orcam'] = $orcam;
						$data['valPecas'] = $valPecas;
						$data['valServicos'] = $valServicos;
						$data['subTotal'] = $subTotal;
						$data['btnSubmit'] = "Executar";
						$data['error'] = "Por favor, preencha sómente um campo";
						$this->load->view('v_FinalizarPedido',$data);	
					}
					elseif (empty($data['desc_percento']) && !empty($data['desc_valor']) || empty($data['acresc_percento']) && !empty($data['acresc_valor'])) {
						$data['Title'] = "Finalizar Orçamento";
						$data['metRout'] = "Orcamentos/ExecutarDesconto";
						$data['motor'] = $motor;
						$data['orcam'] = $orcam;
						$data['valPecas'] = $valPecas;
						$data['valServicos'] = $valServicos;
						$data['subTotal'] = $subTotal;
						$data['btnSubmit'] = "Executar";
						$data['error'] = "Por favor, preencha sómente um campo";
						$this->load->view('v_FinalizarPedido',$data);	
					}
					elseif (!empty($data['desc_percento']) && empty($data['desc_valor']) || empty($data['acresc_percento']) && !empty($data['acresc_valor'])) {
						$data['Title'] = "Finalizar Orçamento";
						$data['metRout'] = "Orcamentos/ExecutarDesconto";
						$data['motor'] = $motor;
						$data['orcam'] = $orcam;
						$data['valPecas'] = $valPecas;
						$data['valServicos'] = $valServicos;
						$data['subTotal'] = $subTotal;
						$data['btnSubmit'] = "Executar";
						$data['error'] = "Por favor, preencha sómente um campo";
						$this->load->view('v_FinalizarPedido',$data);	
					}
						
				}
				else{
					$data['motor'] = $motor;
					$data['Title'] ="Orçamento" ;
					$data['metRout'] = "Orcamentos/GravarDadosOrcam";   //Verificar
				 	$data['btnSubmit'] = "Incluir orçamentos";	
					$data['error'] = "Os dados Não foram incluidos.";
					$this->load->view('v_IncluirOrcam',$data);
				}
			}
			
		}
		public function	concluir_pedido() {
			$this->form_validation->set_rules('val_pecas','Desconto valor','trim');
			$this->form_validation->set_rules('val_servicos','Desconto valor','trim');
			$this->form_validation->set_rules('subTotal','Desconto valor','trim');
			$this->form_validation->set_rules('desc_percento','Desconto em %','trim');
			$this->form_validation->set_rules('desc_valor','Desconto valor','trim');
			$this->form_validation->set_rules('acresc_percento','Acresc em %','trim');
			$this->form_validation->set_rules('acresc_valor','Acresc valor','trim');
			$this->form_validation->set_rules('valor_final','Valor final','trim');
			$this->form_validation->set_rules('os_atual','OS','trim');
			$this->form_validation->set_rules('id_equip','ID Cliente','trim');
			
			if($this->form_validation->run() ==	FALSE){	
				$os = $this->input->post('os_atual');	
				$orcam = $this->Orcam_model->BuscarItemOrcam($os);
				$motor = $this->OrdServ_model->BuscarOs($os);

				$valPecas = $this->Orcam_model->BuscarValPecas($os);
				$valServicos = $this->Orcam_model->BuscarValServicos($os);
				$subTotal = $this->Orcam_model->BuscarSubTotal($os);
				
				if($orcam){
					
					$data['Title'] = "Finalizar Orçamento";
					$data['metRout'] = "Orcamentos/ExecutarDesconto";
					$data['motor'] = $motor;
					$data['orcam'] = $orcam;
					$data['valPecas'] = $valPecas;
					$data['valServicos'] = $valServicos;
					$data['subTotal'] = $subTotal;
					$data['btnSubmit'] = "Executar";
					$data['error'] = validation_errors();
					$this->load->view('v_FinalizarPedido',$data);
				}
			}	
			else{			
				$dataReg =	$this->input->post();

				$os = $dataReg['os_atual'];
				$osExist = $this->Orcam_model->checkOsValores($os);
				if ($osExist){
					$alteraValores = $this->Orcam_model->AlterarValoresPed($dataReg);
				}else{
					$incluiValores = $this->Orcam_model->IncluirValoresPed($dataReg);
				}
				$dadosped = $this->Orcam_model->BuscarDadosPedido($os);
				$valPed = $this->Orcam_model->BuscarValoresPed($os);
				$itemOrc = $this->Orcam_model->BuscarItemOrcam($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				$solic = $this->Solicit_model->BuscarSolicit($motor->solicitante);
				if($dadosped && $motor){
					$data['Title'] = "Orçamento";
					$data['dadosped'] = $dadosped;
					$data['valPed'] = $valPed;
					$data['motor'] = $motor;
					$data['solic'] = $solic;
					$data['itemOrc'] = $itemOrc;
					$data['CheckDataPage'] = false;
					$this->load->view('v_ChecarPagPedido',$data);		
				}
				else{
					$data['motor'] = $motor;
					$data['Title'] ="Orçamento" ;
					$data['metRout'] = "Orcamentos/GravarItensPedido";
				 	$data['btnSubmit'] = "Incluir orçamentos";	
					$data['error'] = "Os dados Não foram incluidos.";
					$this->load->view('v_IncluirOrcam',$data);
				}
			}	
		}
		
		function ChecarPedidoConcluido(){
			$os = $_GET['id'];

			$valPed = $this->Orcam_model->BuscarValoresPed($os);
			$itemOrc = $this->Orcam_model->BuscarItemOrcam($os);
			$motor = $this->OrdServ_model->BuscarOs($os);
			$solic = $this->Solicit_model->BuscarSolicit($motor->solicitante);
			if($valPed && $itemOrc && $motor){
				$data['Title'] = "Orçamento";
				$data['valPed'] = $valPed;
				$data['motor'] = $motor;
				$data['solic'] = $solic;
				$data['itemOrc'] = $itemOrc;
				$data['CheckDataPage'] = false;
				$this->load->view('v_ChecarPagPedido',$data);		
			}
			else{
				$data['motor'] = $motor;
				$data['Title'] ="Orçamento" ;
				$data['metRout'] = "Orcamentos/GravarItensPedido";
			 	$data['btnSubmit'] = "Incluir orçamentos";	
				$data['error'] = "Os dados Não foram incluidos.";
				$this->load->view('v_IncluirOrcam',$data);
			}
			
		}
		public function	EditarItemOrcam() {
				$orcam = $this->input->post();
				$os = $this->input->post('os_atual');
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor){
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/AlterarItemOrcam";
					$data['motor'] = $motor;
					$data['orc'] = $orcam;
					$data['btnSubmit'] = "Alterar";				
					$this->load->view('v_EditarOrcam',$data);
				}
				else{
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/EditarItemOrcam";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "Dados não foram incluidos";
					$this->load->view('v-searchRestrict',$data);
				}
		}
		public function	AlterarItemOrcam() {
			$this->form_validation->set_rules('produto','Produto','required|trim'); //  |callback_os_atual_check');  não está em uso
			$this->form_validation->set_rules('quantidade','Quantidade','required|trim');
			$this->form_validation->set_rules('unidade','Unidade','required|trim');
			$this->form_validation->set_rules('descricao','Descricao','required|trim');
			$this->form_validation->set_rules('valor_unit','Valor Unit','trim');
			$this->form_validation->set_rules('valor_total','Valor Total','trim');
			$this->form_validation->set_rules('os_atual','OS','trim');
			$this->form_validation->set_rules('id_equip','ID Cliente','trim');
			$this->form_validation->set_rules('item','Item','trim'); 
			
			if($this->form_validation->run() ==	FALSE){	
				$os = $this->input->post('os_atual');
				$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
				$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
				$motor = $this->OrdServ_model->BuscarOs($os);

				$data['Title'] = "Orçamento";
				$data['metRout'] = "Orcamentos/IncluirItemPedido";
				$data['dadosPed'] = $dadosPed;
				$data['itemOrcam'] = $itemOrcam;
				$data['motor'] = $motor;
				$data['btnSubmit'] = null;	
				$data['error'] = validation_errors();			
				$this->load->view('v_ChecarPagOrc',$data);
				
			}	
			else{			
				$dataReg =	$this->input->post();
				$os = $dataReg['os_atual'];

				$quant = $dataReg['quantidade'];
				$valUnit = $dataReg['valor_unit'];
				$dataReg['valor_total'] = $quant * $valUnit;
				$alterarOrc = $this->Orcam_model->AlterarItemOrc($dataReg);


				$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
				$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
				$motor = $this->OrdServ_model->BuscarOs($os);

				if($itemOrcam && $motor && $dadosPed){
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/IncluirItemPedido";
					$data['dadosPed'] = $dadosPed;
					$data['itemOrcam'] = $itemOrcam;
					$data['motor'] = $motor;
					$data['btnSubmit'] = null;				
					$this->load->view('v_ChecarPagOrc',$data);
				}
				else{
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/AlterarDadosOrcam";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "Dados não foram incluidos";
					$this->load->view('v-searchRestrict',$data);
				}
			}
			
		}
		public function	ExcluirItemOrcam() {
				$os = $_GET['os'];
				$item = $_GET['item'];
				$motor = $this->OrdServ_model->BuscarOs($os);
				$results = $this->Orcam_model->deletarItemOrcam($os, $item);

				if($results){
					$dadosPed = $this->Orcam_model->BuscarDadosPedido($os);
					$itemOrcam = $this->Orcam_model->BuscarItemOrcam($os);
					$motor = $this->OrdServ_model->BuscarOs($os);

					if($motor && $dadosPed){
						$data['Title'] = "Orçamento";
						$data['metRout'] = "Orcamentos/IncluirItemPedido";
						$data['dadosPed'] = $dadosPed;
						$data['itemOrcam'] = $itemOrcam;
						$data['motor'] = $motor;
						$data['btnSubmit'] = null;
						$data['voidList'] = "Lista vazia";				
						$this->load->view('v_ChecarPagOrc',$data);
					}

					// ===================
				}
				else{
					$data['Title'] = "Orçamento";
					$data['metRout'] = "Orcamentos/EditarItemOrcam";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "Dados não foram incluidos";
					$this->load->view('v-searchRestrict',$data);
				}
		}
		
		public function ExportPdfPage(){ 
			$this->load->library('M_pdf');	
			$os = $_GET['os'];			

			$dadosped = $this->Orcam_model->BuscarDadosPedido($os);
			$itemOrc = $this->Orcam_model->BuscarItemOrcam($os);
			$motor = $this->OrdServ_model->BuscarOs($os);
			$solic = $this->Solicit_model->BuscarSolicit($motor->solicitante);
			$valPed = $this->Orcam_model->BuscarValoresPed($os);
			if($dadosped && $motor && $itemOrc && $valPed ){
				
			$data['dadosped'] = $dadosped;
			$data['valPed'] = $valPed;
			$data['motor'] = $motor;
			$data['solic'] = $solic;
			$data['itemOrc'] = $itemOrc;
			$html=$this->load->view('v_PageOrcPDF',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.	
			$pdfFilePath ="Orçamento os: $os.pdf";		
			$pdf = $this->m_pdf->load();
					
				$stylesheet = file_get_contents('./assets/css/orcamStyle.css');

				$pdf->WriteHTML($stylesheet,1);
				$pdf->WriteHTML($html,2);
				$pdf->Output($pdfFilePath, "I");
			}
			else{
				$data['Title'] = "Exportar para pdf";
				$data['metRout'] = "CheckList/buscarDadosChecklist";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "ord_servico";
				$data['id'] = "ord_servico";
				$data['error']= "Não foi possivel exportar o arquivo";
				$this->load->view('v-searchRestrict',$data);
			}
			
		}

		function PostarImagemOrcam() {
			$data['Title'] = "Postar imagem do orçamento";
			$data['metRout'] = "Orcamentos/uploadImageOrcam";
			$data['btnSubmit'] = "Postar";	
			$this->load->view('v_uploadImage',$data);
		}
		
		function uploadImageOrcam(){
			$uploadImage = $this->UploadFileOrcam('imagem1');
			if($uploadImage['error']){
				$data['Title'] = "Postar Imagem do orçamento";
				$data['metRout'] = "Orcamentos/uploadImageSingle";
				$data['btnSubmit'] = "Postar";
				$data['error']	= $uploadImage['message'];
				$this->load->view('v_uploadImage',$data);
			}else if($uploadImage){
				$data['Title'] = "Postar Imagem do orçamento";
				$data['metRout'] = "Orcamentos/uploadImageOrcam";
				$data['btnSubmit'] = "Postar";
				$data['success']= "Upload realizado com sucesso";
				$this->load->view('v_uploadImage',$data);
			}
		}
		
		private	function UploadFileOrcam($inputFile){		
			$this->load->library('upload');
			$path =	"./uploadsOrcam";
			$config['upload_path'] = $path; 
			$config['allowed_types'] = 'gif|jpg|png|PNG|JPG';
			$config['max_size'] = '500';
			$config['max_width'] = '2048';
			$config['max_height'] = '1536';
			$config['overwrite'] = TRUE;
			$config['encrypt_name']	= FALSE;
			
			if (!is_dir($path))	
				mkdir($path, 0777, $recursive =	true);
			$this->upload->initialize($config);
			
			if(!$this->upload->do_upload($inputFile)){	
				$data['error'] = true;
				$data['message'] = $this->upload->display_errors();	
				}
				else
				{	
					$data['error'] = false;	
					$data['fileData'] =	$this->upload->data();
				}		
			return $data;
		}

	}
?>