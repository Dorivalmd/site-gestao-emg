<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class Rebobinamentos extends CI_Controller {

		function __construct(){	
			parent::__construct();
                        $this->output->set_header('Cache-Control: post-check=0, pre-check=0');	
			$this->load->model('Rebobinamentos_model');
			$this->load->library(array('form_validation','session'));
		}
		public function buscaDadosRebob(){
			$data['Title'] = "Pesquisar Dados de Bobinagem";
			$data['metRout'] = "Rebobinamentos/pesquisarDadosRebob";
			$data['placeholder'] = "Número de OS";
			$data['name'] = "ord_servico";
			$data['id'] = "ord_servico";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	pesquisarDadosRebob(){
			$this->form_validation->set_rules('ord_servico','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$os = $this->input->post('ord_servico');
				$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobin($os);
				if($dadosReb){
					$data['Title'] = "";
					$data['metRout'] = "Rebobinamentos/ExportPdf";
					$data['btnSubmit'] = "Exportar p/ PDF";
					$data['rebob'] = $dadosReb;
					$data['metodoAltExclui'] = true;
					$this->load->view('v_checkRebob',$data);
				}
				else{
					$data['Title'] = "Pesquisar Dados de Bobinagem";
					$data['metRout'] = "Rebobinamentos/pesquisarDadosRebob";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "ord_servico";
					$data['id'] = "ord_servico";
					$data['error']= "DADOS NÃO ENCONTRADO";
					$this->load->view('v-searchRestrict',$data);
				}
			}	
		}
		public function	buscarDadosRebPorPageCheckData(){
			$os = $_GET['id'];
			$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobin($os);
			if($dadosReb){
				$data['Title'] = "";
				$data['metRout'] = "Rebobinamentos/ExportPdf";
				$data['btnSubmit'] = "Exportar p/ PDF";
				$data['rebob'] = $dadosReb;
				$data['metodoAltExclui'] = true;
				//$data['success'] = "";
				//$data['error'] = null;
				$this->load->view('v_checkRebob',$data);
			}
			else{
				$os = $_GET['id'];
				$this->load->model('OrdServ_model');
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor){
				$data['title'] = "Visualizar OS atual";
				$data['motor'] = $motor;
				$data['success'] = NULL;
				$data['error']= "ESTE EQUIPAMENTO NÃO POSSUI DADOS DE BOBINAGEM!";
				$this->load->view('v-checkData',$data);
				}
				
				//$data['Title'] = "Pesquisar Dados de Bobinagem";
				//$data['metRout'] = "Rebobinamentos/pesquisarDadosRebob";
				//$data['placeholder'] = "Número da OS";
				//$data['name'] = "ord_servico";
				//$data['id'] = "ord_servico";
				//$data['error']= "DADOS NÃO ENCONTRADO";
				//$this->load->view('v-searchRestrict',$data);
			}
		}			
		public function imprimeDadosRebob(){
			$data['Title'] = "Exportar para pdf";
			$data['metRout'] = "Rebobinamentos/imprimir";
			$data['placeholder'] = "Número de OS";
			$data['name'] = "ord_servico";
			$data['id'] = "ord_servico";
			$this->load->view('v-searchRestrict', $data);
		}
		public function imprimir(){ 
			$this->load->library('M_pdf');	
			$this->form_validation->set_rules('ord_servico','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$os = $this->input->post('ord_servico');
				$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobin($os);
				if($dadosReb){
					
					$data['metRout'] = "Rebobinamentos/#";
					$data['rebob'] = $dadosReb;
					//$data['error'] = null;
					$html=$this->load->view('v_pdfRebob',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.	
					$pdfFilePath ="Dados de bobinagem.pdf";		
					$pdf = $this->m_pdf->load();
					
					$stylesheet = file_get_contents('./assets/css/internas.css');

					$pdf->WriteHTML($stylesheet,1);
					$pdf->WriteHTML($html,2);
					$pdf->Output($pdfFilePath, "I");
				}
				else{
					$data['Title'] = "Exportar para pdf";
					$data['metRout'] = "Rebobinamentos/imprimir";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "ord_servico";
					$data['id'] = "ord_servico";
					$data['error']= "DADOS NÃO ENCONTRADO";
					$this->load->view('v-searchRestrict',$data);
				}
			}
			
			//$this->data['title']="MY PDF TITLE 1.";
			//$this->data['description']="";
			//$this->data['description']=$this->official_copies;
			//==================
			//this the the PDF filename that user will get to download
			//actually, you can pass mPDF parameter on this load() function	
			//generate the PDF!
			//$pdf->WriteHTML($html,2);
			//offer it to user via browser download! (The PDF won't be saved on your server HDD)
			//$pdf->Output($pdfFilePath, "D");
		}
		public function ExportPdf(){ 
			$this->load->library('M_pdf');	
			$this->form_validation->set_rules('rebob-del','ID','trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$id = $this->input->post('rebob-del');
				$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobPorId($id);
				if($dadosReb){
					
					$data['metRout'] = "Rebobinamentos/#";
					$data['rebob'] = $dadosReb;
					$html=$this->load->view('v_pdfRebob',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.	
					$pdfFilePath ="Dados de bobinagem.pdf";		
					$pdf = $this->m_pdf->load();
					
					$stylesheet = file_get_contents('./assets/css/internas.css');

					$pdf->WriteHTML($stylesheet,1);
					$pdf->WriteHTML($html,2);
					$pdf->Output($pdfFilePath, "I");
				}
				else{
					$data['Title'] = "Exportar para pdf";
					$data['metRout'] = "Rebobinamentos/imprimir";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "ord_servico";
					$data['id'] = "ord_servico";
					$data['error']= "DADOS NÃO ENCONTRADO";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		
		public function incluiDadosRebob(){
			//$data['Title'] = "Dados de Bobinagem";
			$data['metRout'] = "Rebobinamentos/incluiDadosRebobinamento";
			$data['btnSubmit'] = "Salvar";
			$data['CheckDataPage'] = false;
			$this->load->view('v_incluirRebob', $data);
		}
		public function incluiDadosRebPorCheck(){
			//$data['Title'] = "Dados de Bobinagem";
			$data['metRout'] = "Rebobinamentos/incluiDadosRebobinamento";
			$data['btnSubmit'] = "Salvar";
			$data['CheckDataPage'] = true;
			$this->load->view('v_incluirRebob', $data);
		}
		public function	IncluiDadosRebobinamento() {
			if(!isset($_SESSION["logged"]) || (($_SESSION["permissao"]) == 'N')) {
				redirect('User/Login');
			}
			$this->form_validation->set_rules('ord_servico','OS','trim|callback_ord_servico_check');
			$this->form_validation->set_rules('original','Original','trim');
			$this->form_validation->set_rules('fios_campo','Fios Campo','trim');			
			$this->form_validation->set_rules('fios_campo','Fios Campo','trim');
			$this->form_validation->set_rules('fios-aux','Fios Aux','trim');
			$this->form_validation->set_rules('canais_campo','Canais Campo','trim');	
			$this->form_validation->set_rules('canais_aux','Canais Aux','trim');
			$this->form_validation->set_rules('passo_campo','Passo Campo','trim');
			$this->form_validation->set_rules('passo_aux','Passo Aux','trim');
			$this->form_validation->set_rules('espiras_campo','Espiras Campo','trim');
			$this->form_validation->set_rules('espiras_aux','Espiras Aux','trim');
			$this->form_validation->set_rules('grupos_campo','Grupos Campo','trim');
			$this->form_validation->set_rules('grupos_aux','Grupos Aux','trim');			
			$this->form_validation->set_rules('bob_gr_campo','Bob Gr Campo','trim');
			$this->form_validation->set_rules('bob_gr_aux','Bob Gr Aux','trim');
			$this->form_validation->set_rules('ligacao_campo','Ligacao Campo','trim');
			$this->form_validation->set_rules('ligacao_aux','Ligacao Aux','trim');
			$this->form_validation->set_rules('peso_campo','Peso Campo','trim');
			$this->form_validation->set_rules('peso_aux','Peso Aux','trim');
			$this->form_validation->set_rules('observacao','Observacao','trim');
			$this->form_validation->set_rules('campo','Campo','trim');
			$this->form_validation->set_rules('auxiliar','Auxiliar','trim');
			$this->form_validation->set_rules('id_equipamento','ID Equipamento','trim');
			
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
				$data['metRout'] = "Rebobinamentos/IncluiDadosRebobinamento";
				$data['btnSubmit'] = "Salvar";
				$data['CheckDataPage'] = false;
				$this->load->view('v_incluirRebob',$data);
			}	
			else{
				$dataReg =	$this->input->post();
				$this->load->model('OrdServ_model');
				$idEquip = $this->OrdServ_model->GetIdEquip($dataReg['ord_servico']);
				if($idEquip){
					$dataReg['id_equipamento'] = $idEquip->id_equip;
				}
				$res = $this->Rebobinamentos_model->IncluirDadosRebob($dataReg);
				$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobin($dataReg['ord_servico']);
				if($res){
					//$data['Title'] = "Incluir dados de bobinagem";
					$data['metRout'] = "Rebobinamentos/ExportPdf";
					$data['btnSubmit'] = "Exportar p/ PDF";
					$data['rebob'] = $dadosReb;
					$data['metodoAltExclui'] = true;
					$data['error'] = null;
					$data['success'] = "DADOS INCLUIDO COM SUCESSO.";
					$data['CheckDataPage'] = false;
					$this->load->view('v_checkRebob',$data);
				}
				else{
					//$data['Title'] = "Cada";
					$data['metRout'] = "Rebobinamentos/IncluiDadosRebobinamento";
					$data['btnSubmit'] = "Salvar";
					$data['CheckDataPage'] = false;
					$data['error'] = "NÃO FOI POSSIVEL INCLUIR ESSES DADOS!";
					$this->load->view('v_incluirRebob',$data);
				}
			}
		}
		function ord_servico_check($str){
			$osExist = $this->Rebobinamentos_model->GetDataRebExist($str);
			if ($osExist){
				if ($str == $osExist->ord_servico){
					$this->form_validation->set_message('ord_servico_check', 'OS DADOS DESSA OS JÁ EXISTEM');
					return FALSE;
				}else{
					return TRUE;
				}
			}else{
				return TRUE;
			}
		}
		public function alterDadosRebob(){
			$data['Title'] = "Alterar Dados de Bobinagem";
			$data['metRout'] = "Rebobinamentos/alterarDadosRebob";
			$data['placeholder'] = "Número de OS";
			$data['name'] = "ord_servico";
			$data['id'] = "ord_servico";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	alterarDadosRebob(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('ord_servico','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$os = $this->input->post('ord_servico');
				$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobin($os);
				if($dadosReb){
					$data['Title'] = "Alterar Dados de Bobinagem";
					$data['metRout'] = "Rebobinamentos/alterarDadosReb";
					$data['btnSubmit'] = "Alterar";				
					$data['rebob'] = $dadosReb;
					$data['success'] = "FACA AS ALTERAÇÕES NECESSÁRIAS.";
					$data['error'] = null;
					$this->load->view('v_alterarDadosRebob',$data);
				}
				else{
					$data['Title'] = "Alterar Dados de Bobinagem";
					$data['metRout'] = "Rebobinamentos/alterarDadosRebob";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "ord_servico";
					$data['id'] = "ord_servico";
					$data['error'] = "DADOS NÃO ENCONTRADO";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		public function	alterarDadosRebPorCheck(){
			$os =  $_GET['id'];
			$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobin($os);
			if($dadosReb){
				$data['Title'] = "Alterar Dados de Bobinagem";
				$data['metRout'] = "Rebobinamentos/alterarDadosReb";
				$data['btnSubmit'] = "Alterar";				
				$data['rebob'] = $dadosReb;
				$data['success'] = "FAÇA AS ALTERAÇÕES NECESSÁRIAS.";
				$data['error'] = null;
				$this->load->view('v_alterarDadosRebob',$data);
			}
		}
		public function	alterarDadosReb() {
			if(!isset($_SESSION["logged"]) || (($_SESSION["permissao"]) == 'N')) {
				redirect('User/Login');
			}
			$this->form_validation->set_rules('ord_servico','OS','trim');
			$this->form_validation->set_rules('original','Original','trim');
			$this->form_validation->set_rules('fios_campo','Fios Campo','trim');			
			$this->form_validation->set_rules('fios_campo','Fios Campo','trim');
			$this->form_validation->set_rules('fios-aux','Fios Aux','trim');
			$this->form_validation->set_rules('canais_campo','Canais Campo','trim');	
			$this->form_validation->set_rules('canais_aux','Canais Aux','trim');
			$this->form_validation->set_rules('passo_campo','Passo Campo','trim');
			$this->form_validation->set_rules('passo_aux','Passo Aux','trim');
			$this->form_validation->set_rules('espiras_campo','Espiras Campo','trim');
			$this->form_validation->set_rules('espiras_aux','Espiras Aux','trim');
			$this->form_validation->set_rules('grupos_campo','Grupos Campo','trim');
			$this->form_validation->set_rules('grupos_aux','Grupos Aux','trim');			
			$this->form_validation->set_rules('bob_gr_campo','Bob Gr Campo','trim');
			$this->form_validation->set_rules('bob_gr_aux','Bob Gr Aux','trim');
			$this->form_validation->set_rules('ligacao_campo','Ligacao Campo','trim');
			$this->form_validation->set_rules('ligacao_aux','Ligacao Aux','trim');
			$this->form_validation->set_rules('peso_campo','Peso Campo','trim');
			$this->form_validation->set_rules('peso_aux','Peso Aux','trim');
			$this->form_validation->set_rules('observacao','Observacao','trim');
			$this->form_validation->set_rules('campo','Campo','trim');
			$this->form_validation->set_rules('auxiliar','Auxiliar','trim');
			$this->form_validation->set_rules('id','id','trim');

			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}	
			else{
				$dataReg =	$this->input->post();
				$res = $this->Rebobinamentos_model->AlterarDadosRebob($dataReg);
				$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobin($dataReg['ord_servico']);
				if($res){
					$data['Title'] = "Alterar Dados de Bobinagem";
					$data['metRout'] = "Rebobinamentos/ExportPdf";
					$data['btnSubmit'] = "Exportar p/ PDF";
					$data['rebob'] = $dadosReb;
					$data['metodoAltExclui'] = true;
					$data['error'] = null;
					$data['success'] = "DADOS ALTERADOS COM SUCESSO.";

					$this->load->view('v_checkRebob',$data);
				}
				else{
					$data['Title'] = "Alterar Cliente";
					$data['metRout'] = "Rebobinamentos/alterDadosRebob";
					$data['btnSubmit'] = "Repetir";
					$data['error'] = "NÃO FOI POSSIVEL ALTERAR ESSES DADOS!";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		public function	excluiDadosRebob(){
			$data['Title'] = "Excluir Dados de Bobinagem";
			$data['metRout'] = "Rebobinamentos/BuscarDadosRebob";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "ord_servico";
			$data['id'] = "ord_servico";
			$this->load->view('v-searchRestrict', $data);
		}
		public function	excluiDadosRebPorCheck(){
			$os = $_GET['id'];
			$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobin($os);
			if($dadosReb){
				$data['Title'] = "Excluir Dados de Bobinagem";
				$data['metRout'] = "Rebobinamentos/DeleteDadosRebob";
				$data['btnSubmit'] = "Deletar";
				$data['rebob'] = $dadosReb;
				$data['metodoAltExclui'] = false;
				$data['error'] = "ESSES DADOS SERÃO EXCLUIDOS PERMANENTEMENTE!";
				$data['success'] = null;
				$this->load->view('v_checkRebob',$data);
			}
		}
		public function	BuscarDadosRebob(){
			$this->form_validation->set_rules('ord_servico','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$os = $this->input->post('ord_servico');
				$dadosReb = $this->Rebobinamentos_model->BuscarDadosRebobin($os);
				if($dadosReb){
					$data['Title'] = "Excluir Dados de Bobinagem";
					$data['metRout'] = "Rebobinamentos/DeleteDadosRebob";
					$data['btnSubmit'] = "Deletar";
					$data['rebob'] = $dadosReb;
					$data['metodoAltExclui'] = false;
					$data['error'] = "ESSES DADOS SERÃO EXCLUIDOS PERMANENTEMENTE!";
					$data['success'] = null;
					$this->load->view('v_checkRebob',$data);
				}
				else{
					$data['Title'] = "Excluir Dados";
					$data['metRout'] = "Rebobinamentos/BuscarDadosRebob";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "ord_servico";
					$data['id'] = "ord_servico";
					$data['error']= "DADOS NÃO ENCONTRADO";
					$this->load->view('v-searchRestrict',$data);
				}
			}	
		}
		public function	DeleteDadosRebob(){
			$data['success'] = null;
			$data['error'] = null;
			$dataReg = $this->input->post('rebob-del');
			$results = $this->Rebobinamentos_model->deletarDadosRebobin($dataReg);
			if($results){
				$data['Title'] = "Excluir Dados de Bobinagem";
				$data['metRout'] = "Rebobinamentos/BuscarDadosRebob";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "ord_servico";
				$data['id'] = "ord_servico";
				$data['success'] = "DADOS EXCLUIDOS COM SUCESSO!";	
				$data['error'] = null;
				$this->load->view('v-searchRestrict',$data);
			}
			else{
				$data['Title'] = "Excluir Dados de Bobinagem";
				$data['metRout'] = "Rebobinamentos/BuscarDadosRebob";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "ord_servico";
				$data['id'] = "ord_servico";
				$data['error'] = "NÃO FOI POSSIVEL EXCLUIR ESSES DADOS!";
				$data['success'] = null;
				$this->load->view('v-searchRestrict', $data);
			}
		}
		/*public function MultSubmit(){
			switch (get_post_action('save', 'submit', 'publish')) {
				case 'save':
					//save article and keep editing
					break;

				case 'submit':
					//save article and redirect
					break;

				case 'publish':
					//publish article and redirect
					break;

				default:
					//no action sent
			}
			========================================================================
					Exemplo html para uso da função MultSubmit e da função help criada em helpers:
					
			<form method="post" action="form.php">
				<p>
					<input type="submit" name="save" value="Salvar e continuar editando" />
					<input type="submit" name="submit" value="Salvar" />
					<input type="submit" name="publish" value="Publicar" />
				</p>
			</form>
			
		}*/
	}