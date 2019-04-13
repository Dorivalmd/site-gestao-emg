<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class OrdServ_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}
		function Incluir_dados($data){
			$this->db->insert('equiptb',$data); 
			$equipID = $this->db->insert_id();
			if($equipID){ 
				return $this->GetEquip($equipID);
			}
			else{
				return	false;
			}
		}
		public function	GetEquip($id){	
			$this->db->select('*')->from('equiptb')->where('id_equip',$id);
			$result	= $this->db->get()->result();
			if($result){	
				return	$result[0];
			}
			else{
				return	false;
			} 
		}
		function GetIdEquip($ordServ){
			$this->db->select('id_equip');
			$this->db->from('equiptb');
			$this->db->where('os_atual',$ordServ);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			}
		}
		function GetOsExist($os){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('os_atual', $os);
			$result	= $this->db->get()->row();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetOcExist($oc){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('ordem_compra', $oc);
			$result	= $this->db->get()->row();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function Get_id_cliente($nomeEmpr){
			$this->db->select('id_cliente');
			$this->db->from('equiptb');
			$this->db->where('cliente',$nomeEmpr);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			}
		}
		function BuscarPorOsAnt($osAt){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('os_atual', $osAt);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function BuscarOs($osAt){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('os_atual', $osAt);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function BuscarOsAnt($osAnt){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('os_atual', $osAnt);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function BuscarOsPost($osAt){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('os_anterior', $osAt);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function AlterarOs($data){
			$this->db->where('id_equip', $data['id_equip']);
			$results = $this->db->update('equiptb', $data);
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function Update($data){	
			$data['passw'] = password_hash($data['passw'], PASSWORD_DEFAULT);
			$this->db->where('name', $data['name']);
			$this->db->update('users', $data);
		}
		function deletarOs($data){
			$this->db->where('id_equip', $data);
			$results = $this->db->delete('equiptb');
			if($results){
				return	true;
			}
			else{
				return	false;	
			}
		}
	}
	
?>