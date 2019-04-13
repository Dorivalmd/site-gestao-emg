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
									<input type="number" class="form-control input-sm" id="val_pecas" name="val_pecas" value="<?= $valPecas?>" disabled> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="val_servicos">Valor Serviços</label>
									<input type="number" align="right" class="form-control input-sm" id="val_servicos" name="val_servicos" value="<?=$valServicos?>" disabled> 
								</div>					
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="SubTotal">Sub Total</label>
									<input type="number" class="form-control input-sm" id="SubTotal" name="SubTotal" value="<?=$subTotal?>" disabled >
								</div>						
							</fieldset>
							<fieldset class="col-md-1">							
								<div class="form-group"> 
									<label for="desc_percento">% Desc</label>
									<input type="number" min="0" max="100" step="5" class="form-control input-sm" id="desc_percento" name="desc_percento" autofocus> 
								</div>
							</fieldset>							
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="desc_valor">Vlr Desc</label>
									<input type="text" class="form-control input-sm" id="desc_valor" name="desc_valor" />
								</div>
							</fieldset>	
							<fieldset class="col-md-1">							
								<div class="form-group"> 
									<label for="acresc_percento">% Acres</label>
									<input type="number" min="0" max="100" step="5" class="form-control input-sm" id="acresc_percento" name="acresc_percento" > 
								</div>
							</fieldset>		
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="acresc_valor">Vlr Acresc</label>
									<input type="text" class="form-control input-sm" id="acresc_valor" name="acresc_valor" />
								</div>
							</fieldset>	
						</div>	

					</div>
				</div>						
			</div>
			<input type="hidden" name="val_pecas" value="<?=$valPecas?>"/>
			<input type="hidden" name="val_servicos" value="<?=$valServicos?>"/>
			<input type="hidden" name="SubTotal" value="<?=$subTotal?>"/>
			<input type="hidden" name="os_atual" value="<?= $motor->os_atual?>"/>							
			<input type="hidden" id="id_equip" name="id_equip"  value="<?=$motor->id_equip?>" > 
			<input type="submit" class="btn btn-primary butt-loc"  value="<?=$btnSubmit?>" >
			<a href="<?=base_url('Orcamentos/VoltarChecarDadosOrcam')?>?os=<?=$motor->os_atual?>">
				<input type="button" class="btn btn-primary butt-loc"  value="Cancelar" >
			</a>
		</form>	
	</div>
<script type="text/javascript">
	$(function(){
	 $("#desc_valor").maskMoney({thousands:'', decimal:'.', allowZero:true});
	 $("#acresc_valor").maskMoney({thousands:'', decimal:'.', allowZero:true});
	 })
</script>
</html>