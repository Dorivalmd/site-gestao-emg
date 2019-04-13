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
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title">Orçamento: <?= $motor->os_atual?>&nbsp;&nbsp; |&nbsp;&nbsp; Cliente: <?= $motor->cliente?> &nbsp;&nbsp;|&nbsp;&nbsp; Requisitante: <?= $motor->solicitante?> &nbsp;&nbsp;|&nbsp;&nbsp; Equipamento: <?= $motor->equipamento?></h1>
					</div>
					<div class="panel-body">
						<div class="row">
												
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="data_orcam">Data Orçamento</label>
									<input type="date" class="form-control input-sm" id="data_orcam" name="data_orcam"  value="<?= $orcam->data_orcam?>" disabled />
								</div>
							</fieldset>
													
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="contato">Contato</label>
									<input type="text" class="form-control input-sm" id="contato" name="contato" value="<?= $orcam->contato?>" disabled /> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">							
								<div class="form-group"> 
									<label for="email_contato">Email</label>
									<input type="email" class="form-control input-sm" id="email_contato" name="email_contato" value="<?= $orcam->email_contato?>" disabled /> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">							
								<div class="form-group"> 
									<label for="forma_pgto">Forma de Pgto</label>
									<input type="text" class="form-control input-sm" id="forma_pgto" name="forma_pgto" value="<?= $orcam->forma_pgto?>" disabled /> 
								</div>
							</fieldset>
							
							
						</div>	
						<div class="row">
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="prazo_pgto">Prazo de Pgto</label>
									<input type="text" class="form-control input-sm" id="prazo_pgto" name="prazo_pgto" value="<?= $orcam->prazo_pgto?>" disabled >
								</div>
							</fieldset>
													
							<fieldset class="col-md-2">
								
								<div class="form-group"> 
									<label for="prazo_entrega">Prazo de Entrega</label>
									<input type="text" class="form-control input-sm" id="prazo_entrega" name="prazo_entrega" value="<?= $orcam->prazo_entrega?>" disabled > 
								</div>
							</fieldset>
							<fieldset class="col-md-2">							
								<div class="form-group"> 
									<label for="valid_proposta">Validade Prop</label>
									<input type="text" class="form-control input-sm" id="valid_proposta" name="valid_proposta" value="<?= $orcam->valid_proposta?>" disabled > 
								</div>
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="garantia">Garantia</label>
									<input type="text" class="form-control input-sm" id="garantia" name="garantia" value="<?= $orcam->garantia?>" disabled >
								</div>						
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="impostos">Impostos</label>
									<input type="text" class="form-control input-sm" id="impostos" name="impostos" value="<?= $orcam->impostos?>" disabled >
								</div>						
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="status_orc">Status Orçam.</label>
									<input type="text" class="form-control input-sm" id="status_orc" name="status_orc" value="<?= $orcam->status_orc?>" disabled >
								</div>						
							</fieldset>
						</div>
						<!-- -->
						<div class="row">
							
							<fieldset class="col-md-3">
								<div class="form-group"> 
									<label for="causa_problema">Causa da Falha</label>
									<input type="text" class="form-control input-sm" id="causa_problema" name="causa_problema" value="<?= $motor->causa_problema?>" disabled > 
								</div>
							</fieldset>
							<fieldset class="col-md-8">
								<div class="form-group"> 
									<label for="descricao_falha">Descrição da Falha</label>
									<textarea rows="1" class="form-control input-sm" id="descricao_falha" name="descricao_falha" disabled><?= $motor->descricao_falha?></textarea>
									
							</fieldset>
						</div>
						<!-- -->
					</div>
				</div>						
			</div>
			<input type="hidden" name="os_atual" value="<?= $motor->os_atual?>"/>
			<input type="hidden" name="id_pedido" value="<?= $orcam->id_pedido?>"/>
			<input type="hidden" id="id_equip" name="id_equip"  value="<?=$motor->id_equip?>" > 			
			<input type="submit" class="btn btn-primary butt-loc"  value="<?=$btnSubmit?>" >
			<a href="<?=base_url('Orcamentos/ChecarDadosOrcamentos')?>?id=<?=$motor->os_atual?>">
				<input type="button" class="btn btn-primary butt-loc"  value="Iniciar" >
			</a>
		</form>	
	</div>