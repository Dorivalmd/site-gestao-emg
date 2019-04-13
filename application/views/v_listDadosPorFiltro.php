	<?php $this->load->view('commons/header')?>
	<?php
	if(!isset($_SESSION["logged"]) && !isset($_SESSION["permissao"])) {
		redirect('User/Login');
	}
	?>
	<div class="container">
		<h5>Usuário: <?=$this->session->userdata('nome')?></h5>
		<div align='center' class="page-header">
			<h3>Marca: <?=$marca?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Potencia: <?=$potencia?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Polos:<?=$polos?></h3>
		</div>	
	</div>	
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php if($urls){?>
			<table class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th>Os</th>
					
					<th>Equipamento</th>
					<th>Modelo</th>
					<th>Tensao Nominal</th>
					<th>Corrente Nominal</th>
					<th>Potência</th>
					<th>Rotação</th>
					<th>Causa da Falha</th>
				  </tr>
				</thead>
				<?php foreach($urls as $url){?>
				
				<tbody>
					<tr>
						<td>
							<?=$url->os_atual?>
						</td>
						
						<td>
							<?=$url->equipamento?>
						</td>
						
						<td>
							<?=$url->modelo?>
						</td>
						<td>
							<?=$url->tensao_nominal?>
						</td>
						<td>
							<?=$url->corrente_nominal?>
						</td>
						<td>
							<?=$url->potencia?>
						</td>
						<td>
							<?=$url->rotacao?>
						</td>
						<td>
							<?=$url->causa_problema?>
						</td>
						<td>
							<form action="<?=base_url('OrdemServico/ChecarOs')?>" method="POST">
								<input type="hidden" name="os_atual" id="os-atual" value="<?=$url->os_atual?>">
								<button class="btn	btn-success btn-block btn-xs" type="submit" id="os-atual" >Ver Dados</button>
							</form>
						</td>
					</tr>
				</tbody>
				<?php } ?>
			</table>
			<?php if($pagin == TRUE){ ?>
			<div class="clearfix"></div>
			<?=$pagination?>
			<?php
				} 
			}else{
			?>
				<p align='center'><?=$voidList?></p>
			<?php } ?>
		</div>	
	</div>

<!--<?php $this->load->view('commons/footer')?> -->  