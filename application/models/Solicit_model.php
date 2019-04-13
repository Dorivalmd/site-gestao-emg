<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class Solicit_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}
		function IncluirSolicit($data){
			$this->db->insert('solicitantetb',$data); 
			$equipID = $this->db->insert_id();
			if($equipID){ 
				return $this->GetSolicit($equipID);
			}
			else{
				return	false;
			}
		}
		public function	GetSolicByIdClient($idClient){	
			$this->db->select('*')->from('solicitantetb')->where('id_cliente',$idClient);
			$result	= $this->db->get()->result();
			if($result){	
				return	$result;
			}
			else{
				return	false;
			} 
		}
		public function	GetSolicit($id){	
			$this->db->select('*')->from('solicitantetb')->where('id',$id);
			$result	= $this->db->get()->result();
			if($result){	
				return	$result[0];
			}
			else{
				return	false;
			} 
		}
		public function	GetEmailSolic($nomeSolicit){	
			$this->db->select('*')->from('solicitantetb')->where('nome',$nomeSolicit);
			$result	= $this->db->get()->row();
			if($result){	
				return	$result;
			}
			else{
				return	false;
			} 
		}
		function GetNomeSolicit(){
			$this->db->select('nome')->from('solicitantetb');
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetIdClient($nomeEmpr){
			$this->db->select('id');
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
		function GetIdSolicitante($nomeSolic){
			$this->db->select('*');
			$this->db->from('solicitantetb');
			$this->db->where('nome',$nomeSolic);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			}
		}
		function GetNomeByClient($sess){
			$this->db->select('nome');
			$this->db->from('solicitantetb');
			$this->db->where('empresa',$sess);
			$results = $this->db->get()->result();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			}
		}
		function BuscarSolicit($nome){
			$this->db->select('*');
			$this->db->from('solicitantetb');
			$this->db->where('nome', $nome);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function AlterarSolicit($data){
			$this->db->where('id', $data['id']);
			$results = $this->db->update('solicitantetb', $data);
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function deletarSolicit($data){
			$this->db->where('id', $data);
			$results = $this->db->delete('solicitantetb');
			if($results){
				return	true;
			}
			else{
				return	false;	
			}
		}
		/*function GetAllSolicit(){
			$this->db->select('*')->from('solicitantetb');
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}*/
		function GetAllSolicit($limit, $offset){
			$this->db->order_by('empresa', 'ASC');
			$query = $this->db->get('solicitantetb', $limit, $offset);
			$result	= $query->result();
			if($result){
				return	$result;	
			}
			else{
				return	false;	
			}
		}
		function GetSolicitNumRegistros(){
			$sql = "select * from solicitantetb";
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