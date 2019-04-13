	<?php $this->load->view('commons/header')?> 
	<?php
		if(!isset($_SESSION["logged"]) && !isset($_SESSION["permissao"])) {
			redirect('User/Login');
		}
	?>
	<div  class="container">
		<h4>OS: <?= $motor->os_atual?></h4>		
		<form action="#" method="post" class="form-incluir">  			
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
									<input type="date" class="form-control input-sm" id="data_orcam" name="data_orcam"  value="<?= $dadosPed->data_orcam?>" disabled/>
								</div>
							</fieldset>
													
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="contato">Contato</label>
									<input type="text" class="form-control input-sm" id="contato" name="contato" value="<?= $dadosPed->contato?>" disabled/> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">							
								<div class="form-group"> 
									<label for="email_contato">Email</label>
									<input type="email" class="form-control input-sm" id="email_contato" name="email_contato" value="<?= $dadosPed->email_contato?>" disabled/> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">							
								<div class="form-group"> 
									<label for="forma_pgto">Forma de Pgto</label>
									<input type="text" class="form-control input-sm" id="forma_pgto" name="forma_pgto" value="<?= $dadosPed->forma_pgto?>" disabled/> 
								</div>
							</fieldset>
							
							
						</div>	
						<div class="row">
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="prazo_pgto">Prazo de Pgto</label>
									<input type="text" class="form-control input-sm" id="prazo_pgto" name="prazo_pgto" value="<?= $dadosPed->prazo_pgto?>" disabled>
								</div>
							</fieldset>
													
							<fieldset class="col-md-2">
								
								<div class="form-group"> 
									<label for="prazo_entrega">Prazo Entrega</label>
									<input type="text" class="form-control input-sm" id="prazo_entrega" name="prazo_entrega" value="<?= $dadosPed->prazo_entrega?>" disabled> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">							
								<div class="form-group"> 
									<label for="valid_proposta">Validade Prop</label>
									<input type="date" class="form-control input-sm" id="valid_proposta" name="valid_proposta" value="<?= $dadosPed->valid_proposta?>" disabled> 
								</div>
							</fieldset>
							<fieldset class="col-md-1">		
								<div class="form-group"> 
									<label for="garantia">Garantia</label>
									<input type="text" class="form-control input-sm" id="garantia" name="garantia" value="<?= $dadosPed->garantia?>" disabled>
								</div>						
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="impostos">Impostos</label>
									<input type="text" class="form-control input-sm" id="impostos" name="impostos" value="<?= $dadosPed->impostos?>" disabled>
								</div>						
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="status_orc">Status Orçam.</label>
									<input type="text" class="form-control input-sm" id="status_orc" name="status_orc" value="<?= $dadosPed->status_orc?>" disabled>
								</div>						
							</fieldset>
						</div>
						<!-- -->
						<div class="row">
							
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="causa_falha_orc">Causa da falha</label>
									<input type="text" class="form-control input-sm" id="causa_falha_orc" name="causa_falha_orc" value="<?= $motor->causa_problema?>" disabled>
								</div>						
							</fieldset>
							<fieldset class="col-md-8">
								<div class="form-group"> 
									<label for="descr_falha_orc">Descrição da Falha</label>
									<textarea rows="1" class="form-control input-sm" id="descr_falha_orc" name="descr_falha_orc" disabled><?= $motor->descricao_falha?></textarea>
									
							</fieldset>
						</div>
						<div class="row">
							<fieldset class="col-md-10">
								<div class="form-group"> 
									<label for="obs_orcam">Observação</label>
									<textarea rows="1" class="form-control input-sm" id="obs_orcam" name="obs_orcam" disabled><?= $dadosPed->obs_orcam?></textarea>
								</div>
							</fieldset>
							<fieldset class="col-md-1">		
								<div class="form-group"> 
									<label for="formato_pagina">Formato</label>
									<input type="text" class="form-control input-sm" id="formato_pagina" name="formato_pagina" value="<?= $dadosPed->formato_pagina?>" disabled >
								</div>
								
							</fieldset>
						</div>
						<!-- -->
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
						</tr>
					</tbody>
					<?php } ?>
				</table>
				
				<?php }else{ ?>
				<table class="table table-bordered table-hover">
					<thead>
					 <tr>
						<th>Item</th>
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
				
				<?php } ?>
		</div>	
	</div>
	<form action="<?=base_url($metRout)?>" method="POST">
			<input type="hidden" name="os_atual" id="os_atual" value="<?=$motor->os_atual?>">
			<input type="submit" class="btn btn-primary butt-loc"  value="<?=$btnSubmit?>" >
		</form>
</body>
</html>