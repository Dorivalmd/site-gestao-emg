<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class NumSer_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}		
		
		function BuscNumSerie($numSer){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('num_serie', $numSer);
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