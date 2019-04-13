	<?php $this->load->view('commons/header')?>
	<?php
	if(!isset($_SESSION["logged"]) && !isset($_SESSION["permissao"])) {
		redirect('User/Login');
	}
	?>
	<div class="container">
		<h5>Usuário: <?=$this->session->userdata('nome')?></h5>
		<div align='center' class="page-header">
			<h3><?=$tableTitle?>&nbsp;&nbsp; <?=$title?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total: <?=$numRegistros?></h3>
		</div>	
	</div>	
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php if($urls){?>
			<table class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th>Cliente</th>
					<th>Solicitante</th>
					<th>Os</th>
					<th>Data de entrada</th>
					<th>Nota Fiscal</th>
					<th>Equipamento</th>
					<th>Nº Maquina</th>
					<th>Setor</th>
					<th>Status</th>
				  </tr>
				</thead>
				<?php foreach($urls as $url){?>
				
				<tbody>
					<tr>
						<td>
							<?=$url->cliente?>
						</td>
						<td>
							<?=$url->solicitante?>
						</td>
						<td>
							<?=$url->os_atual?>
						</td>
						<td>
							<?php $date=date_create("$url->data_entrada"); echo date_format($date,"d/m/Y");?>
						</td>
						<td>
							<?=$url->nota_fiscal?>
						</td>
						<td>
							<?=$url->equipamento?>
						</td>
						<td>
							<?=$url->num_maquina?>
						</td>
						<td>
							<?=$url->setor_maquina?>
						</td>
						<td>
							<?=$url->status?>
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