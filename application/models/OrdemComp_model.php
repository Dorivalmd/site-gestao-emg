<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class OrdemComp_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}		
		
		function BuscOc($oc){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('ordem_compra', $oc);
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