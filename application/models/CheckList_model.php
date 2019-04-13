<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class CheckList_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}

	function IncluirDadosChecklist($data){
    		
   			$this->db->insert('checklisttb', $data);

			$checklistID = $this->db->insert_id();
			if($checklistID){ 
				return $this->GetDadosChecklist($checklistID);
			}
			else{
				return	false;
			}
		
		}
		function GetDadosChecklist($id){	
			$this->db->select('*')->from('checklisttb')->where('id_checklist',$id);
			$result	= $this->db->get()->result();
			if($result){	
				return	$result[0];
			}
			else{
				return	false;
			} 
		}

		function GetDataChecklistExist($str){
			$this->db->select('*');
			$this->db->from('checklisttb');
			$this->db->where('ord_servico', $str);
			$result	= $this->db->get()->row();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function BuscarDadosChecklist($os){
			$this->db->select('*');
			$this->db->from('checklisttb');
			$this->db->where('ord_servico', $os);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function BuscarDadosChecklistPorId($id){
			$this->db->select('*');
			$this->db->from('checklisttb');
			$this->db->where('id_equip', $id);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}

		
		function DeletarDadosChecklist($ordServ){
			$this->db->where('ord_servico', $ordServ);
			$results = $this->db->delete('checklisttb');
			if($results){
				return	true;
			}
			else{
				return	false;	
			}
		}


	}
?>