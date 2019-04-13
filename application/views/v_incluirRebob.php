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
		<!--<h1 align="center" class="form-signin-heading"><?=$Title?></h1>-->
		<form action="<?=base_url($metRout)?>" method="POST" class="form-horizontal form-incluir"> 
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
						<h1 class="panel-title">Dados de Bobinagem</h1>
					</div>
					<div class="panel-body">
						<div class="row">
								<fieldset class="col-md-6">							
									<div class="form-group form-group-lg"> 
										<label class="col-sm-3 control-label" for="ord_servico">OS:</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" id="ord_servico" name="ord_servico" <?php if(($CheckDataPage) == true){?> value="<?= $_GET['id']?>" <?php } ?> autofocus required /> 
										</div>
									</div>
								</fieldset>
								<fieldset class="col-md-6">							
									<div class="form-group form-group-lg"> 
										<label class="col-sm-6 control-label" for="ord_servico">DADOS ORIGINAIS</label>
										<div class="col-sm-6">
											<label class="radio-inline">
											  <input type="radio" name="original" value="sim">SIM
											</label>
											<label class="radio-inline">
											  <input type="radio" name="original" value="nao">NÃO
											</label>
										</div>
									</div>
								</fieldset>															
							</div>
						<div class="row">
								<fieldset class="col-md-3">
								</fieldset>
								<fieldset class="col-md-2">							
									<div class="form-group form-group-lg"> 
										<label class="col-sm-2 control-label" for="campo"></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="campo" name="campo"/> 
										</div>
									</div>
								</fieldset>
								<fieldset class="col-md-2">
								</fieldset>
								<fieldset class="col-md-2">		
									<div class="form-group form-group-lg"> 
										<div class="col-sm-10">
											<input type="text" class="form-control" id="auxilar" name="auxiliar"/>
										</div>
									</div>						
								</fieldset>							
							</div>
							<div class="row">
								<fieldset class="col-md-6">							
									<div class="form-group form-group-lg"> 
										<label class="col-sm-3 control-label" for="fios">Nº de Fios:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="fios" name="fios_campo"/> 
										</div>
									</div>
								</fieldset>
								<fieldset class="col-md-6">		
									<div class="form-group form-group-lg"> 
										<div class="col-sm-9">
											<input type="text" class="form-control" id="fios_aux" name="fios_aux"/>
										</div>
									</div>						
								</fieldset>							
							</div>	
							<div class="row">
								<fieldset class="col-md-6">		
									<div class="form-group form-group-lg"> 
										<label class="col-sm-3 control-label"  for="canais_campo">Nº de Canais:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="canais_campo" name="canais_campo"/> 
										</div>
									</div>						
								</fieldset>						
								<fieldset class="col-md-6">	
									<div class="form-group form-group-lg"> 
										<div class="col-sm-9">
											<input type="text" class="form-control" id="canais_aux" name="canais_aux"/>
										</div>									
									</div>
								</fieldset>							
							</div>
							<div class="row">
								<fieldset class="col-md-6">
									<div class="form-group form-group-lg"> 
										<label class="col-sm-3 control-label" for="passo_campo">Passo:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="passo_campo" name="passo_campo"/> 
										</div>
									</div>	
								</fieldset>
								<fieldset class="col-md-6">	
									<div class="form-group form-group-lg">
										<div class="col-sm-9">
											<input type="text" class="form-control" id="passo_aux" name="passo_aux"/> 
										</div>
									</div>						
								</fieldset>								
							</div>
							<div class="row">
								<fieldset class="col-md-6">
									<div class="form-group form-group-lg"> 
										<label class="col-sm-3 control-label" for="espiras_campo">Espiras:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="espiras_campo" name="espiras_campo"/> 
										</div>
									</div>	
								</fieldset>
								<fieldset class="col-md-6">	
									<div class="form-group form-group-lg">
										<div class="col-sm-9">
											<input type="text" class="form-control" id="espiras_aux" name="espiras_aux"/> 
										</div>
									</div>						
								</fieldset>								
							</div>
							<div class="row">
								<fieldset class="col-md-6">
									<div class="form-group form-group-lg"> 
										<label class="col-sm-3 control-label" for="grupos_campo">Nº de Grupos:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="grupos_campo" name="grupos_campo"/> 
										</div>
									</div>	
								</fieldset>
								<fieldset class="col-md-6">	
									<div class="form-group form-group-lg">
										<div class="col-sm-9">
											<input type="text" class="form-control" id="grupos_aux" name="grupos_aux"/> 
										</div>
									</div>						
								</fieldset>								
							</div>
							<div class="row">
								<fieldset class="col-md-6">
									<div class="form-group form-group-lg"> 
										<label class="col-sm-3 control-label" for="bob_gr_campo">Bobinas/Grupo:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="bob_gr_campo" name="bob_gr_campo"/> 
										</div>
									</div>	
								</fieldset>
								<fieldset class="col-md-6">	
									<div class="form-group form-group-lg">
										<div class="col-sm-9">
											<input type="text" class="form-control" id="bob_gr_aux" name="bob_gr_aux"/> 
										</div>
									</div>						
								</fieldset>								
							</div>
							<div class="row">
								<fieldset class="col-md-6">
									<div class="form-group form-group-lg"> 
										<label class="col-sm-3 control-label" for="ligacao_campo">Ligação:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="ligacao_campo" name="ligacao_campo"/> 
										</div>
									</div>	
								</fieldset>
								<fieldset class="col-md-6">	
									<div class="form-group form-group-lg">
										<div class="col-sm-9">
											<input type="text" class="form-control" id="ligacao_aux" name="ligacao_aux"/> 
										</div>
									</div>						
								</fieldset>								
							</div>
							<div class="row">
								<fieldset class="col-md-6">
									<div class="form-group form-group-lg"> 
										<label class="col-sm-3 control-label" for="peso_campo">Peso:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="peso_campo" name="peso_campo"/> 
										</div>
									</div>	
								</fieldset>
								<fieldset class="col-md-6">	
									<div class="form-group form-group-lg">
										<div class="col-sm-9">
											<input type="text" class="form-control" id="peso_aux" name="peso_aux"/> 
										</div>
									</div>						
								</fieldset>								
							</div>
							<div class="row">
								<fieldset class="col-md-12">
									<div class="form-group form-group-lg"> 
										<label class="col-sm-1 control-label" for="observacao">Obs:</label>
										<div class="col-sm-11">
											<textarea class="form-control" rows="6" id="observacao" name="observacao"></textarea>
										</div>
									</div>
								</fieldset>							
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" id="id_equipamento" name="id_equipamento" value=""/>				
				<input type="submit" class="btn btn-primary butt-loc" value="<?=$btnSubmit?>"/>
				<input type="reset"  value="Limpar" class="btn btn-primary butt-loc"/>
			</div>
		</form>
	</div>