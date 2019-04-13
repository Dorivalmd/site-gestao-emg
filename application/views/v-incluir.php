	<?php $this->load->view('commons/header')?>
	<?php
	if(!isset($_SESSION["logged"]) && !isset($_SESSION["permissao"])) {
		redirect('User/Login');
	}
	else{
		if(($_SESSION["permissao"]) != 'S' ){
			redirect("User/Login");
		}
	}
	?>	
    <div  class="container">	
		<h5>Usuário: <?=$this->session->userdata('nome')?></h5>
		<h1 align="center" class="form-signin-heading">Inclusão de Dados</h1>
		<form action="<?=base_url('OrdemServico/inclui')?>" method="POST" class="form-incluir" enctype= "multipart/form-data" > 			
			<div class="row">
				<?php if(isset($error)){ ?>
				<div class="alert alert-danger"	role="alert">
				<?=$error?>
				</div>
				<?php } ?>
				<?php if(isset($success)){ ?>
				<div class="alert alert-success" role="alert">
				<?=$success?>
				</div>	
				<?php } ?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title">Dados Gerais</h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-md-2">
								<div class="form-group">
									<label for="os">OS Atual</label>
									<input type="text" class="form-control input-sm" id="os" name="os_atual"  autofocus required/>
								</div>					
							</fieldset>						
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="os-anterior">Os anterior</label>
									<input type="text" class="form-control input-sm" id="os-anterior" name="os_anterior" required/> 
								</div>
							</fieldset>
							<fieldset class="col-md-1">
								<div class="form-group"> 
									<label for="historico">Histórico</label>
									<input type="number" max="99" step="1"  class="form-control input-sm" id="historico" name="historico" required/>
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="data-entrada">Data de Entrada</label>
									<input type="date" class="form-control input-sm" id="data-entrada" name="data_entrada" required/>
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="status">Status</label>
									<select class="form-control input-sm" id="status" name="status" required/> 
										<option>Selecione</option>
										<option>Aguardando Pedido</option>
										<option>Sem Conserto</option> 
										<option>Concluido</option> 
										<option>Orçamento</option>
										<option>Aprovado</option> 
										<option>Não Aprovado</option>
									</select>
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="data-prazo">Prazo</label>
									<input type="text" class="form-control input-sm" id="data-prazo" name="data_prazo" />
								</div>
							</fieldset>
						</div>
					</div>
				</div>						
			</div>
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title">Dados Cliente</h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="cliente">Cliente</label>
									<input type="text" class="form-control input-sm" id="cliente" name="cliente" value="<?= $clien?>" />				
								</div>					
							</fieldset>						
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="solicitante">Solicitante</label>
									<!--<input type="text" class="form-control input-sm" id="solicitante" name="solicitante"/>--> 
									<select class="form-control input-sm" id="solicitante" name="solicitante" required/>
										<option></option>
										<?php foreach ($solicit as $solic){ ?>										
										<option><?=$solic->nome?></option> 			
										<?php } end_foreach ?>
									</select>
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="nota-fiscal">Nota Fiscal</label>
									<input type="text" class="form-control input-sm " id="nota-fiscal" name="nota_fiscal"/> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="ordem-compra">Ordem de Compra</label>
									<input type="text" class="form-control input-sm" id="ordem-compra" name="ordem_compra"/> 
								</div>	
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="num-pedido">Nº Pedido</label>
									<input type="text" class="form-control input-sm " id="num-pedido" name="num_pedido"/> 
								</div>	
							</fieldset>
						</div>
					</div>
				</div>						
			</div>
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title">Dados do Equipamento</h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-md-3">							
								<div class="form-group"> 
									<label for="equipamento">Tipo de Equipamento</label>
									<input type="text" class="form-control input-sm" id="equipamento" name="equipamento"/> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="marca">Marca</label>
									<input type="text" class="form-control input-sm " id="marca" name="marca"/>
								</div>						
							</fieldset>	
							
							<fieldset class="col-md-2">	
								<div class="form-group"> 
									<label for="modelo">Modelo</label>
									<input type="text" class="form-control input-sm" id="modelo" name="modelo"/>  
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group">
									<label for="potencia">Potencia</label>
									<input type="text" class="form-control input-sm" id="potencia" name="potencia"/> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group">
									<label for="tensao-nominal">Tensão Nominal</label>
									<input type="text" class="form-control input-sm" id="tensao-nominal" name="tensao_nominal"/> 
								</div>
							</fieldset>
						</div>	
						<div class="row">
							<fieldset class="col-md-3">
								<div class="form-group">
									<label for="setor_maquina">Setor</label>
									<input type="text" class="form-control input-sm" id="setor_maquina" name="setor_maquina"/> 
								</div>
							</fieldset>						
							<fieldset class="col-md-3">	
								<div class="form-group"> 
									<label for="num-serie">Número de Série</label>
									<input type="text" class="form-control input-sm" id="num-serie" name="num_serie"/> 
								</div>
							</fieldset>							
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="rotacao">RPM</label>
									<input type="text" class="form-control input-sm" id="rotacao" name="rotacao"/> 
								</div>
							</fieldset>	
							<fieldset class="col-md-1">
								<div class="form-group"> 
									<label for="num-polos">Polos</label>
									<input type="text" class="form-control input-sm" id="num-polos" name="num_polos"/> 
								</div>	
							</fieldset>
							<fieldset class="col-md-2">	
								<div class="form-group"> 
									<label for="corrente-nominal">Corrente Nominal</label>
									<input type="text" class="form-control input-sm" id="corrente-nominal" name="corrente_nominal"/> 
								</div>						
							</fieldset>					
						</div>
						<!-- -->
						<div class="row">
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="num_maquina">Maquina</label>
									<input type="text" class="form-control input-sm" id="num_maquina" name="num_maquina"/> 
								</div>						
							</fieldset>
							<fieldset class="col-md-1">		
								<div class="form-group"> 
									<label for="centro_custo">C.C.</label>
									<input type="text" class="form-control input-sm" id="centro_custo" name="centro_custo"/> 
								</div>						
							</fieldset>
							<fieldset class="col-md-7">
								<div class="form-group"> 
									<label for="complemento">Complemento</label>
									<textarea rows="1" class="form-control input-sm" id="complemento" name="complemento"></textarea>
								</div>
							</fieldset>
						</div>
						<!-- -->
						<div class="row">
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="causa-problema">Causa da Falha</label>
									<select class="form-control input-sm" id="causa-problema" name="causa_problema"/> 
										<option></option>
										<option>Sobreaquecimento</option>
										<option>Falta de fase</option> 
										<option>Contaminação</option> 
										<option>Baixa isolação</option>
										<option>Problema mecânico</option> 
										<option>Revisão</option>
										<option>Garantia</option>
										<option>Outros</option>
									</select>
								</div>						
							</fieldset>
							<fieldset class="col-md-8">
								<div class="form-group"> 
									<label for="descricao_falha">Descrição da Falha</label>
									<textarea rows="1" class="form-control input-sm" id="descricao_falha" name="descricao_falha"></textarea>
									<!--<input type="text" class="form-control input-sm" id="descricao_falha" name="descricao_falha"/>--> 
								</div>
							</fieldset>
						</div>
						<!-- -->
					</div>
				</div>						
			</div>
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title">Dados de Saida</h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-md-3">
								<div class="form-group">
									<label for="notafiscal_fatura">Nota Fiscal Fatura</label>
									<input type="text" class="form-control input-sm" id="notafiscal_fatura" name="notafiscal_fatura"/>
								</div>					
							</fieldset>						
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="notafiscal_retorno">Nota Fiscal Devolução</label>
									<input type="text" class="form-control input-sm" id="notafiscal_retorno" name="notafiscal_retorno"/> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="data-saida">Data de Saida</label>
									<input type="date" class="form-control input-sm" id="data-saida" name="data_saida"/> 
								</div>	
							</fieldset>
						</div>
					</div>
				</div>						
			</div>
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">TESTES</h2>
					</div>
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-md-3">					
								<div class="form-group"> 
									<label for="isolacao">Isolação</label>
									<input type="text" class="form-control input-sm" id="isolacao" name="isolacao"/>
								</div>
							</fieldset>
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="fechamento">Fechamento</label>
									<input type="text" class="form-control input-sm" id="fechamento" name="fechamento"/>  
								</div>
							</fieldset>
							<fieldset class="col-md-2"> 
								<div class="form-group"> 
									<label for="tensao-aplicada">Tensão Aplicada</label>
									<input type="text" class="form-control input-sm" id="tensao-aplicada" name="tensao_aplicada"/> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">
								<div class="form-group">
									<label for="corrente-teste">Corrente</label>
									<input type="text" class="form-control input-sm" id="corrente-teste" name="corrente_teste"/> 
								</div>	
							</fieldset>	
						</div>
						<div class="row">
							<fieldset class="col-md-12">
								<div class="form-group"> 
									<label for="observacao">Observação</label>
									<textarea class="form-control" id="observacao" name="observacao" ></textarea> 
								</div>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Imagens</h2>
					</div>	
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-md-4">					
								<div class="form-group"> 
									<label for="imagem1">Imagem 001</label>
									<input type="file" class="form-control input-sm" id="imagem1" name="imagem1"/>
								</div>
							</fieldset>
							<fieldset class="col-md-4">
								<div class="form-group"> 
									<label for="imagem2">Imagem 002</label>
									<input type="file" class="form-control input-sm" id="imagem2" name="imagem2"/>  
								</div>
							</fieldset>
							<fieldset class="col-md-4"> 
								<div class="form-group"> 
									<label for="imagem3">Imagem 003</label>
									<input type="file" class="form-control input-sm" id="imagem3" name="imagem3"/> 
								</div>
							</fieldset>			
						</div>
					</div>
				</div>
				<input type="hidden" name="id_cliente" value="<?=$idClient?>"/>	
				<input type="hidden" name="id_solicitante" value=""/>						
				<input type="submit" class="btn btn-primary butt-loc" value="Salvar"/>
				<input type="reset"  value="Limpar" class="btn btn-primary butt-loc"/>
			</div>		
		</form>	
    </div> 

