<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class PesqEquipUser_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}
		function BuscarOsUser($osAt, $sess){
			$this->db->select('*');
			$this->db->from('equiptb');
			$array = array('os_atual' => $osAt, 'cliente' => $sess);
			$this->db->where($array);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function BuscarOcUser($ordComp, $sess){
			$this->db->select('*');
			$this->db->from('equiptb');
			$array = array('ordem_compra' => $ordComp, 'cliente' => $sess);
			$this->db->where($array);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
		function BuscarNumPedidoUser($numPed, $session){
			$this->db->select('*');
			$this->db->from('equiptb');
			$array = array('num_pedido' => $numPed, 'cliente' => $session);
			$this->db->where($array);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
	}
	