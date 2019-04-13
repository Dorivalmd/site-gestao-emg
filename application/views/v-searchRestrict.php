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
	<div class="container">
		<h5>Usuário: <?=$this->session->userdata('nome')?></h5>	
		<div class="col-md-4 col-md-offset-4">	
			<form action="<?=base_url($metRout)?>" method="POST">
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
				<h2 align='center' class="col-md-12"><?=$Title?></h2>
				<label class="col-md-12">	
					<input type="text" class="form-control"	placeholder="<?=$placeholder?>" id="<?=$id?>" name="<?=$name?>" autofocus required />
				</label>
				<label class="col-md-12">
					<input type="submit" class="btn	btn-primary btn-block" name="checar"  value="OK"/>
				</label>
			</form>	
		</div>
	</div>	 
	<?php $this->load->view('commons/footer')?> 