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
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title">Cliente</h1>
					</div>
					<div class="panel-body">
						<div class="row">
							<fieldset class="col-md-4">							
								<div class="form-group"> 
									<label for="nome">Nome</label>
									<input type="text" class="form-control input-sm" id="nome" name="nome" autofocus required/> 
								</div>
							</fieldset>
							<fieldset class="col-md-4">							
								<div class="form-group"> 
									<label for="razao">Razão Social</label>
									<input type="text" class="form-control input-sm" id="razao" name="fantasia"/> 
								</div>
							</fieldset>
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="cpf-cnpj">CPF/CNPJ</label>
									<input type="text" class="form-control input-sm " id="cpf-cnpj" name="cpf_cnpj"/>
								</div>						
							</fieldset>								
						</div>	
						<div class="row">
							<fieldset class="col-md-4">		
								<div class="form-group"> 
									<label for="rua">Endereço</label>
									<input type="text" class="form-control input-sm" id="rua" name="rua"/> 	
								</div>						
							</fieldset>						
							<fieldset class="col-md-1">	
								<div class="form-group"> 
									<label for="numero">Numero</label>
									<input type="text" class="form-control input-sm" id="numero" name="numero"/> 
								</div>
							</fieldset>							
							<fieldset class="col-md-3">		
								<div class="form-group"> 
									<label for="bairro">Bairro</label>
									<input type="text" class="form-control input-sm " id="bairro" name="bairro"/> 
								</div>
							</fieldset>
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="telefone1">Telefone 1</label>
									<input type="text" class="form-control input-sm " id="telefone1" name="telefone_a"/>
								</div>						
							</fieldset>	
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="telefone2">Telefone 2</label>
									<input type="text" class="form-control input-sm " id="telefone2" name="telefone_b"/>
								</div>						
							</fieldset>
						</div>
						<div class="row">
							<fieldset class="col-md-4">
								<div class="form-group"> 
									<label for="cidade">Cidade</label>
									<input type="text" class="form-control input-sm " id="cidade" name="cidade"/> 
								</div>	
							</fieldset>
							<fieldset class="col-md-1">	
								<div class="form-group"> 
									<label for="estado">UF</label>
									<input type="text" class="form-control input-sm" id="estado" name="estado"/> 
								</div>						
							</fieldset>	
							<fieldset class="col-md-4">	
								<div class="form-group"> 
									<label for="complemento">Complemento</label>
									<input type="text" class="form-control input-sm" id="complemento" name="complemento"/> 
								</div>						
							</fieldset>	
							<fieldset class="col-md-2">	
								<div class="form-group"> 
									<label for="cep">CEP</label>
									<input type="text" class="form-control input-sm" id="cep" name="cep"/> 
								</div>						
							</fieldset>
						</div>
					</div>
				</div>						
				<input type="submit" class="btn btn-primary butt-loc" value="<?=$btnSubmit?>"/>
				<input type="reset"  value="Limpar" class="btn btn-primary butt-loc"/>
			</div>
		</form>
	</div>