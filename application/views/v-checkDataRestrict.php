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
		<form action="<?=base_url($metRout)?>" method="post" class="form-incluir">  			
			<h1 align="center" class="form-signin-heading"><?=$Title?></h1>
			<div class="row">
				<?php if(isset($error)){ ?>
				<div class="alert alert-danger"	role="alert">
				<?=$error?>
				</div>
				<?php } ?>
				<?php if(isset($success)){ ?>
				<div class="alert alert-danger" role="alert">
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
									<input type="text" class="form-control input-sm" id="os" name="os_atual" value="<?= $motor->os_atual?>" required/>
								</div>					
							</fieldset>						
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="os-anterior">Os anterior</label>
									<input type="text" class="form-control input-sm" id="os-anterior" name="os_anterior" value="<?= $motor->os_anterior?>" required/> 
								</div>
							</fieldset>
							<fieldset class="col-md-1">
								<div class="form-group"> 
									<label for="historico">Histórico</label>
									<input type="number" max="99" step="1"  class="form-control input-sm" id="historico" name="historico" value="<?= $motor->historico?>" required/>
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="data-entrada">Data de Entrada</label>
									<input type="date" class="form-control input-sm" id="data-entrada" name="data_entrada" value="<?= $motor->data_entrada?>" required/>
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="status">Status</label>
									<select class="form-control input-sm" id="status" name="status" required/>
										<option><?= $motor->status?></option>
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
									<input type="text" class="form-control input-sm" id="data-prazo" name="data_prazo" value="<?=$motor->data_prazo?>">
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
									<select class="form-control input-sm" id="cliente" name="cliente" required/>
										<option><?= $motor->cliente?></option>
										<?php foreach ($clien as $client){ ?>											
										<option><?=$client->nome?></option> 			
										<?php } end_foreach ?>
									</select>
								</div>					
							</fieldset>						
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="solicitante">Solicitante</label>
									<select class="form-control input-sm" id="solicitante" name="solicitante" required/>
										<option><?= $motor->solicitante?></option>
										<?php foreach ($solicit as $solic){ ?>										
										<option><?=$solic->nome?></option> 			
										<?php } end_foreach ?>
									</select>
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="nf">Nota Fiscal</label>
									<input type="text" class="form-control input-sm" id="nf" name="nota_fiscal" value="<?= $motor->nota_fiscal?>"> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="oc">Ordem de Compra</label>
									<input type="text" class="form-control input-sm" id="oc" name="ordem_compra" value="<?= $motor->ordem_compra?>"> 
								</div>	
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="numero-pedido">Nº Pedido</label>
									<input type="text" class="form-control input-sm" id="numero-pedido" name="num_pedido" value="<?= $motor->num_pedido?>"> 
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
									<input type="text" class="form-control input-sm" id="equipamento" name="equipamento"value="<?= $motor->equipamento?>"> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="marca">Marca</label>
									<input type="text" class="form-control input-sm" id="marca" name="marca" value="<?= $motor->marca?>">
								</div>						
							</fieldset>
							<fieldset class="col-md-2">	
								<div class="form-group"> 
									<label for="modelo">Modelo</label>
									<input type="text" class="form-control input-sm" id="modelo" name="modelo" value="<?= $motor->modelo?>">  
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group">
									<label for="potencia">Potencia</label>
									<input type="text" class="form-control input-sm" id="potencia" name="potencia" value="<?= $motor->potencia?>"> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group">
									<label for="tensao-nominal">Tensão Nominal</label>
									<input type="text" class="form-control input-sm" id="tensao-nominal" name="tensao_nominal" value="<?= $motor->tensao_nominal?>"> 
								</div>
							</fieldset>
						</div>	
						<div class="row">
							<fieldset class="col-md-3">
								<div class="form-group">
									<label for="setor_maquina">Setor</label>
									<input type="text" class="form-control input-sm" id="setor_maquina" name="setor_maquina" value="<?= $motor->setor_maquina?>" /> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">	
								<div class="form-group"> 
									<label for="num-serie">Número de Série</label>
									<input type="text" class="form-control input-sm" id="num-serie" name="num_serie"value="<?= $motor->num_serie?>"> 
								</div>
							</fieldset>							
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="rotacao">RPM</label>
									<input type="text" class="form-control input-sm" id="rotacao" name="rotacao" value="<?= $motor->rotacao?>"> 
								</div>
							</fieldset>
							<fieldset class="col-md-1">
								<div class="form-group"> 
									<label for="polos">Polos</label>
									<input type="text" class="form-control input-sm" id="polos" name="num_polos" value="<?= $motor->num_polos?>"> 
								</div>	
							</fieldset>
							<fieldset class="col-md-2">	
								<div class="form-group"> 
									<label for="corrente-nominal">Corrente Nominal</label>
									<input type="text" class="form-control input-sm" id="corrente-nominal" name="corrente_nominal" value="<?= $motor->corrente_nominal?>"> 
								</div>						
							</fieldset>					
						</div>
						<!-- -->
						<div class="row">
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="num_maquina">Maquina</label>
									<input type="text" class="form-control input-sm" id="num_maquina" name="num_maquina" value="<?=$motor->num_maquina?>"/> 
								</div>						
							</fieldset>
							<fieldset class="col-md-1">		
								<div class="form-group"> 
									<label for="centro_custo">C.C.</label>
									<input type="text" class="form-control input-sm" id="centro_custo" name="centro_custo" value="<?=$motor->centro_custo?>"/> 
								</div>						
							</fieldset>
							<fieldset class="col-md-7">
								<div class="form-group"> 
									<label for="complemento">Complemento</label>
									<textarea rows="1" class="form-control input-sm" id="complemento" name="complemento"><?=$motor->complemento?></textarea>
								</div>
							</fieldset>
						</div>
						<!-- -->
						<div class="row">
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="casa-problema">Causa da Falha</label>
									<select class="form-control input-sm" id="causa-problema" name="causa_problema"/> 
										<option><?= $motor->causa_problema?></option>
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
									<textarea rows="1" class="form-control input-sm" id="descricao_falha" name="descricao_falha" ><?= $motor->descricao_falha?></textarea>
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
									<input type="text" class="form-control input-sm" id="notafiscal_fatura" name="notafiscal_fatura" value="<?= $motor->notafiscal_fatura?>" >
								</div>					
							</fieldset>						
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="notafiscal_retorno">Nota Fiscal Devolução</label>
									<input type="text" class="form-control input-sm" id="notafiscal_retorno" name="notafiscal_retorno" value="<?= $motor->notafiscal_retorno?>" > 
								</div>
							</fieldset>
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="data-saida">Data de Saida</label>
									<input type="date" class="form-control input-sm" id="data-saida" name="data_saida" value="<?= $motor->data_saida?>" > 
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
						<fieldset class="col-md-3">					
							<div class="form-group"> 
								<label for="isolacao">Isolação</label>
								<input type="text" class="form-control input-sm" id="isolacao" name="isolacao" value="<?= $motor->isolacao?>">
							</div>
						</fieldset>
						<fieldset class="col-md-3">
							<div class="form-group"> 
								<label for="fechamento">Fechamento</label>
								<input type="text" class="form-control input-sm" id="fechamento" name="fechamento" value="<?= $motor->fechamento?>">  
							</div>
						</fieldset>
						<fieldset class="col-md-3"> 
							<div class="form-group"> 
								<label for="tensao-aplicada">Tensão Aplicada</label>
								<input type="text" class="form-control input-sm" id="tensao-aplicada" name="tensao_aplicada" value="<?= $motor->tensao_aplicada?>"> 
							</div>
						</fieldset>
						<fieldset class="col-md-3">
							<div class="form-group">
								<label for="corrente-teste">Corrente por Fase</label>
								<input type="text" class="form-control input-sm" id="corrente-teste" name="corrente_teste" value="<?= $motor->corrente_teste?>"> 
							</div>	
						</fieldset>
						<fieldset class="col-md-12">
							<div class="form-group"> 
								<label for="observacao">Observação</label>
								<textarea class="form-control" id="observacao" name="observacao"><?= $motor->observacao?></textarea> 
							</div>
						</fieldset>
					</div>
				</div>
			</div>
			<input type="hidden" name="id_cliente" value="<?= $motor->id_cliente?>"/>							
			<input type="hidden" id="id_equip" name="id_equip"  value="<?=$motor->id_equip?>" > 			
			<input type="submit" class="btn btn-primary butt-loc"  value="<?=$btnSubmit?>" >
		</form>	
	</div>