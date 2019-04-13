<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class Rebobinamentos_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}
		function IncluirDadosRebob($data){
			$this->db->insert('dados_bobinamentotb',$data); 
			$equipID = $this->db->insert_id();
			if($equipID){ 
				return $this->GetDadosReb($equipID);
			}
			else{
				return	false;
			}
		}
		public function	GetDadosReb($id){	
			$this->db->select('*')->from('dados_bobinamentotb')->where('id',$id);
			$result	= $this->db->get()->result();
			if($result){	
				return	$result[0];
			}
			else{
				return	false;
			} 
		}
		function GetDataRebExist($str){
			$this->db->select('*');
			$this->db->from('dados_bobinamentotb');
			$this->db->where('ord_servico', $str);
			$result	= $this->db->get()->row();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function BuscarDadosRebobin($os){
			$this->db->select('*');
			$this->db->from('dados_bobinamentotb');
			$this->db->where('ord_servico', $os);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function BuscarDadosRebobPorId($id){
			$this->db->select('*');
			$this->db->from('dados_bobinamentotb');
			$this->db->where('id', $id);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function AlterarDadosRebob($data){
			$this->db->where('id', $data['id']);
			$results = $this->db->update('dados_bobinamentotb', $data);
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function deletarDadosRebobin($data){
			$this->db->where('id', $data);
			$results = $this->db->delete('dados_bobinamentotb');
			if($results){
				return	true;
			}
			else{
				return	false;	
			}
		}
	}