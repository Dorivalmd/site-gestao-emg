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
			<h3><?=$Title?></h3>
		</div>	
	</div>	
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php if($users){?>
			<table class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Email</th>
					<th>Senha</th>
					<th>Permissão</th>
					<th>Data</th>
										
				  </tr>
				</thead>
				<?php foreach($users as $user){?>
				
				<tbody>
					<tr>
						<td>
							<?=$user->id?>
						</td>
						<td>
							<?=$user->name?>
						</td>
						<td>
							<?=$user->email?>
						</td>
						<td>
							<?=$user->passw?>
						</td>
						<td>
							<?=$user->permissao?>
						</td>
						<td>
							<?=$user->created_at ?>
						</td>
					</tr>
				</tbody>
				<?php } ?>
			</table>
			<!--<div class="clearfix"></div>-->
			<!--<?=$pagination?>-->
			<?php }else{ ?>
				<p align='center'><?=$voidList?></p>
			<?php } ?>
		</div>	
	</div>

<!--<?php $this->load->view('commons/footer')?> -->  