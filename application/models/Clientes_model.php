<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class Clientes_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}
		function IncluirCliente($data){
			$this->db->insert('clientestb',$data); 
			$equipID = $this->db->insert_id();
			if($equipID){ 
				return $this->GetClient($equipID);
			}
			else{
				return	false;
			}
		}
		public function	GetClient($id){	
			$this->db->select('*')->from('clientestb')->where('id',$id);
			$result	= $this->db->get()->result();
			if($result){	
				return	$result[0];
			}
			else{
				return	false;
			} 
		}
		function GetNomeClient(){
			$this->db->order_by('nome', 'ASC');
			$this->db->select('*')->from('clientestb');
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function BuscarClient($nome){
			$this->db->select('*');
			$this->db->from('clientestb');
			$this->db->where('nome', $nome);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function GetIdClient($nomeEmpr){
			$this->db->select('*');
			$this->db->from('clientestb');
			$this->db->where('nome',$nomeEmpr);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			}
		}
		function AlterarClient($data){
			$this->db->where('id', $data['id']);
			$results = $this->db->update('clientestb', $data);
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function deletarClient($data){
			$this->db->where('id', $data);
			$results = $this->db->delete('clientestb');
			if($results){
				return	true;
			}
			else{
				return	false;	
			}
		}
		function GetAllClient(){
			$this->db->order_by('nome', 'ASC');
			$this->db->select('*')->from('clientestb');
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetClienttNumRegistros(){
			$sql = "select * from clientestb";
			$query = $this->db->query($sql);
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
	}