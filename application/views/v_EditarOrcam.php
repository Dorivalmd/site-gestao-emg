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
							<fieldset class="col-md-1">							
								<div class="form-group"> 
									<label for="item">Item</label>
									<input type="text" class="form-control input-sm" id="item" name="item" value="<?=$orc['item']?>" > 
								</div>
							</fieldset>
							<fieldset class="col-md-2">
								<div class="form-group"> 
									<label for="produto">Produto</label>
									<select class="form-control input-sm" id="produto" name="produto" required autofocus/> 
										<option><?=$orc['produto']?></option>
										<option>S01</option>
										<option>M01</option>
									</select>
								</div>					
							</fieldset>
							<fieldset class="col-md-5">		
								<div class="form-group"> 
									<label for="descricao">Descrição</label>
									<input type="text" class="form-control input-sm" id="descricao" name="descricao" value="<?=$orc['descricao']?>" required>
								</div>						
							</fieldset>
							<fieldset class="col-md-1">							
								<div class="form-group"> 
									<label for="unidade">Un</label>
									<input type="text" class="form-control input-sm" id="unidade" name="unidade" value="<?=$orc['unidade']?>" required> 
								</div>
							</fieldset>							
							<fieldset class="col-md-1">
								<div class="form-group"> 
									<label for="quantidade">Qtde</label>
									<input type="text" class="form-control input-sm" id="quantidade" name="quantidade" value="<?=$orc['quantidade']?>" required/>
								</div>
							</fieldset>		
							<fieldset class="col-md-2">		
								<div class="form-group"> 
									<label for="valor_unit">Valor Unit</label>
									<input type="text" class="form-control input-sm" id="valor_unit" name="valor_unit" value="<?=$orc['valor_unit']?>" required>
								</div>						
							</fieldset>	
						</div>	

					</div>
				</div>						
			</div>
			<input type="hidden" name="valor_total"/>
			<input type="hidden" name="os_atual" value="<?= $motor->os_atual?>"/>							
			<input type="hidden" id="id_equip" name="id_equip"  value="<?=$motor->id_equip?>" > 			
			<input type="submit" class="btn btn-primary butt-loc"  value="<?=$btnSubmit?>" >
			<a href="<?=base_url('Orcamentos/ExcluirItemOrcam')?>?os=<?=$motor->os_atual?>&item=<?=$orc['item']?>">
				<input type="button" class="btn btn-primary butt-loc"  value="Excluir" >
			</a>
			<a href="<?=base_url('Orcamentos/VoltarChecarDadosOrcam')?>?os=<?=$motor->os_atual?>">
				<input type="button" class="btn btn-primary butt-loc"  value="Cancelar" >
			</a>
		</form>	
	</div>
</body>	
<script type="text/javascript">
	$(function(){
	 $("#valor_unit").maskMoney({thousands:'', decimal:'.', allowZero:true});
	 })
</script>
</html>