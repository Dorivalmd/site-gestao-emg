<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class NumPed_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}		
		
		function BuscNumPed($numPed){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('num_pedido', $numPed);
			$results = $this->db->get()->row();
			if($results){
				return	$results;
			}
			else{
				return	false;	
			} 
		}
	}
?>