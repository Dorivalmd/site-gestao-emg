<?php $this->load->view('commons/header')?>
<div class="container">	
	<?php if($error){ ?>		
	<div class="alert alert-danger"	role="alert"><?=$error?></div>
	<?php } ?>	
	<div class="col-md-4 col-md-offset-4">	
		<h2 align='center' class="col-md-12">Login</h2>
		<form action="<?=base_url('login')?>" method="POST">
			<label class="col-md-12">
				<input type="text" class="form-control" placeholder="Usuário " name="name" autofocus  required/>
			</label>
			<label class="col-md-12">
				<input type="password" class="form-control"	placeholder="Senha"	name="passw" required/>	
			</label>	
			<label class="col-md-12">
				<input type="submit" class="btn	btn-primary btn-block" value="Entrar"/>
			</label>	
			</form>		
	</div>
</div>
 <?php $this->load->view('commons/footer')?> 