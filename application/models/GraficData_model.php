<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class GraficData_model extends CI_Model {
		
	function __construct(){
			parent::__construct(); 
		}
		//+++++++++++++++++++++Numero de registros por mes/Entrada++++++++
		
		function getGrafNumRegJanEnt($ano){    //Janeiro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('01', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegFevEnt($ano){    //Fevereiro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('02', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegMarEnt($ano){    //Março
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('03', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegAbrEnt($ano){    //Abril
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('04', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegMaiEnt($ano){    //Maio
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('05', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegJunEnt($ano){    //Junho
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('06', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegJulEnt($ano){    //Julho
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('07', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegAgoEnt($ano){    //Agosto
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('08', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegSetEnt($ano){    //Setembro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('09', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegOutEnt($ano){    //Outubro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('10', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegNovEnt($ano){    //Novembro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('11', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegDezEnt($ano){    //Dezembro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array('12', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		
		
		//++++++++++++++++++++++++++
		
		//+++++++++++++++++++++Numero de registros por mes/Saida++++++++
		
		function getGrafNumRegJanSai($ano){    //Janeiro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('01', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegFevSai($ano){    //Fevereiro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('02', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegMarSai($ano){    //Março
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('03', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegAbrSai($ano){    //Abril
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('04', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegMaiSai($ano){    //Maio
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('05', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegJunSai($ano){    //Junho
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('06', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegJulSai($ano){    //Julho
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('07', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegAgoSai($ano){    //Agosto
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('08', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegSetSai($ano){    //Setembro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('09', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegOutSai($ano){    //Outubro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('10', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegNovSai($ano){    //Novembro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('11', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegDezSai($ano){    //Dezembro
			//$sql = "select * from equiptb where EXTRACT(MONTH FROM created_at) = ?";
			$sql = "select * from equiptb where (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array('12', $ano));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		
		//++++++++++++++++++++++++++Numero de registros por causa da falha
		
		function getGrafNumRegSobreaquecimento(){   
			$sql = "select * from equiptb where causa_problema = ?";
			$query = $this->db->query($sql, 'Sobreaquecimento');
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegFaltaFase(){    
			$sql = "select * from equiptb where causa_problema = ?";
			$query = $this->db->query($sql, 'Falta de fase');
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegContaminacao(){    
			$sql = "select * from equiptb where causa_problema = ?";
			$query = $this->db->query($sql, 'Contaminação');
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegBaixaIsolacao(){    
			$sql = "select * from equiptb where causa_problema = ?";
			$query = $this->db->query($sql, 'Baixa isolação');
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegProblemaMecanico(){    
			$sql = "select * from equiptb where causa_problema = ?";
			$query = $this->db->query($sql, 'Problema mecânico');
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegRevisao(){    
			$sql = "select * from equiptb where causa_problema = ?";
			$query = $this->db->query($sql, 'Revisão');
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegGarantia(){    
			$sql = "select * from equiptb where status = ?";
			$query = $this->db->query($sql, 'Garantia');
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegOutros(){    
			$sql = "select * from equiptb where causa_problema = ?";
			$query = $this->db->query($sql, 'Outros');
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		
		
		//++++++++++++++++++++++++++++++++++Numero de registros por mes/cliente data Entrada
		
		function getGrafNumRegClientJanEnt($nomeClien){    //Janeiro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '01', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientFevEnt($nomeClien){    //Fevereiro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '02', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientMarEnt($nomeClien){    //Março
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '03', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientAbrEnt($nomeClien){    //Abril
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '04', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientMaiEnt($nomeClien){    //Maio
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '05', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientJunEnt($nomeClien){    //Junho
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '06', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientJulEnt($nomeClien){    //Julho
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '07', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientAgoEnt($nomeClien){    //Agosto
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '08', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientSetEnt($nomeClien){    //Setembro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '09', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientOutEnt($nomeClien){    //Outubro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '10', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientNovEnt($nomeClien){    //Novembro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '11', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientDezEnt($nomeClien){    //Dezembro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_entrada)) = ? AND (EXTRACT(YEAR FROM data_entrada)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '12', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		//++++++++++++++++++++++++++++++++++Numero de registros por mes/cliente data Saida
		
		function getGrafNumRegClientJanSai($nomeClien){    //Janeiro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '01', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientFevSai($nomeClien){    //Fevereiro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '02', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientMarSai($nomeClien){    //Março
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '03', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientAbrSai($nomeClien){    //Abril
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '04', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientMaiSai($nomeClien){    //Maio
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '05', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientJunSai($nomeClien){    //Junho
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '06', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientJulSai($nomeClien){    //Julho
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '07', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientAgoSai($nomeClien){    //Agosto
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '08', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientSetSai($nomeClien){    //Setembro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '09', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientOutSai($nomeClien){    //Outubro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '10', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientNovSai($nomeClien){    //Novembro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '11', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientDezSai($nomeClien){    //Dezembro
			$sql = "select * from equiptb where cliente = ? AND (EXTRACT(MONTH FROM data_saida)) = ? AND (EXTRACT(YEAR FROM data_saida)) = ?";
			$query = $this->db->query($sql, array($nomeClien, '12', '2017'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		//++++++++++++++++++++++++++Numero de registros por causa da falha
		
		function getGrafNumRegClientSobreaquecimento($nomeClien){   
			$sql = "select * from equiptb where cliente = ? AND causa_problema = ?";
			$query = $this->db->query($sql, array($nomeClien, 'Sobreaquecimento'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientFaltaFase($nomeClien){    
			$sql = "select * from equiptb where cliente = ? AND causa_problema = ?";
			$query = $this->db->query($sql, array($nomeClien, 'Falta de fase'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientContaminacao($nomeClien){    
			$sql = "select * from equiptb where cliente = ? AND causa_problema = ?";
			$query = $this->db->query($sql, array($nomeClien, 'Contaminação'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientBaixaIsolacao($nomeClien){    
			$sql = "select * from equiptb where cliente = ? AND causa_problema = ?";
			$query = $this->db->query($sql, array($nomeClien, 'Baixa isolação'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientProblemaMecanico($nomeClien){    
			$sql = "select * from equiptb where cliente = ? AND causa_problema = ?";
			$query = $this->db->query($sql, array($nomeClien, 'Problema mecânico'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientRevisao($nomeClien){    
			$sql = "select * from equiptb where cliente = ? AND causa_problema = ?";
			$query = $this->db->query($sql, array($nomeClien, 'Revisão'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientOutros($nomeClien){    
			$sql = "select * from equiptb where cliente = ? AND causa_problema = ?";
			$query = $this->db->query($sql, array($nomeClien, 'Outros'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function getGrafNumRegClientGarantia($nomeClien){    
			$sql = "select * from equiptb where cliente = ? AND status = ?";
			$query = $this->db->query($sql, array($nomeClien, 'Garantia'));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		
		function getStudentDetails($sessIdCliente){
			$sql = "select * from equiptb where id_cliente = ?";
			$query = $this->db->query($sql, $sessIdCliente);
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetSolicitNumRegistros($sessIdSolic){
			$sql = "select * from equiptb where id_solicitante = ?";
			$query = $this->db->query($sql, $sessIdSolic);
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetStatusNumRegistros($sessIdSolic){
			$sql = "select * from equiptb where status = ?";
			$query = $this->db->query($sql, $sessIdSolic);
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetStatusSolicNumRegistros($sessStatus, $sessNomeCliente, $sessNomeSolicit){
			$sql = "select * from equiptb where status = ? AND cliente = ? AND solicitante = ?";
			$query = $this->db->query($sql, array($sessStatus, $sessNomeCliente, $sessNomeSolicit));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetStatusUserNumRegistros($sessStatus, $sessNomeCliente){
			$sql = "select * from equiptb where status = ? AND cliente = ?";
			$query = $this->db->query($sql, array($sessStatus, $sessNomeCliente));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetNotaFiscalNumRegistros($sessNF){
			$sql = "select * from equiptb where nota_fiscal = ?";
			$query = $this->db->query($sql, $sessNF);
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetNotaFiscalDevolNumRegistros($notFisDevol){
			$sql = "select * from equiptb where notafiscal_retorno = ?";
			$query = $this->db->query($sql, $notFisDevol);
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetNumPedidoNumRegistros($numPed){
			$sql = "select * from equiptb where num_pedido = ?";
			$query = $this->db->query($sql, $numPed);
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetNumPedidoNumRegistrosUser($numPed){
			$sql = "select * from equiptb where num_pedido = ?";
			$query = $this->db->query($sql, $numPed);
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetNotaFiscalNumRegistrosUser($notFis, $sessCliente){
			$sql = "select * from equiptb where nota_fiscal = ? AND cliente = ?";
			$query = $this->db->query($sql, array($notFis, $sessCliente));
			$result	= $query->num_rows();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		
	}