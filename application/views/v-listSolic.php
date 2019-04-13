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
		<div align='center' class="page-header">
			<h3><?=$Title?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total: <?=$numRegistros?></h3>
		</div>	
	</div>	
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php if($solicit){?>
			<table class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th>Empresa</th>
					<th>Nome</th>
					<th>Email</th>
					<th>Cel Empresa</th>
					<th>Cel Pessoal</th>
					<th>Tel Empresa</th>
					<th>Ramal</th>
				  </tr>
				</thead>
				<?php foreach($solicit as $solic){?>
				
				<tbody>
					<tr>
						<td>
							<?=$solic->empresa?>
							
						</td>
						<td>
							<?=$solic->nome?>
						</td>
						<td>
							<?=$solic->email?>
						</td>
						<td>
							<?=$solic->cel_empresa?>
						</td>
						<td>
							<?=$solic->cel_pessoal?>
						</td>
						<td>
							<?=$solic->tel_empresa?>
						</td>
						<td>
							<?=$solic->ramal?>
						</td>
						<td>
							<form action="<?=base_url('Solicit/alterarSolicit')?>" method="POST">
								<input type="hidden" name="nome" id="nome" value="<?=$solic->nome?>">
								<button class="btn	btn-success btn-block btn-xs" type="submit" id="os-atual" >Editar</button>
							</form>
						</td>
					</tr>
				</tbody>
				<?php } ?>
			</table>
			<div class="clearfix"></div>
			<?=$pagination?>
			<?php }else{ ?>
				<p align='center'><?=$voidList?></p>
			<?php } ?>
		</div>	
	</div>

<!--<?php $this->load->view('commons/footer')?> -->  