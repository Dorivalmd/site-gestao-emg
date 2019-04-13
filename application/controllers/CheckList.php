<?php
	defined('BASEPATH')	OR exit('No	direct script access allowed');
	class CheckList extends CI_Controller {

		function __construct(){	
			parent::__construct();
                        $this->output->set_header('Cache-Control: post-check=0, pre-check=0');	
			$this->load->model(array('CheckList_model','OrdServ_model'));
			$this->load->library(array('form_validation','session'));
		}
		public function BuscarOsChecklist(){
			$data['Title'] = "Incluir Check List";
			$data['metRout'] = "CheckList/buscarDadosChecklist";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-searchRestrict', $data);
		}

		public function	buscarDadosChecklist(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os_atual','OS','required|trim|callback_ord_servico_check');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
				$data['Title'] = "Incluir Check List";
				$data['metRout'] = "CheckList/buscarDadosChecklist";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict',$data);
			}
			else{
				$os = $this->input->post('os_atual');
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor){
					$data['title'] = "CHECK LIST";
					$data['motor'] = $motor;
					$data['success'] = " BUSCA REALIZADA COM SUCESSO";
					$data['error'] = null;
					$this->load->view('v_incluirCheckList',$data);
				}
				else{
					$data['Title'] = "Incluir Check List";
					$data['metRout'] = "CheckList/buscarDadosChecklist";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "OS NÃO EXISTE";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}

		public function	SalvarDadosChecklist() {
			if(!isset($_SESSION["logged"]) || (($_SESSION["permissao"]) == 'N')) {
				redirect('User/Login');
			}

			$this->form_validation->set_rules('id_equip','Id_equip');
			$this->form_validation->set_rules('ord_servico','OS','callback_ord_servico_check');
			
			
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
				$data['Title'] = "Incluir Check List";
				$data['metRout'] = "CheckList/buscarDadosChecklist";
				$data['placeholder'] = "Número da OS";
				$data['name'] = "os_atual";
				$data['id'] = "os_atual";
				$this->load->view('v-searchRestrict',$data);
			}	
			else{
				
				$checkPecas = $this->input->post();
				$os_Checkl = $checkPecas['ord_servico'];

				$res = $this->CheckList_model->IncluirDadosChecklist($checkPecas);

				$dadosChecklist = $this->CheckList_model->BuscarDadosChecklist($os_Checkl);
				$motor = $this->OrdServ_model->BuscarOs($os_Checkl);
				if($res && $dadosChecklist && $motor ){
					$data['Title'] = "Check List";
					$data['metRout'] = "CheckList/ExportPdf";
					$data['btnSubmit'] = "Exportar p/ PDF";
					$data['motor'] = $motor;
					$data['checkl'] = $dadosChecklist;
					//$data['metodoAltExclui'] = true;
					$data['error'] = null;

					$data['success'] = "DADOS INCLUIDO COM SUCESSO.";
					$data['CheckDataPage'] = false;
					$this->load->view('v_checarPageChecklist',$data);
				}
				else{
					$data['Title'] = "Incluir Check List";
					$data['metRout'] = "CheckList/buscarDadosChecklist";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "NÃO FOI POSSIVEL SALVAR ESSE CHECKLIST";
					$this->load->view('v-searchRestrict',$data);

				}
			}
		}
		public function ord_servico_check($str){
			$osExist = $this->CheckList_model->GetDataChecklistExist($str);
			if ($osExist){
				if ($str == $osExist->ord_servico){
					$this->form_validation->set_message('ord_servico_check', 'O CHECKLIST DESSA OS JÁ EXISTE');
					return FALSE;
				}else{
					return TRUE;
				}
			}else{
				return TRUE;
			}
		}

		public function BuscarOsChecklistCompleto(){
			$data['Title'] = "Digite a OS";
			$data['metRout'] = "CheckList/buscarDadosChecklistCompleto";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-searchRestrict', $data);
		}

		public function	buscarDadosChecklistCompleto(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os_atual','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$os = $this->input->post('os_atual');
				$dadosChecklist = $this->CheckList_model->BuscarDadosChecklist($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor && $dadosChecklist ){

					$data['Title'] = "Check List";
					//$data['metRout'] = "CheckList/ExportPdf";
					//$data['btnSubmit'] = "Exportar p/ PDF";
					$data['motor'] = $motor;
					$data['checkl'] = $dadosChecklist;
					//$data['metodoAltExclui'] = true;
					$data['error'] = null;

					$data['success'] = "BUSCA REALIZADA COM SUCESSO.";
					$data['CheckDataPage'] = false;
					$this->load->view('v_checarPageChecklist',$data);
				}
				else{
					$data['Title'] = "Digite a OS";
					$data['metRout'] = "CheckList/buscarDadosChecklistCompleto";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "ESTA OS NÃO POSSUI CHECKLIST";
					$this->load->view('v-search',$data);
				}
			}
		}
		
		public function	buscarDadosChecklistMaxion(){
			$os = $_GET['id'];
			
				$dadosChecklist = $this->CheckList_model->BuscarDadosChecklist($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor && $dadosChecklist ){

					$data['Title'] = "Check List";
					//$data['metRout'] = "CheckList/ExportPdf";
					//$data['btnSubmit'] = "Exportar p/ PDF";
					$data['motor'] = $motor;
					$data['checkl'] = $dadosChecklist;
					//$data['metodoAltExclui'] = true;
					$data['error'] = null;

					$data['success'] = "BUSCA REALIZADA COM SUCESSO.";
					$data['CheckDataPage'] = false;
					$this->load->view('v_checarPageChecklist',$data);
				}
				else{
					$data['Title'] = "Digite outra OS";
					$data['metRout'] = "CheckList/buscarDadosChecklistCompleto";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "ESTA OS NÃO POSSUI CHECKLIST";
					$this->load->view('v-search',$data);
				}
			}

		public function BuscarOsChecklistDeletar(){
			$data['Title'] = "Deletar Checklist";
			$data['metRout'] = "CheckList/buscarDadosChecklistDeletar";
			$data['placeholder'] = "Número da OS";
			$data['name'] = "os_atual";
			$data['id'] = "os_atual";
			$this->load->view('v-searchRestrict', $data);
		}

		public function	buscarDadosChecklistDeletar(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('os_atual','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$os = $this->input->post('os_atual');
				$dadosChecklist = $this->CheckList_model->BuscarDadosChecklist($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor && $dadosChecklist ){

					$data['Title'] = "Check List";
					
					$data['motor'] = $motor;
					$data['checkl'] = $dadosChecklist;
					//$data['metodoAltExclui'] = true;
					$data['error'] = null;

					$data['success'] = "BUSCA REALIZADA COM SUCESSO.";
					$data['CheckDataPage'] = false;
					$this->load->view('v_deletarChecklist',$data);
				}
				else{
					$data['Title'] = "Deletar Checklist";
					$data['metRout'] = "CheckList/buscarDadosChecklistDeletar";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "ESTA OS NÃO POSSUI CHECKLIST";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}

		public function	DeletarChecklist(){
			$data['success'] = null;
			$data['error'] = null;
			$this->form_validation->set_rules('ord_servico','OS','required|trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$ordServ = $this->input->post('ord_servico');

				$dadosCheclDel = $this->CheckList_model->DeletarDadosChecklist($ordServ);
				
				if($dadosCheclDel ){

					$data['Title'] = "Deletar Checklist";
					$data['metRout'] = "CheckList/buscarDadosChecklistDeletar";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "CHECKLIST DELETADO COM SUCESSO";
					$this->load->view('v-searchRestrict',$data);
				}
				else{
					$data['Title'] = "Digite a OS";
					$data['metRout'] = "CheckList/buscarDadosChecklistDeletar";
					$data['placeholder'] = "Número da OS";
					$data['name'] = "os_atual";
					$data['id'] = "os_atual";
					$data['error']= "NÃO FOI POSSIVEL DELETAR ESSE CHECKLIST";
					$this->load->view('v-searchRestrict',$data);
				}
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
			
		public function ExportPdfPage(){ 
			$this->load->library('M_pdf');	
			$this->form_validation->set_rules('Checklist','ID','trim');
			if($this->form_validation->run() ==	FALSE){	
				$data['error'] = validation_errors();
			}
			else{
				$os = $this->input->post('Checklist');
				$dadosChecklist = $this->CheckList_model->BuscarDadosChecklist($os);
				$motor = $this->OrdServ_model->BuscarOs($os);
				if($motor && $dadosChecklist ){
					
					$data['metRout'] = "CheckList/#";
					$data['motor'] = $motor;
					$data['checkl'] = $dadosChecklist;
					$html=$this->load->view('v_checklistPDF',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.	
					$pdfFilePath ="CheckList os: $os.pdf";		
					$pdf = $this->m_pdf->load();
					
					$stylesheet = file_get_contents('./assets/css/checklistStyle.css');

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
					$data['error']= "NÃO FOI POSSIVEL EXPORTAR CHECKLIST";
					$this->load->view('v-searchRestrict',$data);
				}
			}
		}
		
	}
?>