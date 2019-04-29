	<?php $this->load->view('commons/header')?> 
	<?php
	if(!isset($_SESSION["logged"]) && !isset($_SESSION["permissao"])) {
		redirect('User/Login');
	}
	
	?>
	<div class="container">	
		<!--  <h5>Usuário: <?=$this->session->userdata('nome')?></h5>  -->
		<div class="row">
				<div class="panel-body">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h1 align="center" class="panel-title">TOTAL DE EQUIPAMENTOS POR MÊS EM 2019</h1>
						</div>
						<div class="panel-body">	
							<div class="row">
								<fieldset class="col-md-12">
									<p><img src="<?= base_url('GraficosControl/GraficoBarClient2019')?>" class="img-thumbnail img-responsive"  alt="Grafico" >				 
								</fieldset>								
							</div>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h1 align="center" class="panel-title">TOTAL DE EQUIPAMENTOS POR MÊS EM 2018</h1>
						</div>
						<div class="panel-body">	
							<div class="row">
								<fieldset class="col-md-12">
									<p><img src="<?= base_url('GraficosControl/GraficoBarClient2018')?>" class="img-thumbnail img-responsive"  alt="Grafico" >				 
								</fieldset>								
							</div>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h1 align="center" class="panel-title">TOTAL DE EQUIPAMENTOS POR MÊS EM 2017</h1>
						</div>
						<div class="panel-body">	
							<div class="row">
								<fieldset class="col-md-12">
									<p><img src="<?= base_url('GraficosControl/GraficoBarClient2017')?>" class="img-thumbnail img-responsive"  alt="Grafico" >				 
								</fieldset>								
							</div>
						</div>
					</div>	
					<!-- 
					<div class="panel panel-success">
						<div class="panel-heading">
							<h1 align="center" class="panel-title">PRINCIPAIS CAUSAS DE FALHAS</h1>
						</div>
						<div class="panel-body">
							<div class="row">
								<fieldset class="col-md-5">
									<div class="panel panel-success">
										<div class="panel-body">
											<dl>										
												<dt><font color="#18BC9C">Sobreaquecimento</font></dt> 
												<dd>- Excesso de carga na ponta de eixo;</dd>
												<dd>- Sobretensão ou subtensão na rede de alimentação;</dd>
												<dd>- Conexão incorreta dos cabos de ligação do motor.</dd>
												
												<dt><font color="#18BC9C">Falta de fase</font></dt> 
												<dd>- Mau contato em chave, contator ou disjuntor;</dd>
												<dd>- Mau contato em conexões;</dd>
												<dd>- Queima de um fusível;</dd>
												
												<dt><font color="#18BC9C">Contaminação</font></dt>
												<dd>- Presença de graxa, óleo, água ou outros líquidos nas bobinas.</dd>
												
												<dt><font color="#18BC9C">Baixa isolação</font></dt>
												<dd>- Ressecamento do material isolante por tempo de vida útil ou sobreaquecimentos consecutivos;</dd>
												<dd>- Umidade do ambiente.</dd>
												
												<dt><font color="#18BC9C">Problema mecânico</font></dt>
												<dd>- Folga nas tampas ou eixo, eixo empenado, rolamento travado etc. </dd>
												
												<dt><font color="#18BC9C">Revisão</font></dt>
												<dd>- Se nenhum problema é detectado é feita a manutenção preventiva do equipamento.</dd>
											
												<dt><font color="#18BC9C">Garantia</font></dt>
												<dd>- Falhas detectadas dentro do prazo de garantia, que não apresenta nenhuma das caracteristicas mencionadas.</dd>
											
												<dt><font color="#18BC9C">Outros</font></dt>
												<dd>- Qualquer problema fora dos padrões.</dd>
											</dl>
										</div>
									</div>
								</fieldset>
								<fieldset class="col-md-7">
									<p><img src="<?= base_url('GraficosControl/GraficoPieTotClient')?>" class="img-thumbnail img-responsive"  alt="Grafico" >				 
								</fieldset>
							</div>
						</div>
					</div>
					 -->
					
				</div>	
		</div>									
	</div>	
</body>
</html>