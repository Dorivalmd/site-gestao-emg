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
	<h5>Usuário: <?=$user->name?></h5>
	<div class="col-md-4 col-md-offset-4">
		<h2 align='center' class="col-md-12">Alterar Senha</h2>
		<form action="<?=base_url('alterar-senha')?>" method="POST">
			<label class="col-md-12">
			</label>
			<label class="col-md-12">	
				<input type="text" class="form-control"	placeholder="Nome" name="name" required/>
			</label>
			<label class="col-md-12">	
				<input type="password" class="form-control"	placeholder="Nova Senha" name="passw" required/>
			</label>
			<label class="col-md-12">
				<input type="submit" class="btn	btn-primary btn-block" value="Alterar"/>
			</label>
		</form>	
	</div>
	<div class="col-md-4 col-md-offset-4">	
		<?php if($error){ ?>
		<div class="alert alert-danger"	role="alert">
			<?=$error?>
		</div>
		<?php } ?>
		<?php if($success){ ?>
		<div class="alert alert-success " role="alert">
			<?=$success?>
		</div>	
		<?php } ?>
	</div> 
</div>
<?php $this->load->view('commons/footer')?>