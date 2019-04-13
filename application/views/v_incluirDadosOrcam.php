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
		<form action="<?=base_url($metRout)?>" method="post" class="form-incluir">  			
			<h1 align="center" class="form-signin-heading"><?=$Title?></h1>
			<div class="row">
				<?php if(isset($error)){ ?>
				<div class="alert alert-danger"	role="alert">
				<?=$error?>
				</div>
				<?php } ?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title">Orçamento: <?= $motor->os_atual?>&nbsp;&nbsp; |&nbsp;&nbsp; Cliente: <?= $motor->cliente?> &nbsp;&nbsp;|&nbsp;&nbsp; Requisitante: <?= $motor->solicitante?> &nbsp;&nbsp;|&nbsp;&nbsp; Equipamento: <?= $motor->equipamento?></h1>
					</div>
					<div class="panel-body">
						<div class="row">
												
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="data_orcam">Data Orçamento</label>
									<input type="date" class="form-control input-sm" id="data_orcam" name="data_orcam"  required autofocus />
								</div>
							</fieldset>
													
							<fieldset class="col-md-3">
								
								<div class="form-group"> 
									<label for="contato">Contato</label>
									<input type="text" class="form-control input-sm" id="contato" name="contato" value="<?= $motor->solicitante?>"> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">							
								<div class="form-group"> 
									<label for="email_contato">Email</label>
									<input type="email" class="form-control input-sm" id="email_contato" name="email_contato" value="<?= $solic->email?>"> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="forma_pgto">Forma de Pgto</label>
									<select class="form-control input-sm" id="forma_pgto" name="forma_pgto" required/> 
										<option></option>
										<option>Transf. Bancaria</option>
										<option>Boleto Bancario</option> 
										<option>Depósito Bancario</option> 
										<option>Dinheiro</option> 
										<option>Cheque à Prazo</option>
										<option>Cheque à Vista</option> 
										<option>Cartão Crédito</option> 
										<option>Cartão Debito</option> 
									</select>
								</div>						
							</fieldset>
						</div>	
						<div class="row">
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="prazo_pgto">Prazo de Pgto</label>
									<select class="form-control input-sm" id="prazo_pgto" name="prazo_pgto" required/> 
										<option>10 DD</option>
										<option>15 DD</option>
										<option>21 DD</option> 
										<option>28 DD</option> 
										<option>30 DD</option>
										<option>45 DD</option> 
										<option>60 DD</option> 
										<option>28/35/42 DD</option> 
                                                                                <option>30/60 DD</option>
										<option>30/60/90 DD</option>
                                                                                <option>45/60/75 DD</option> 
										<option>15 Fora o mês</option> 
										
								</div>						
							</fieldset>						
							<fieldset class="col-md-2">
								
								<div class="form-group"> 
									<label for="prazo_entrega">Prazo de Entrega</label>
									<input type="text" class="form-control input-sm" id="prazo_entrega" name="prazo_entrega" value="A Combinar"> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">							
								<div class="form-group"> 
									<label for="valid_proposta">Validade Prop</label>
									<input type="date" class="form-control input-sm" id="valid_proposta" name="valid_proposta" value="Indeterminado"> 
								</div>
							</fieldset>
							<fieldset class="col-md-1">		
								<div class="form-group"> 
									<label for="garantia">Garantia</label>
									<input type="text" class="form-control input-sm" id="garantia" name="garantia" value="180 Dias" required>
								</div>						
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="impostos">Impostos</label>
									<input type="text" class="form-control input-sm" id="impostos" name="impostos" value="Inclusos" required>
								</div>						
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="status_orc">Status Orçam.</label>
									<select class="form-control input-sm" id="status_orc" name="status_orc" required/> 
										<option>Aguardando Aprov.</option>
										<option>Aprovado</option> 
										<option>Equip. Entregue</option> 
										<option>Pgto Realizado</option>
										<option>Cancelado</option> 
									</select>
								</div>						
							</fieldset>
						</div>
						<!-- -->
						<div class="row">
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="causa_falha_orc">Causa da Falha</label>
									<select class="form-control input-sm" id="causa_falha_orc" name="causa_falha_orc" required/> 
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
									<label for="descr_falha_orc">Descrição da Falha</label>
									<textarea rows="1" class="form-control input-sm" id="descr_falha_orc" name="descr_falha_orc" ><?= $motor->descricao_falha?></textarea>
								</div>
							</fieldset>
						</div>
						<!-- -->
						<div class="row">
							<fieldset class="col-md-10">
								<div class="form-group"> 
									<label for="obs_orcam">Observação</label>
									<textarea rows="1" class="form-control input-sm" id="obs_orcam" name="obs_orcam" ></textarea>
								</div>
							</fieldset>
							<fieldset class="col-md-1">		
								<div class="form-group"> 
									<label for="formato_pagina">Formato</label>
									<select class="form-control input-sm" id="formato_pagina" name="formato_pagina" required> 
										<option>1</option>
										<option>2</option>
										<option>3</option> 
										<option>4</option> 
									</select>
								</div>
							</fieldset>
								<a onclick="alert('Selecione o formato: \n 1 - Sem valor total e serviços \n 2 - Com valor total \n 3 - Com valor total e  serviços \n 4 - Com valor de desconto')">Help</a>
							<fieldset class="col-md-1">	
							</fieldset>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="os_atual" value="<?= $motor->os_atual?>"/>
			<input type="hidden" id="id_equip" name="id_equip"  value="<?=$motor->id_equip?>" > 			
			<input type="submit" class="btn btn-primary butt-loc"  value="<?=$btnSubmit?>" >
		</form>	
	</div>