<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class OrdemServico extends CI_Controller {

		function __construct(){	
			parent::__construct();
                        $this->output->set_header('Cache-Control: post-check=0, pre-check=0');	
			$this->load->model('OrdServ_model');
			$this->load->library(array('form_validation','session'));
		}
		public function IncluiDadosPorCliente(){
			$this->load->model('Clientes_model'); //carrega model Clientes_model
			$clien = $this->Clientes_model->GetNomeClient(); //recupera dados da tabela clientestb
			$data['data'] = $clien;//envia os dados p/ o form v-incluir (campo nome do cliente)
			$data['isNumber'] = FALSE; //se for numero de nota fiscal envia informação para v-buscaListas
			$data['stat'] = FALSE;
			$data['listTitle'] = "Cliente";
			$data['metRout'] = "OrdemServico/incluiDados";
			$data['placeholder'] = "Cliente";
			$data['name'] = "cliente";
			$data['id'] = "cliente";
			$this->load->view('v-buscaListas', $data);//utiliza a view v-buscaListas para encontrar o cliente
		}
		public function incluiDados(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('cliente','Cliente','trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$this->load->model('Solicit_model'); //carrega model Solicit_model
				$this->load->model('Clientes_model'); //carrega model Clientes_model
				$clien = $this->input->post('cliente');
				$idClient = $this->Clientes_model->GetIdClient($clien);	
				$solicit = $this->Solicit_model->GetSolicByIdClient($idClient->id); //recupera dados da tabela solicitantetb
				$data['clien'] = $clien;
				$data['idClient'] = $idClient->id;
				$data['solicit'] = $solicit;//envia os dados p/ o form v-incluir (campo nome do solicitante)
				$data['error'] = null;
				$data['Title'] ="Inclusão de Dados" ;
				$this->load->view('v-incluir',$data);
			}
		}
		public function	Inclui() {
			if(!isset($_SESSION["logged"]) || (($_SESSION["permissao"]) == 'N')) {
				redirect('User/Login');
			}
			$this->form_validation->set_rules('os_atual','OS atual','required|trim|callback_os_atual_check');
			$this->form_validation->set_rules('os_anterior','OS anterior','required|trim');
			$this->form_validation->set_rules('historico','Historico','required|trim');
			$this->form_validation->set_rules('data_entrada','Data Entrada','required|trim');
			$this->form_validation->set_rules('status','Status','trim');
			$this->form_validation->set_rules('data_prazo','Prazo','trim');
			$this->form_validation->set_rules('cliente','Cliente','trim');
			$this->form_validation->set_rules('solicitante','Solicitante','trim');
			$this->form_validation->set_rules('nota_fiscal','Nota-fiscal','trim');
			$this->form_validation->set_rules('ordem_compra','Ordem-compra','trim'); // |callback_ordem_compra_check'); não está em uso
			$this->form_validation->set_rules('num_pedido','Num-pedido','trim');			
			$this->form_validation->set_rules('equipamento','Equipamento','trim');
			$this->form_validation->set_rules('marca','Marca','trim');
			$this->form_validation->set_rules('modelo','Modelo','trim');
			$this->form_validation->set_rules('num_serie','Num-serie','');
			$this->form_validation->set_rules('rotacao','Rotacao','trim');		
			$this->form_validation->set_rules('num_polos','Num-polos','trim');
			$this->form_validation->set_rules('potencia','Potencia','trim');			
			$this->form_validation->set_rules('tensao_nominal','Tensao nominal','trim');
			$this->form_validation->set_rules('corrente_nominal','Corrente-nominal','trim');			
			$this->form_validation->set_rules('isolacao','Isolacao','trim');
			$this->form_validation->set_rules('fechamento','Fechamento','trim');
			$this->form_validation->set_rules('tensao_aplicada','Tensao-aplicada','trim');
			$this->form_validation->set_rules('corrente_teste','Corrente-teste','trim');
			$this->form_validation->set_rules('data_saida','Data-saida','trim');
			$this->form_validation->set_rules('notafiscal_retorno','NF retorno','trim');
			$this->form_validation->set_rules('notafiscal_fatura','NF Fatura','trim');
			$this->form_validation->set_rules('observacao','Observacao','trim');
			$this->form_validation->set_rules('causa_problema','Causa da falha','trim');
			$this->form_validation->set_rules('descricao_falha','Descricao da falha','trim');
			$this->form_validation->set_rules('setor_maquina','Setor/Maquina','trim');
			$this->form_validation->set_rules('num_maquina','Maquina','trim');
			$this->form_validation->set_rules('complemento','Complemento','trim');	
			$this->form_validation->set_rules('id_cliente','IDCliente','trim');
			$this->form_validation->set_rules('id_solicitante','IDSolicitante','trim');
			
			if($this->form_validation->run() ==	FALSE){	
				$this->load->model('Solicit_model'); //carrega model Solicit_model
				$this->load->model('Clientes_model'); //carrega model Clientes_model
				$clien = $this->input->post('cliente');
				$idClient = $this->Clientes_model->GetIdClient($clien);			
				$solicit = $this->Solicit_model->GetSolicByIdClient($idClient->id); //recupera dados da tabela solicitantetb
				$data['clien'] = $clien;
				$data['idClient'] = $idClient->id;
				$data['solicit'] = $solicit;//envia os dados p/ o form v-incluir (campo nome do solicitante)
				$data['error'] = null;
				$data['Title'] ="Inclusão de Dados" ;
				$data['error'] = validation_errors();
				$this->load->view('v-incluir',$data);
			}	
			else{			
				$dataReg =	$this->input->post();
				$this->load->model('Solicit_model'); //carrega model Solicit_model
			    $solicit = $this->Solicit_model->GetIdSolicitante($dataReg['solicitante']);
				$dataReg['id_solicitante'] = $solicit->id;
				$res = $this->OrdServ_model->Incluir_dados($dataReg);
				$motor = $this->OrdServ_model->BuscarOs($dataReg['os_atual']);
				if($res){
					$uploadImage = $this->UploadFile('imagem1', 'imagem2','imagem3');
					if($uploadImage['error'])
					{
						$data['verificar']	= $uploadImage['message'];//Em caso de falha mudar para ['error']
					}
					$data['title'] = "Visualizar dados incluidos";
					$data['motor'] = $motor;
					$data['success'] = "DADOS DO EQUIPAMENTO INCLUIDO COM SUCESSO";
					$this->load->view('v-checkData',$data);		
				}
				else{
					$this->load->model('Solicit_model'); //carrega model Solicit_model
					$this->load->model('Clientes_model'); //carrega model Clientes_model
					$clien = $this->input->post('cliente');
					$idClient = $this->Clientes_model->GetIdClient($clien);	
					$solicit = $this->Solicit_model->GetSolicByIdClient($idClient->id); //recupera dados da tabela solicitantetb
					$data['clien'] = $clien;
					$data['idClient'] = $idClient->id;
					$data['solicit'] = $solicit;//envia os dados p/ o form v-incluir (campo nome do solicitante)
					$data['Title'] ="Inclusão de Dados" ;
					$data['error'] = "OS DADOS NÃO FORAM INCLUIDOS.";
					$this->load->view('v-incluir',$data);
				}
			}
		}
		function os_atual_check($os){
			$osExist = $this->OrdServ_model->GetOsExist($os);
			if ($osExist){
				if ($os == $osExist->os_atual){
					$this->form_validation->set_message('os_atual_check', 'NÚMERO DE OS JÁ EXISTE');
					return FALSE;
				}else{
					return TRUE;
				}
			}else{
				return TRUE;
			}
		}
		
		/* -=-=--==-=-=--==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-===--=-=-=-=-=-=-=-=-=-=-=
		
		function PostarSoImagens() {
			$data['Title'] = "Postar Imagens";
			$data['metRout'] = "OrdemServico/uploadImage";
			$data['btnSubmit'] = "OK";	
			$this->load->view('v_postarSoImagem',$data);
		}
		function uploadImage(){
			$uploadImage = $this->UploadFile('imagem1', 'imagem2','imagem3');
			if($uploadImage['error']){
				$data['Title'] = "Postar Imagens";
				$data['metRout'] = "OrdemServico/uploadImage";
				$data['btnSubmit'] = "OK";
				$data['error']	= $uploadImage['message'];
				$this->load->view('v_postarSoImagem',$data);
			}else if($uploadImage){
				$data['Title'] = "Postar Imagens";
				$data['metRout'] = "OrdemServico/uploadImage";
				$data['btnSubmit'] = "OK";
				$data['success']= "Upload realizado com sucesso";
				$this->load->view('v_postarSoImagem',$data);
			}
		}
		*/
		private	function UploadFile($inputFileA, $inputFileB, $inputFileC)
		{		
			$this->load->library('upload');
			$path =	"./uploads";
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
			
			if ((!$this->upload->do_upload($inputFileA))||(!$this->upload->do_upload($inputFileB))||(!$this->upload->do_upload($inputFileC))){	
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
		
		//-=-=-=-=-=--===-==-=-==-=-====-=-===-=-=-=====-=-=-=-=-=-==-=-==-==-==-==-=-=-=-=-=-=-=-=-==-=
		
		function PostarImagemUnica() {
			$data['Title'] = "Postar Imagem";
			$data['metRout'] = "OrdemServico/uploadImageSingle";
			$data['btnSubmit'] = "Postar";	
			$this->load->view('v_uploadImage',$data);
		}
		
		function uploadImageSingle(){
			$uploadImage = $this->UploadFileSingle('imagem1');
			if($uploadImage['error']){
				$data['Title'] = "Postar Imagens";
				$data['metRout'] = "OrdemServico/uploadImageSingle";
				$data['btnSubmit'] = "Postar";
				$data['error']	= $uploadImage['message'];
				$this->load->view('v_uploadImage',$data);
			}else if($uploadImage){
				$data['Title'] = "Postar Imagens";
				$data['metRout'] = "OrdemServico/uploadImageSingle";
				$data['btnSubmit'] = "Postar";
				$data['success']= "Upload realizado com sucesso";
				$this->load->view('v_uploadImage',$data);
			}
		}
		
		private	function UploadFileSingle($inputFile){		
			$this->load->library('upload');
			$path =	"./uploads";
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
		//=========================-==-=-=-=-=-=-=-=-=-=-=-==-==-=-=-=-=-=-=-
		
		function PostarOrcamento() {
			$data['Title'] = "Postar Orçamento";
			$data['metRout'] = "OrdemServico/postarArquivoOrcamento";
			$data['btnSubmit'] = "Postar";	
			$this->load->view('v_uploadOrcamento',$data);
		}
		function postarArquivoOrcamento(){
			$uploadOrcam = $this->UploadFileOrcamento('orcamento');
			if($uploadOrcam['error']){
				$data['Title'] = "Postar Orçamento";
				$data['metRout'] = "OrdemServico/postarArquivoOrcamento";
				$data['btnSubmit'] = "Postar";
				$data['error']	= $uploadOrcam['message'];
				$this->load->view('v_uploadOrcamento',$data);
			}else if($uploadOrcam){
				$data['Title'] = "Postar Orçamento";
				$data['metRout'] = "OrdemServico/postarArquivoOrcamento";
				$data['btnSubmit'] = "Postar";
				$data['success']= "Upload realizado com sucesso";
				$this->load->view('v_uploadOrcamento',$data);
			}
		}
		private	function UploadFileOrcamento($inputFile){		
			$this->load->library('upload');
			$path =	"./orcamentos";
			$config['upload_path'] = $path; 
			$config['allowed_types'] = 'pdf';
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
		public function Download(){
		$this->load->helper('download');
		
		// define path original do arquivo
		$arquivoPath = './orcamentos/OS__'.$_GET['id'].'.pdf';
		
		if (!is_dir($arquivoPath)){
			$os = $_GET['id'];
			$motor = $this->OrdServ_model->BuscarOs($os);
			if($motor){
				$data['title'] = "Visualizar OS atual";
				$data['motor'] = $motor;
				$data['success'] = NULL;
				$data['error']= "ESTE EQUIPAMENTO AINDA NÃO POSSUI ORÇAMENTO!";
				$this->load->view('v-checkData',$data);
			}	
		}		
		// força o download no browser
		// passando como parâmetro o path original do arquivo
		force_download($arquivoPath,null);
	}
		//======================-====-===+=============================-==-=-=-==-=
		public function buscarPorOsAnt(){
			
			$data['Title'] = "Digite a OS";
			$data['metRout'] = "OrdemServico/checarPorOsAnt";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-search', $data);
		}
		public function	checarPorOsAnt(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os_atual','OS','required|min_length[2]|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$this->load->model('Solicit_model'); //carrega model Solicit_model
				$os = $this->input->post('os_atual');
				$datOs = $this->OrdServ_model->BuscarOs($os);
				//$solicit = $this->Solicit_model->GetNomeSolicit(); //recupera dados da tabela solicitantetb
				if($datOs){
					$idClient = $this->Solicit_model->GetIdClient($datOs->cliente);
					$solicit = $this->Solicit_model->GetSolicByIdClient($idClient->id); //recupera dados da tabela solicitantetb
					$data['title'] = "Visualizar OS atual";
					$data['idClient'] = $idClient->id;
					$data['solicit'] = $solicit;//envia os dados p/ o form v-incluir (campo nome do solicitante)
					$data['datOs'] = $datOs;
					$data['success'] = "INCLUA SOMENTE OS DADOS NECESSÁRIOS";
					$data['error'] = null;
					$this->load->view('v-incluirPorOsAnt',$data);
				}
				else{
					$data['Title'] = "Digite a OS";
					$data['metRout'] = "OrdemServico/checarPorOsAnt";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "OS NÃO EXISTE";
					$this->load->view('v-search',$data);
				}
			}
		}
		public function BuscarOs(){
			$data['Title'] = "Digite a OS";
			$data['metRout'] = "OrdemServico/checarOs";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-search', $data);
		}
		
		public function	ChecarOs(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os_atual','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$os = $this->input->post('os_atual');
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor){
					$data['title'] = "Visualizar OS atual";
					$data['motor'] = $motor;
					$data['success'] = " BUSCA REALIZADA COM SUCESSO";
					$data['error'] = null;
					$this->load->view('v-checkData',$data);
				}
				else{
					$data['Title'] = "Digite a OS";
					$data['metRout'] = "OrdemServico/checarOs";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "OS NÃO EXISTE";
					$this->load->view('v-search',$data);
				}
			}
		}
		public function	ChecarOsAnt(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os-ant','Os anterior','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$osAnt = $this->input->post('os-ant');	
				$motor = $this->OrdServ_model->BuscarOsAnt($osAnt);
				if($motor){
					$data['title'] = "Visualizar OS Anterior";
					$data['motor'] = $motor;
					$data['success'] = "BUSCA REALIZADA COM SUCESSO.";
					$data['error'] = null;
					$this->load->view('v-checkData',$data);
				}
				else{
					$os =  $this->input->post('os-atual');
					$motor = $this->OrdServ_model->BuscarOs($os);
					if($motor){
					$data['title'] = "Visualizar OS atual";
					$data['motor'] = $motor;
					$data['success'] = NULL;
					$data['error']= "ESTE EQUIPAMENTO NÃO POSSUI OS ANTERIOR!";
					$this->load->view('v-checkData',$data);
					}
					
				//	$data['Title'] = "Digite a OS";
				//	$data['metRout'] = "OrdemServico/checarOs";
				//	$data['placeholder'] = "Número da OS";
				//	$data['name'] = "os_atual";
				//	$data['id'] = "os_atual";
				//	$data['error']= "OS NÃO EXISTE";
				//	$this->load->view('v-search',$data);
				}	
			}
		}
		public function	ChecarOsPost(){			
			$osAt = $_GET['id'];	
			$motor = $this->OrdServ_model->BuscarOsPost($osAt);
			if($motor){
				$data['title'] = "Visualizar OS Anterior";
				$data['motor'] = $motor;
				$data['success'] = "BUSCA REALIZADA COM SUCESSO.";
				$data['error'] = null;
				$this->load->view('v-checkData',$data);
			}
			else{				
				$motor = $this->OrdServ_model->BuscarOs($osAt);
				if($motor){
				$data['title'] = "Visualizar OS atual";
				$data['motor'] = $motor;
				$data['success'] = NULL;
				$data['error']= "ESTE EQUIPAMENTO NÃO POSSUI OS POSTERIOR!";
				$this->load->view('v-checkData',$data);					
				}	
			}
		}
		
		public function alterOs(){
			$data['Title'] = "Alterar Dados";
			$data['metRout'] = "OrdemServico/alterarOs";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	alterarOs(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os_atual','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
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
					
					$data['clien'] = $clien;//envia os dados p/ o form v-checkDataRestrict (campo nome do cliente)
					$data['solicit'] = $solicit;//envia os dados p/ o form v-checkDataRestrict (campo nome do solicitante)
					$data['Title'] = "Alterar Dados";
					$data['metRout'] = "OrdemServico/alterar";
					$data['btnSubmit'] = "Alterar";				
					$data['motor'] = $motor;
					$data['success'] = "FAÇA AS ALTERAÇÕES NECESSÁRIAS.";
					$data['error'] = null;
					$this->load->view('v-checkDataRestrict',$data);
				}
				else{
					$data['Title'] = "Alterar Dados";
					$data['metRout'] = "OrdemServico/alterarOs";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "OS NÃO EXISTE.";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		public function	alterarOsPorPageCheckData(){
			$os = $_GET['id'];
			$motor = $this->OrdServ_model->BuscarOs($os);
			if($motor){
				$this->load->model('Clientes_model'); //carrega model Clientes_model
				$this->load->model('Solicit_model'); //carrega model Solicit_model
				$clien = $this->Clientes_model->GetNomeClient(); //recupera dados da tabela clientestb
				//$solicit = $this->Solicit_model->GetNomeSolicit(); //recupera dados da tabela solicitantetb
				
				$idClient = $this->Solicit_model->GetIdClient($motor->cliente);
				$solicit = $this->Solicit_model->GetSolicByIdClient($idClient->id); //recupera dados da tabela solicitantetb
				
				$data['clien'] = $clien;//envia os dados p/ o form v-checkDataRestrict (campo nome do cliente)
				$data['solicit'] = $solicit;//envia os dados p/ o form v-checkDataRestrict (campo nome do solicitante)
				$data['Title'] = "Alterar Dados";
				$data['metRout'] = "OrdemServico/alterar";
				$data['btnSubmit'] = "Alterar";				
				$data['motor'] = $motor;
				$data['success'] = "FAÇA AS ALTERAÇÕES NECESSÁRIAS.";
				$data['error'] = null;
				$this->load->view('v-checkDataRestrict',$data);
			}
			else{
				$data['Title'] = "Alterar Dados";
				$data['metRout'] = "OrdemServico/alterarOs";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$data['error'] = "OS NÃO EXISTE.";
				$this->load->view('v-searchRestrict',$data);
			}
		}
		public function	alterar(){
			$this->form_validation->set_rules('os_atual','OS atual','required|trim');
			$this->form_validation->set_rules('os_anterior','OS anterior','required|trim');
			$this->form_validation->set_rules('historico','Historico','required|trim');
			$this->form_validation->set_rules('data_entrada','Data Entrada','required|trim');
			$this->form_validation->set_rules('status','Status','trim');
			$this->form_validation->set_rules('data_prazo','Prazo','trim');
			$this->form_validation->set_rules('cliente','Cliente','trim');
			$this->form_validation->set_rules('solicitante','Solicitante','trim');
			$this->form_validation->set_rules('nota_fiscal','Nota-fiscal','trim');
			$this->form_validation->set_rules('ordem_compra','Ordem-compra','trim'); //|callback_ordem_compra_check nâo esta em uso
			$this->form_validation->set_rules('num_pedido','Num-pedido','trim');			
			$this->form_validation->set_rules('equipamento','Equipamento','trim');
			$this->form_validation->set_rules('marca','Marca','trim');
			$this->form_validation->set_rules('modelo','Modelo','trim');
			$this->form_validation->set_rules('num_serie','Num-serie','');
			$this->form_validation->set_rules('rotacao','Rotacao','trim');		
			$this->form_validation->set_rules('num_polos','Num-polos','trim');
			$this->form_validation->set_rules('potencia','Potencia','trim');			
			$this->form_validation->set_rules('tensao_nominal','Tensao nominal','trim');
			$this->form_validation->set_rules('corrente_nominal','Corrente-nominal','trim');			
			$this->form_validation->set_rules('isolacao','Isolacao','trim');
			$this->form_validation->set_rules('fechamento','Fechamento','trim');
			$this->form_validation->set_rules('tensao_aplicada','Tensao-aplicada','trim');
			$this->form_validation->set_rules('corrente_teste','Corrente-teste','trim');
			$this->form_validation->set_rules('data_saida','Data-saida','min_length[10]|trim');
			$this->form_validation->set_rules('observacao','Observacao','trim');
			$this->form_validation->set_rules('causa_problema','Causa da falha','trim');
			$this->form_validation->set_rules('descricao_falha','Descricao da falha','trim');
			$this->form_validation->set_rules('setor_maquina','Setor/Maquina','trim');
			$this->form_validation->set_rules('num_maquina','Maquina','trim');
			$this->form_validation->set_rules('complemento','Complemento','trim');
			$this->form_validation->set_rules('id_equip','Id equip','trim');
			$this->form_validation->set_rules('notafiscal_retorno','NF retorno','trim');
			$this->form_validation->set_rules('notafiscal_fatura','NF Fatura','trim');
			$this->form_validation->set_rules('id_cliente','IDCliente','trim');

			if($this->form_validation->run() ==	FALSE){	
				
				$os = $this->input->post('os_atual');
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor){
					$this->load->model('Clientes_model'); //carrega model Clientes_model
					$this->load->model('Solicit_model'); //carrega model Solicit_model
					$clien = $this->Clientes_model->GetNomeClient(); //recupera dados da tabela clientestb
					$solicit = $this->Solicit_model->GetNomeSolicit(); //recupera dados da tabela solicitantetb
					
					$data['clien'] = $clien;//envia os dados p/ o form v-checkDataRestrict (campo nome do cliente)
					$data['solicit'] = $solicit;//envia os dados p/ o form v-checkDataRestrict (campo nome do solicitante)
					$data['Title'] = "Alterar Dados";
					$data['metRout'] = "OrdemServico/alterar";
					$data['btnSubmit'] = "Alterar";				
					$data['motor'] = $motor;
					$data['success'] = null;
					$data['error'] = validation_errors();
					$this->load->view('v-checkDataRestrict',$data);
				}
			}
			else{
				$dataReg = $this->input->post();
				$alterOS = $this->OrdServ_model->AlterarOs($dataReg);
				$motor = $this->OrdServ_model->BuscarOs($dataReg['os_atual']);
				if($alterOS){
					$data['title'] = "Alteração";
					$data['motor'] = $motor;
					$data['success'] = "ALTERAÇÃO REALIZADA COM SUCESSO.";
					$data['error'] = null;
					$this->load->view('v-checkData',$data);
				}
				else{
					$data['Title'] = "Alterar Dados";
					$data['metRout'] = "OrdemServico/alterarOs";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "ALTERAÇÃO NÃO REALIZADA.";
					$this->load->view('v-searchRestrict',$data);
				}
				
			}
		}
		/* Método não está em uso pois impede alteração de dados na view v_checkData
		function ordem_compra_check($oc){
			$ocExist = $this->OrdServ_model->GetOcExist($oc);
			if($ocExist){
				if($ocExist->ordem_compra != ""){
					if($oc == $ocExist->ordem_compra){
						$this->form_validation->set_message('ordem_compra_check', 'NÚMERO DE OC JÁ EXISTE');
						return FALSE;
					}else{
						return TRUE;
					}
				}else{
					return TRUE;
				}
			}else{
				return TRUE;
			}
		}
		*/
		//=-=-=-=-=-=-=-=-=-=-==-=-=-===-=-=-=-=-=-=-=-=-=-=-=-=-===-=-=-=-=-=-=-=-=-=-=-===-==-==
		public function	BuscaDel(){
			$data['Title'] = "Excluir Dados";
			$data['metRout'] = "OrdemServico/DeletarOs";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	DeletarOs(){
			$this->form_validation->set_rules('os_atual','OS atual','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$os = $this->input->post('os_atual');
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor){
					$data['motor'] = $motor;
					$data['success'] = "ESSES DADOS SERÃO EXCLUIDOS IRREVERSIVELMENTE.";
					$data['error'] = null;
					$this->load->view('v-checkDel',$data);
				}
				else{
					$data['Title'] = "Excluir Dados";
					$data['metRout'] = "OrdemServico/DeletarOs";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "Os não existe";
					$this->load->view('v-searchRestrict',$data);
				}
			}	
		}
		public function	DeleteOs(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os-del','Os del','required|min_length[2]|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$dataReg = $this->input->post('os-del');
				$results = $this->OrdServ_model->deletarOs($dataReg);
				if($results){
					$data['Title'] = "Excluir Dados";
					$data['metRout'] = "OrdemServico/DeletarOs";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['success'] = "EXCLUSÃO REALIZADA COM SUCESSO.";	
					$data['error'] = null;
					$this->load->view('v-searchRestrict',$data);
				}
				else{
					$data['Title'] = "Excluir Dados";
					$data['metRout'] = "OrdemServico/DeletarOs";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error'] = "DADOS NÃO EXCLUIDOS.";
					$data['success'] = null;
					$this->load->view('v-searchRestrict', $data);
				}
			}
		}
	}
?>