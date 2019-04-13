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
						<h1 class="panel-title">OS: <?= $motor->os_atual?> / <?= $motor->cliente?> / <?= $motor->solicitante?></h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-md-2">							
								<div class="form-group"> 
									<label for="val_pecas">Valor Peças</label>
									<input type="text" class="form-control input-sm" id="val_pecas" name="val_pecas" value="<?= $valPecas?>" disabled > 
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="val_servicos">Valor Serviços</label>
									<input type="text" class="form-control input-sm" id="val_servicos" name="val_servicos" value="<?=$valServicos?>" disabled> 
								</div>					
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="subTotal">Sub Total</label>
									<input type="text" class="form-control input-sm" id="subTotal" name="subTotal" value="<?=$subTotal?>" disabled>
								</div>						
							</fieldset>
							<fieldset class="col-md-2">							
								<div class="form-group"> 
									<label for="acresc_percento">% Acres</label>
									<input type="text" class="form-control input-sm" id="acresc_percento" name="acresc_percento" value="<?= $acresc_percento?>" disabled> 
								</div>
							</fieldset>							
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="acresc_valor">Vlr Acresc</label>
									<input type="text" class="form-control input-sm" id="acresc_valor" name="acresc_valor" value="<?= $acresc_valor?>" disabled/>
								</div>
							</fieldset>		
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="valor_final">Valor Total</label>
									<input type="text" class="form-control input-sm" id="valor_final" name="valor_final" value="<?= $valor_final?>" disabled>
								</div>						
							</fieldset>	
						</div>	

					</div>
				</div>						
			</div>
			<input type="hidden" name="val_pecas" value="<?= $valPecas?>"/> 
			<input type="hidden" name="val_servicos" value="<?= $valServicos?>"/> 
			<input type="hidden" name="subTotal" value="<?= $subTotal?>"/> 
			<input type="hidden" name="acresc_percento" value="<?= $acresc_percento?>"/>
			<input type="hidden" name="acresc_valor" value="<?= $acresc_valor?>"/>
			<input type="hidden" name="valor_final" value="<?= $valor_final?>"/>
			<input type="hidden" name="os_atual" value="<?= $motor->os_atual?>"/>							
			<input type="hidden" id="id_equip" name="id_equip"  value="<?=$motor->id_equip?>" > 
			<input type="submit" class="btn btn-primary butt-loc"  value="<?=$btnSubmit?>" autofocus>
			<a href="<?=base_url('Orcamentos/VoltarChecarDadosOrcam')?>?os=<?=$motor->os_atual?>">
				<input type="button" class="btn btn-primary butt-loc"  value="Cancelar" >
			</a>
		</form>	
	</div>