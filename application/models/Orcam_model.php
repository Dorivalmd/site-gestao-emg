<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class Orcam_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}
		function IncluirItemOrcam($data){
			$this->db->insert('item_pedidotb',$data); 
			$orcamID = $this->db->insert_id();
			if($orcamID){ 
				return $this->GetItem($orcamID);
			}
			else{
				return	false;
			}
		}
		public function	GetItem($id){	
			$this->db->select('*')->from('item_pedidotb')->where('id_orcam',$id);
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
		function BuscarItemOrcam($osAt){
			$this->db->order_by('item', 'ASC');
			$this->db->select('*');
			$this->db->from('item_pedidotb');
			$this->db->where('os_atual', $osAt);
			$results = $this->db->get()->result();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function ChecarItemExist($os, $item){

			$this->db->select('item');
			$this->db->from('item_pedidotb');
			$array = array('os_atual' => $os, 'item' => $item);
			$this->db->where($array);
			$result	= $this->db->get()->row('item');
			if($result){	
				return true;	
			}
			else{
				return	false;
			}
		}
		function IncluirDadosPed($data){
			$array = array('os_atual' => $data['os_atual'], 'data_orcam' => $data['data_orcam'],'contato' => $data['contato'], 'email_contato' => $data['email_contato'],'forma_pgto' => $data['forma_pgto'], 'prazo_pgto'	=> $data['prazo_pgto'],'prazo_entrega' => $data['prazo_entrega'], 'valid_proposta'	=> $data['valid_proposta'],'garantia' => $data['garantia'], 'impostos' => $data['impostos'], 'status_orc' => $data['status_orc'], 'id_equip' => $data['id_equip'],'obs_orcam' => $data['obs_orcam'],'formato_pagina' => $data['formato_pagina']);

			$this->db->insert('pedidotb',$array); 
			$pedidoID = $this->db->insert_id();
			if($pedidoID){ 
				return $this->GetPed($pedidoID);
			}
			else{
				return	false;
			}
		}
		public function	GetPed($id){	
			$this->db->select('*')->from('pedidotb')->where('id_pedido',$id);
			$result	= $this->db->get()->result();
			if($result){	
				return	$result[0];
			}
			else{
				return	false;
			} 
		}
		function BuscarDadosPed($osAt){
			$this->db->select('*');
			$this->db->from('pedidotb');
			$this->db->where('os_atual', $osAt);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function IncluirValoresPed($data){
			$this->db->insert('valores_orcamtb',$data); 
			$valoresId = $this->db->insert_id();
			if($valoresId){ 
				return $this->GetValores($valoresId);
			}
			else{
				return	false;
			}
		}
		public function	GetValores($id){	
			$this->db->select('*')->from('valores_orcamtb')->where('id_valores',$id);
			$result	= $this->db->get()->result();
			if($result){	
				return	$result[0];
			}
			else{
				return	false;
			} 
		}


		function BuscarValoresPed($osAt){
			$this->db->select('*');
			$this->db->from('valores_orcamtb');
			$this->db->where('os_atual', $osAt);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function AlterarValoresPed($data){
			$this->db->where('os_atual', $data['os_atual']);
			$results = $this->db->update('valores_orcamtb', $data);
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function checkOsValores($os){
			$this->db->select('os_atual');
			$this->db->from('valores_orcamtb');
			$this->db->where('os_atual', $os);
			$result	= $this->db->get()->row('os_atual');
			if($result){	
				return true;	
			}
			else{
				return	false;
			}
		}
		function AlterDadosPed($data){
			$array = array('os_atual' => $data['os_atual'], 'data_orcam' => $data['data_orcam'],'contato' => $data['contato'], 'email_contato' => $data['email_contato'],'forma_pgto' => $data['forma_pgto'], 'prazo_pgto'	=> $data['prazo_pgto'],'prazo_entrega' => $data['prazo_entrega'], 'valid_proposta'	=> $data['valid_proposta'],'garantia' => $data['garantia'], 'impostos' => $data['impostos'], 'status_orc' => $data['status_orc'], 'id_equip' => $data['id_equip'],'obs_orcam' => $data['obs_orcam'],'formato_pagina' => $data['formato_pagina']);
			
			$this->db->where('os_atual', $data['os_atual']);
			$results = $this->db->update('pedidotb', $array);
			if($results){
				return	$results;
			}
			else{
				return	false;	
			}
			
		}
		function AlterCampos($data){  
			$array = array('causa_problema' => $data['causa_falha_orc'], 'descricao_falha'	=> $data['descr_falha_orc']);
			$this->db->where('os_atual', $data['os_atual']);
			$results = $this->db->update('equiptb', $array);
			if($results){
				return	$results;
			}
			else{
				return	false;	
			}
		}
		function deletarItemOrcam($os, $item){
			$array = array('os_atual' => $os, 'item' => $item);
			$results = $this->db->delete('item_pedidotb', $array); 
			
			if($results){
				return	true;
			}
			else{
				return	false;	
			}
		}
		function BuscarDadosPedido($osAtual){
			$this->db->select('*');
			$this->db->from('pedidotb');
			$this->db->where('os_atual', $osAtual);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}

		function AlterarItemOrc($data){  

			$array	=	array('item' => $data['item'], 'os_atual'	=> $data['os_atual']);
			$this->db->where($array);
			$results = $this->db->update('item_pedidotb', $data);
			if($results){
				return	$results;
			}
			else{
				return	false;	
			}
		}
		
		function BuscarValPecas($os){
			$this->db->select_sum('valor_total');
			$this->db->from('item_pedidotb');
			$array = array('os_atual' => $os, 'produto'	=> 'M01');
			$this->db->where($array);
			$result	= $this->db->get()->row('valor_total');
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		
		function BuscarValServicos($os){
			$this->db->select_sum('valor_total');
			$this->db->from('item_pedidotb');
			$array = array('os_atual' => $os, 'produto'	=> 'S01');
			$this->db->where($array);
			$result	= $this->db->get()->row('valor_total');
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}

		function BuscarSubTotal($os){
			$this->db->select_sum('valor_total');
			$this->db->from('item_pedidotb');
			$this->db->where('os_atual', $os);
			$result	= $this->db->get()->row('valor_total');
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		
		function GetOsExist($os){
			$this->db->select('os_atual');
			$this->db->from('pedidotb');
			$this->db->where('os_atual', $os);
			$result	= $this->db->get()->row('os_atual');
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function ExcluirDadosPed($os){
			$this->db->where('os_atual', $os);
			$results = $this->db->delete('pedidotb');
			if($results){
				return	true;
			}
			else{
				return	false;	
			}
		}
		function ExcluirItensPed($os){
			$this->db->where('os_atual', $os);
			$results = $this->db->delete('item_pedidotb');
			if($results){
				return	true;
			}
			else{
				return	false;	
			}
		}
		function ExcluirValoresPed($os){
			$this->db->where('os_atual', $os);
			$results = $this->db->delete('valores_orcamtb');
			if($results){
				return	true;
			}
			else{
				return	false;	
			}
		}
		
		
	}
	
?>