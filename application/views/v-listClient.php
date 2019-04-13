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
			<h3><?=$Title?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total: <?=$numRegistros?> </h3>
		</div>	
	</div>	
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php if($client){?>
			<table class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th>Nome/Empresa</th>
					<th>CPF/CNPJ</th>
					<th>Telefones</th>
					<th>Cidade</th>
					<th>UF</th>
										
				  </tr>
				</thead>
				<?php foreach($client as $clien){?>
				
				<tbody>
					<tr>
						<td>
							<?=$clien->nome?>
						</td>
						<td>
							<?=$clien->cpf_cnpj?>
						</td>
						<td>
							<?=$clien->telefone_a?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?=$clien->telefone_b?>
						</td>
						<td>
							<?=$clien->cidade?>
						</td>
						<td>
							<?=$clien->estado?>
						</td>
						<td>
							<form action="<?=base_url('Clientes/alterarCliente')?>" method="POST">
								<input type="hidden" name="nome" id="nome" value="<?=$clien->nome?>">
								<button class="btn	btn-success btn-block btn-xs" type="submit" id="os-atual" >Editar</button>
							</form>
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