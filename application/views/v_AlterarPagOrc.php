	<?php $this->load->view('commons/header')?> 
	<?php
		if(!isset($_SESSION["logged"]) && !isset($_SESSION["permissao"])) {
			redirect('User/Login');
		}
	?>
	<div  class="container">
		<form action="<?=base_url($metRout)?>" method="post" class="form-incluir">  			
			<!-- <h1 align="center" class="form-signin-heading"><?=$Title?></h1> -->
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
									<input type="date" class="form-control input-sm" id="data_orcam" name="data_orcam"  value="<?= $dadosPed->data_orcam?>" />
								</div>
							</fieldset>
													
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="contato">Contato</label>
									<input type="text" class="form-control input-sm" id="contato" name="contato" value="<?= $dadosPed->contato?>" /> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">							
								<div class="form-group"> 
									<label for="email_contato">Email</label>
									<input type="email" class="form-control input-sm" id="email_contato" name="email_contato" value="<?= $dadosPed->email_contato?>" /> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="forma_pgto">Forma de Pgto</label>
									<select class="form-control input-sm" id="forma_pgto" name="forma_pgto" required/> 
										<option><?= $dadosPed->forma_pgto?></option>
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
										<option><?= $dadosPed->prazo_pgto?></option>
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
									</select>
								</div>						
							</fieldset>						
							<fieldset class="col-md-2">
								
								<div class="form-group"> 
									<label for="prazo_entrega">Prazo de Entrega</label>
									<input type="text" class="form-control input-sm" id="prazo_entrega" name="prazo_entrega" value="<?= $dadosPed->prazo_entrega?>"> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">							
								<div class="form-group"> 
									<label for="valid_proposta">Validade Prop</label>
									<input type="date" class="form-control input-sm" id="valid_proposta" name="valid_proposta" value="<?= $dadosPed->valid_proposta?>"> 
								</div>
							</fieldset>
							<fieldset class="col-md-1">		
								<div class="form-group"> 
									<label for="garantia">Garantia</label>
									<input type="text" class="form-control input-sm" id="garantia" name="garantia" value="<?= $dadosPed->garantia?>" required>
								</div>						
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="impostos">Impostos</label>
									<input type="text" class="form-control input-sm" id="impostos" name="impostos" value="<?= $dadosPed->impostos?>" required>
								</div>						
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="status_orc">Status Orçam.</label>
									<select class="form-control input-sm" id="status_orc" name="status_orc" required/> 
										<option><?= $dadosPed->status_orc?></option>
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
									<select class="form-control input-sm" id="causa_falha_orc" name="causa_falha_orc"/> 
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
									
							</fieldset>
						</div>
						<!-- -->
						<div class="row">
							<fieldset class="col-md-10">
								<div class="form-group"> 
									<label for="obs_orcam">Observação</label>
									<textarea rows="1" class="form-control input-sm" id="obs_orcam" name="obs_orcam" ><?= $dadosPed->obs_orcam?></textarea>
								</div>
							</fieldset>
							<fieldset class="col-md-1">		
								<div class="form-group"> 
									<label for="formato_pagina">Formato</label>
									<select class="form-control input-sm" id="formato_pagina" name="formato_pagina"> 
										<option><?= $dadosPed->formato_pagina?></option>
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
				<input type="hidden" name="os_atual" value="<?= $motor->os_atual?>"/>
				<input type="hidden" name="id_pedido" value="<?= $dadosPed->id_pedido?>"/>
				<input type="hidden" id="id_equip" name="id_equip"  value="<?=$motor->id_equip?>" > 			
				<?php if(isset($btnSubmit)){ ?>			
					<input type="submit" class="btn btn-primary butt-loc btn-xs"  value="<?=$btnSubmit?>" >
				<?php } ?>
			</div>
		</div>
		</form>	
		<div class="panel panel-primary">
			
			<div class="panel-body">
			<?php if($itemOrcam){?>
				<table class="table table-bordered table-hover">
					<thead>
						 <tr>
						<th>Item</th>
						<th>Prod</th>
						<th>Descrição dos serviços</th>
						<th>Un</th>
						<th>Qtde</th>
						<th>Valor Unit</th>
						<th>Valor Total</th>					
					  </tr>
					</thead>
					<?php foreach($itemOrcam as $orc){?>
					
					<tbody>
						<tr>
							<td>
								<?=$orc->item?>
							</td>
							<td>
								<?=$orc->produto?>
							</td>
							<td>
								<?=$orc->descricao?>
							</td>
							<td>
								<?=$orc->unidade?>
							</td>
							<td>
								<?=$orc->quantidade?>
							</td>
							<td>
								<?=$orc->valor_unit?>
							</td>
							<td>
								<?=$orc->valor_total?>
							</td>
							<td>
								<form action="<?=base_url('Orcamentos/EditarItemOrcam')?>" method="POST">
									<input type="hidden" name="os_atual" id="os_atual" value="<?=$orc->os_atual?>"/>
									<input type="hidden" name="item" id="item" value="<?=$orc->item?>">
									<input type="hidden" name="produto" id="produto" value="<?=$orc->produto?>"/>
									<input type="hidden" name="descricao" id="descricao" value="<?=$orc->descricao?>"/>
									<input type="hidden" name="unidade" id="unidade" value="<?=$orc->unidade?>">
									<input type="hidden" name="quantidade" id="quantidade" value="<?=$orc->quantidade?>"/>
									<input type="hidden" name="valor_unit" id="valor_unit" value="<?=$orc->valor_unit?>"/>
									<input type="hidden" name="valor_total" id="valor_total" value="<?=$orc->valor_total?>"/>
									<input type="submit" class="btn	btn-success btn-block btn-xs"  value="Editar"/>
								</form>
							</td>
						</tr>
					</tbody>
					<?php } ?>
				</table>
				<form action="<?=base_url('Orcamentos/IncluirItemPedido')?>" method="POST">
					<input type="hidden" name="os_atual" id="os_atual" value="<?=$orc->os_atual?>">
					<input type="hidden" name="item" id="item" value="<?=$orc->item?>">
					<button class="btn	btn-primary btn-xs" type="submit" id="os-atual" >Continua</button>
					
					<a href="<?=base_url('Orcamentos/FinalizarPedido')?>?id=<?=$orc->os_atual?>">
						<input type="button" class="btn btn-primary butt-loc btn-xs"  value="Finalizar" >
					</a>
				</form>
				<?php }else{ ?>
				<table class="table table-bordered table-hover">
					<thead>
					 <tr>
						<th>Item</th>
						<th>Prod</th>
						<th>Descrição dos serviços</th>
						<th>Un</th>
						<th>Qtde</th>
						<th>Valor Unit</th>
						<th>Valor Total</th>					
					  </tr>
					</thead>					
					<tbody>
						<p align='center'><?=$voidList?></p>
					</tbody>
				</table>
				<form action="<?=base_url('Orcamentos/IncluirItemPedido')?>" method="POST">
					<input type="hidden" name="os_atual" id="os_atual" value="<?=$motor->os_atual?>">
					<button class="btn	btn-primary btn-xs" type="submit" id="os-atual" >Incluir Itens</button>
				</form>	
				<?php } ?>
		</div>	
	</div>
</body>
</html>