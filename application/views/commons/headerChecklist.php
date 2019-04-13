<!DOCTYPE html>
<html lang="pt_BR">	
	<head>	
		<meta charset="utf-8">	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-sca le=1">
		<meta name="description" content="Eletro Mecanica Guara - Manutenção em motores eletricos, geradores, transformadores em geral">
		<meta name="author"	content="Dorival M. Andrade">
		<title>EMG Motores Eletricos</title>
		<link href="<?= base_url('assets/css/checklistStyle.css')?>" rel="stylesheet">
		<link href="<?= base_url('assets/css/bootstrap-flatly.css')?>" rel="stylesheet">
		
		
		<script type="text/javascript" src="<?= base_url('assets/js/exporting.js')?>"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!--[if lt IE 9]><script src="http://getbootstrap.com/assets/j s/ie8-responsive-file-warning.js"></script><![endif]-->	
		<script	src="https://getbootstrap.com/assets/js/ie-emulation-mo des-warning.js"></script>
		<!--[if	lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shi v.min.js"></script>	
		<script	src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	</head>
	<body>
		<nav class="navbar	navbar-default navbar-fixed-top">	
			<div class="container">		
				<div class="navbar-header">
					<button	type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">	
						<span class="sr-only">Toggle navigation</span>	
						<span class="icon-bar"></span>	
						<span class="icon-bar"></span>	
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand"	href="<?=base_url()?>">Home</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">	
					<ul	class="nav navbar-nav pull-right">
						
						<?php
							if(($this->session->userdata('logged'))&&(($this->session->userdata('permissao')== 'S'))){
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pesquisar Por <span class="caret"></span></a>
								<ul class="dropdown-menu " >
								<li><a href="<?=base_url('OrdServico')?>">Número de OS</a></li>
								<li><a href="<?=base_url('OrdCompra')?>">Número de OC</a></li>
								<li><a href="<?=base_url('NumSerie')?>">Número de Série</a></li>
	
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Listar Por <span class="caret"></span></a>
								<ul class="dropdown-menu " >
								<li><a href="<?=base_url('listarTot')?>">Todos os Registros</a></li>
								<li><a href="<?=base_url('listarClient')?>">Cliente</a></li>
								<li><a href="<?=base_url('listarClienSolic')?>">Solicitante</a></li>
								<li><a href="<?=base_url('listarNotaFisc')?>">NF Cliente</a></li>
								<li><a href="<?=base_url('listarNotaFiscDev')?>">NF Devolução</a></li>
								<li><a href="<?=base_url('listarNumPedido')?>">Nº Pedido</a>
								<li><a href="<?=base_url('listarSetor')?>">Setor</a>
								<li><a href="<?=base_url('listarMaquina')?>">Nº Máquina</a>
								<li><a href="<?=base_url('listarStatus')?>">Status</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Equipam. <span class="caret"></span></a>
								<ul class="dropdown-menu " >
								<li><a href="<?=base_url('incluirPorOsAnt')?>">Incluir por OS Ant</a></li>
								<li><a href="<?=base_url('incluirOsPorCliente')?>">Incluir Nova OS</a></li>
								<li><a href="<?=base_url('alterarOs')?>">Alterar OS</a></li>
								<li><a href="<?=base_url('DeletarOs')?>">Excluir OS</a></li>
								<li><a href="<?=base_url('listarDadosPorFiltro')?>">Buscar Dados Bob</a></li>
								<li><a href="<?=base_url('postarImagens')?>">Postar Imagens</a></li>
								<li><a href="<?=base_url('postarOrcamento')?>">Postar Orçamento</a></li>
								<li><a href="<?=base_url('incluirDadosChecklist')?>">Incluir Checklist</a></li>
								<li><a href="<?=base_url('buscarDadosChecklist')?>">Buscar Checklist</a></li>
								<li><a href="<?=base_url('deletarDadosChecklist')?>">Deletar Checklist</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Orçam. <span class="caret"></span></a>
								<ul class="dropdown-menu " >
								<li><a href="<?=base_url('incluirOrcam')?>">Incluir Orçam.</a></li>
								<li><a href="<?=base_url('buscarOrcam')?>">Pesquisar Orçam.</a></li>
								<li><a href="<?=base_url('alterarOrcam')?>">Alterar Orçam.</a></li>
								<li><a href="<?=base_url('excluirOrcam')?>">Excluir Orçam.</a></li>	
							</ul>
						</li>	
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dados/Rebob<span class="caret"></span></a>
								<ul class="dropdown-menu " >
								<li><a href="<?=base_url('incluir-dados-rebob')?>">Incluir Dados Bobinagem</a></li>
								<li><a href="<?=base_url('alterar-dados-rebob')?>">Alterar Dados de Bobinagem</a></li>
								<li><a href="<?=base_url('excluir-dados-rebob')?>">Excluir Dados de Bobinagem</a></li>
								<li><a href="<?=base_url('pesquisar-dados-rebob')?>">Pesquisar Dados de Bobinagem</a></li>
								<li><a href="<?=base_url('exportar-dados-rebob')?>">Exportar p/ pdf</a></li>		
							</ul>
						</li>		
						
						<li><a href="<?=base_url('grafico')?>">Graficos</a></li>
						<li><a href="<?=base_url('logout')?>">Sair</a></li>
						<?php
							}
							else if(($this->session->userdata('logged'))&&(($this->session->userdata('permissao')== 'N'))) {
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pesquisar por <span class="caret"></span></a>
								<ul class="dropdown-menu " >
								<li><a href="<?=base_url('ordemServUser')?>">Numero de OS</a></li>
								<li><a href="<?=base_url('ordemCompUser')?>">Numero de OC</a></li>
								<li><a href="<?=base_url('NumSerie')?>">Número de Série</a></li>
								<!--<li><a href="<?=base_url('numPedidoUser')?>">Numero do Pedido</a></li>-->
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Listar por <span class="caret"></span></a>
								<ul class="dropdown-menu " >
								<li><a href="<?=base_url('listarClientUser')?>">Todos os Registros</a></li>
								<li><a href="<?=base_url('listarSolicUser')?>">Solicitante</a></li>
								<li><a href="<?=base_url('listarNotaFiscUser')?>">NF Cliente</a></li>
								<li><a href="<?=base_url('listarNumPedidoUser')?>">Nº Pedido</a>
								<li><a href="<?=base_url('listarSetorUser')?>">Setor</a>
								<li><a href="<?=base_url('listarMaquinaUser')?>">Nº Máquina</a>
								<li><a href="<?=base_url('listarStatusUser')?>">Status</a></li>
							</ul>
						</li>
						<li><a href="<?=base_url('graficoCliente')?>">Graficos</a></li>
						<li><a href="<?=base_url('logout')?>">Sair</a></li>
						<?php
							}
							else if($this->session->userdata('logged')== false) {
						?>
						<li><a href="<?=base_url('login')?>">Login</a></li>
						<?php
							}
						?>		
					</ul>
				</div>
			</div>		
		</nav>
