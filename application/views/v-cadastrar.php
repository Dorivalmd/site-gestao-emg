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
			<form action="<?=base_url('register')?>" method="POST">
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
				<h2 align='center' class="col-md-12">Cadastrar usuário</h2>
				<label class="col-md-12">	
					<input type="text" class="form-control"	placeholder="Nome (Requerido)" name="name" required/>
				</label>	
				<label class="col-md-12">
					<input type="text" class="form-control"	placeholder="email (Opcional)" name="email" />
				</label>		
				<label class="col-md-12">
					<input type="password" class="form-control"	placeholder="Senha (requerido)" name="passw" required/>
				</label>
				<label class="col-md-12">
					<input	type="submit" class="btn btn-primary btn-block" value="Cadastrar"/>				
				</label>			
			</form>	
		</div>
	</div>
	<?php $this->load->view('commons/footer')?>   