<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	class List_model extends CI_Model{
		function __construct(){
			parent::__construct(); 
		}
		function GetAllByPageTot($limit, $offset){
			$this->db->order_by('created_at', 'DESC');
			$query = $this->db->get('equiptb', $limit, $offset);
			$result	= $query->result();
			if($result){
				return	$result;	
			}
			else{
				return	false;	
			}
		}
		
		function GetAllByPageClient($clien_id, $limit, $offset){
			$this->db->order_by('os_atual', 'DESC');
			$this->db->select('*')->from('equiptb')->where('id_cliente',$clien_id)->limit($limit,$offset);
			$result	= $this->db->get()->result();
			if($result){
				return	$result;	
			}
			else{
				return	false;	
			}
		}
		
		function GetAllByPageSolicitante($solic_id, $limit, $offset){
			$this->db->order_by('os_atual', 'DESC');
			$this->db->select('*')->from('equiptb')->where('id_solicitante',$solic_id)->limit($limit,$offset);
			$result	= $this->db->get()->result();
			if($result){
				return	$result;	
			}
			else{
				return	false;	
			}
		}
		//+++++++++++++++Numero de registros das listas (contadores)+++++++++++++++++++
		
		function GetClienteNumRegistros($sessIdCliente){
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
			if($query){								//implementar esta condicional para impedir erro de operação
				$result	= $query->num_rows();		//relacionado a entrada de dados que não existem no campo
				if($result){						//
					return $result;	
				}
				else{
					return	false;
				}
			}
		}
		//------------------------Implementar em produção
		function GetSetorNumRegistros($setor){
			$sql = "select * from equiptb where setor_maquina = ?";
			$query = $this->db->query($sql, $setor);
			if($query){
				$result	= $query->num_rows();
				if($result){	
					return $result;	
				}
				else{
					return	false;
				}
			}
		}

		function GetNumMaquinaNumRegistros($numMaquina){
			$sql = "select * from equiptb where num_maquina = ?";
			$query = $this->db->query($sql, $numMaquina);
			if($query){
				$result	= $query->num_rows();
				if($result){	
					return $result;	
				}
				else{
					return	false;
				}
			}
		}

		function GetSetorUserNumRegistros($setor, $nomeCliente ){
			$sql = "select * from equiptb where setor_maquina = ? AND cliente = ?";
			$query = $this->db->query($sql, array($setor, $nomeCliente));
			if($query){
				$result	= $query->num_rows();
				if($result){	
					return $result;	
				}
				else{
					return	false;
				}
			}
		}

		function GetNumMaquinaUserNumRegistros($numMaquina, $nomeCliente){
			$sql = "select * from equiptb where num_maquina = ? AND cliente = ?";
			$query = $this->db->query($sql, array($numMaquina, $nomeCliente));
			if($query){
				$result	= $query->num_rows();
				if($result){	
					return $result;	
				}
				else{
					return	false;
				}
			}
		}

		//----------------------------
		function GetNumPedidoNumRegistrosUser($numPed){
			$sql = "select * from equiptb where num_pedido = ?";
			$query = $this->db->query($sql, $numPed);
			if($query){
				$result	= $query->num_rows();
				if($result){	
					return $result;	
				}
				else{
					return	false;
				}
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
		
		//+++++++++++++++++++++++++++++++++---------------------++++++
		function GetAllByPageNotaFiscal($notFis){
			$this->db->select('*')->from('equiptb')->Where('nota_fiscal',$notFis);
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetAllByPageNotaFiscalDev($notFisDev){
			$this->db->select('*')->from('equiptb')->Where('notafiscal_retorno',$notFisDev);
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetAllByPageNumPedido($numPed){
			$this->db->select('*')->from('equiptb')->Where('num_pedido',$numPed);
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}

		//-------------------------Implementar em produção
		
		function GetAllByPageSetor($setor, $limit, $offset){
			$this->db->order_by('os_atual', 'DESC');
			$query = $this->db->select('*')->from('equiptb')->where('setor_maquina',$setor)->limit($limit,$offset);
			if($query){
				$result	= $this->db->get()->result();
				if($result){
					return	$result;	
				}
				else{
					return	false;	
				}
			}
		}
		function GetAllByPageNumMaquina($numMaquina, $limit, $offset){
			$this->db->order_by('os_atual', 'DESC');
			$query = $this->db->select('*')->from('equiptb')->where('num_maquina',$numMaquina)->limit($limit,$offset);
			if($query){
				$result	= $this->db->get()->result();
				if($result){
					return	$result;	
				}
				else{
					return	false;	
				}
			}
		}
		
		function GetAllByPageSetorUser($setor, $nomeCliente, $limit, $offset){
			$this->db->order_by('os_atual', 'DESC');
			$array = array('setor_maquina' => $setor, 'cliente' => $nomeCliente);
			$query = $this->db->select('*')->from('equiptb')->where($array)->limit($limit,$offset);
			if($query){
				$result	= $this->db->get()->result();
				if($result){
					return	$result;	
				}
				else{
					return	false;	
				}
			}
		}
		function GetAllByPageNumMaquinaUser($numMaquina, $nomeCliente, $limit, $offset){
			$this->db->order_by('os_atual', 'DESC');
			$array = array('num_maquina' => $numMaquina, 'cliente' => $nomeCliente);
			$query = $this->db->select('*')->from('equiptb')->where($array)->limit($limit,$offset);
			if($query){
				$result	= $this->db->get()->result();
				if($result){
					return	$result;	
				}
				else{
					return	false;	
				}
			}
		}

		//-------------------------
		function GetAllByPageStatus($status, $limit, $offset){
			$this->db->order_by('os_atual', 'DESC');
			$this->db->select('*')->from('equiptb')->where('status',$status)->limit($limit,$offset);
			$result	= $this->db->get()->result();
			if($result){
				return	$result;	
			}
			else{
				return	false;	
			}
		}
		
		function GetAllByPageStatusUser($status, $nomeCliente, $limit, $offset){
			$this->db->order_by('os_atual', 'DESC');
			$array = array('status' => $status, 'cliente' => $nomeCliente);
			$this->db->select('*')->from('equiptb')->where($array)->limit($limit,$offset);
			$result	= $this->db->get()->result();
			if($result){
				return	$result;	
			}
			else{
				return	false;	
			}
		}
		
		function GetAllByPageStatusSolic($status, $cliente, $solicitante, $limit, $offset){
			$this->db->order_by('os_atual', 'DESC');
			$array = array('status' => $status, 'cliente' => $cliente, 'solicitante' => $solicitante);
			$this->db->select('*')->from('equiptb')->where($array)->limit($limit,$offset);
			$result	= $this->db->get()->result();
			if($result){
				return	$result;	
			}
			else{
				return	false;	
			}
		}
		
		function GetClienteUser($sess){
			$this->db->select('*');
			$this->db->from('equiptb');
			$this->db->where('cliente', $sess);
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}		
		function GetSolicitUser($solic, $sess){
			$this->db->select('*');
			$this->db->from('equiptb');
			$array = array('solicitante' => $solic, 'cliente' => $sess);
			$this->db->where($array);
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetNotaFiscalUser($notFis, $sess){
			$this->db->select('*');
			$this->db->from('equiptb');
			$array = array('nota_fiscal' => $notFis, 'cliente' => $sess);
			$this->db->Where($array);
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		function GetStatusUser($status, $sess){
			$this->db->select('*');
			$this->db->from('equiptb');
			$array = array('status' => $status, 'cliente' => $sess);
			$this->db->where($array);
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
		/*function GetAllByFilter($marca, $potencia, $polos){
			$this->db->order_by('os_atual', 'DESC');
			$array = array('marca' => $marca, 'potencia' => $potencia, 'num_polos' => $polos,);
			$this->db->select('*')->from('equiptb')->LIKE($array)->limit(100);
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}*/
		function GetAllByFilter($marca, $potencia, $polos){
			$this->db->order_by('os_atual', 'DESC');
			$this->db->limit(100);
			$this->db->select('*')->from('equiptb');
			$this->db->like('marca', $marca); 
			$this->db->like('potencia', $potencia, 'after');  
			$this->db->like('num_polos', $polos);  
			
			$result	= $this->db->get()->result();
			if($result){	
				return $result;	
			}
			else{
				return	false;
			}
		}
	}