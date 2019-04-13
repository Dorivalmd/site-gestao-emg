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
		<form action="<?=base_url($metRout)?>" method="POST" class="form-incluir" enctype= "multipart/form-data" > 
			<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
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
						<h2 class="panel-title">ORÇAMENTOS</h2>
					</div>	
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-lg-10 col-lg-offset-1">					
								<div class="form-group"> 
									<label for="imagem1">SELECIONE O ORÇAMENTO</label>
									<input type="file" class="form-control input-lg" id="orcamento" name="orcamento"/>
								</div>
							</fieldset>
						</div>
					</div>
				</div>
				
				<input type="submit" class="btn btn-primary butt-loc" name="save" value="<?=$btnSubmit?>"/>				
				<input type="reset"  value="Limpar" class="btn btn-primary butt-loc"/>		
			</div>
			</form>
		</div>