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
		<h1 align="center" class="form-signin-heading"><?=$Title?></h1>
		<form action="<?=base_url($metRout)?>" method="POST" class="form-incluir"> 
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
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title"><?=$Title?></h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-md-3">							
								<div class="form-group"> 
									<label for="nome">Nome</label>
									<input type="text" class="form-control input-sm" id="nome" name="nome" value="<?= $solic->nome?>" disabled /> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="empresa">Empresa</label>
									<input type="text" class="form-control input-sm " id="empresa" name="empresa" value="<?= $solic->empresa?>" disabled />
								</div>						
							</fieldset>	
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="tel-empresa">Telefone</label>
									<input type="text" class="form-control input-sm " id="tel-empresa" name="tel_empresa" value="<?= $solic->tel_empresa?>" disabled />
								</div>						
							</fieldset>	
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="ramal">Ramal</label>
									<input type="text" class="form-control input-sm " id="ramal" name="ramal" value="<?= $solic->ramal?>" disabled />
								</div>						
							</fieldset>
						</div>	
						<div class="row">
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="email">Email</label>
									<input type="text" class="form-control input-sm" id="email" name="email" value="<?= $solic->email?>" disabled /> 	
								</div>						
							</fieldset>						
							<fieldset class="col-md-3">	
								<div class="form-group"> 
									<label for="setor">Setor</label>
									<input type="text" class="form-control input-sm" id="setor" name="setor" value="<?= $solic->setor?>" disabled /> 
								</div>
							</fieldset>							
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="cel_empresa">Cel Empresa</label>
									<input type="text" class="form-control input-sm " id="cel_empresa" name="cel_empresa" value="<?= $solic->cel_empresa?>" disabled /> 
								</div>
							</fieldset>				
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="cel-pessoal">Cel Pessoal</label>
									<input type="text" class="form-control input-sm " id="cel-pessoal" name="cel_pessoal" value="<?= $solic->cel_pessoal?>" disabled /> 
								</div>	
							</fieldset>
						</div>
					</div>
				</div>	
				<input type ="hidden" name="solic-del" value="<?= $solic->id?>">
				<input type="submit" class="btn btn-primary butt-loc" value="<?=$btnSubmit?>"/>
			</div>
		</form>
	</div>