	<?php $this->load->view('commons/headerChecklist')?> 
	<?php
		if(!isset($_SESSION["logged"]) && !isset($_SESSION["permissao"])) {
			redirect('User/Login');
		}
	?>
	<div  class="container">
		
		<form action="<?=base_url('CheckList/ExportPdfPage')?>" method="post" > 
			<h1 align="center" >EMG - Eletro Mecânica Guará</h1> 		
				<h2>Check List</h2>
				<table>
				  <caption><h3>OS: <?= $motor->os_atual?></h3></caption>
				  <tr>
				    <td><strong>Empresa:</strong> <?= $motor->cliente?></td>
				    <td><strong>NF. Entrada:</strong> <?= $motor->nota_fiscal?></td>
				    <td><strong>Solicitante:</strong> <?= $motor->solicitante?></td>
				  </tr>
				  <tr>
				    <td><strong>Equipamento:</strong> <?= $motor->equipamento?></td>
				    <td><strong>Marca:</strong> <?= $motor->marca?></td>
				    <td><strong>Modelo:</strong> <?= $motor->modelo?></td>
				  </tr>
				  
				  <tr>
				    <td><strong>Potencia:</strong>  <?= $motor->potencia?></td>
				    <td><strong>Tensão:</strong> <?= $motor->tensao_nominal?></td>
				    <td><strong>Rotação: </strong> <?= $motor->rotacao?></td>
				  </tr>
				  <tr>
				    <td><strong>Setor:</strong> <?= $motor->setor_maquina?></td>
				    <td><strong>Máquina:</strong> <?= $motor->num_maquina?></td>
				    <td><strong>Nº Serie:</strong> <?= $motor->num_serie?></td>
				  </tr>
				  <tr>
				    <td colspan="2"><strong>Complemento:</strong> <?= $motor->complemento?></td>
				    <td><strong>Data Saida:</strong> <?= $motor->data_saida?></td>
				  </tr>
				</table>
				<table>
				 <caption><h3>Peças</h3></caption>
				  <tr>
				    <td> 
				        <div class="checkbox">
				          <label><input type="checkbox" name="tampa_diant" value="sim" <?php if ($checkl->tampa_diant == 'sim'){ echo "checked='checked'";}?> disabled> Tampa dianteira </label>
				        </div>
				        <div class="checkbox">
				          <label><input type="checkbox" name="tampa_tras" value="sim"  <?php if($checkl->tampa_tras == 'sim'){echo "checked='checked'";}?> disabled> Tampa traseira</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="tampa_deflet" value="sim"  <?php if($checkl->tampa_deflet == 'sim'){echo "checked='checked'";}?> disabled> Tampa defletora </label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="caixa_lig" value="sim"  <?php if($checkl->caixa_lig == 'sim'){echo "checked='checked'";}?> disabled> Caixa de ligação</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="tampa_caixa_lig" value="sim"  <?php if($checkl->tampa_caixa_lig == 'sim'){echo "checked='checked'";}?> disabled> Tampa caixa de ligação </label>
				        </div>

				        <div class="checkbox">
				          <label><input type="checkbox" name="ventoinha" value="sim"  <?php if($checkl->ventoinha == 'sim'){echo "checked='checked'";}?> disabled> Ventoinha </label>
				        </div>
				        <div class="checkbox"> 
				          <label><input type="checkbox" name="olhal" value="sim"  <?php if($checkl->olhal == 'sim'){echo "checked='checked'";}?> disabled> Olhal</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="acoplamento" value="sim"  <?php if($checkl->acoplamento == 'sim'){echo "checked='checked'";}?> disabled> Acoplamento </label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="polia" value="sim"  <?php if($checkl->polia == 'sim'){echo "checked='checked'";}?> disabled> Polia</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="protecao_grade" value="sim"  <?php if($checkl->protecao_grade == 'sim'){echo "checked='checked'";}?> disabled> Proteção/Grade</label>
				        </div>
				    </td>
				    <td>
				        <div class="checkbox">
				          <label><input type="checkbox" name="helice" value="sim"  <?php if($checkl->helice == 'sim'){echo "checked='checked'";}?> disabled> Hélice </label>
				        </div>
				        <div class="checkbox">
				          <label><input type="checkbox" name="rotor_bomba" value="sim"  <?php if($checkl->rotor_bomba == 'sim'){echo "checked='checked'";}?> disabled> Rotor Bomba</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="corpo_bomba" value="sim"  <?php if($checkl->corpo_bomba == 'sim'){echo "checked='checked'";}?> disabled> Corpo da Bomba </label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="intermed_bomba" value="sim"  <?php if($checkl->intermed_bomba == 'sim'){echo "checked='checked'";}?> disabled> Intermediário da Bomba</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="bobina_freio" value="sim"  <?php if($checkl->bobina_freio == 'sim'){echo "checked='checked'";}?> disabled> Bobina de Freio</label>
				        </div>
				      
				        <div class="checkbox">
				          <label><input type="checkbox" name="disco_freio" value="sim"  <?php if($checkl->disco_freio == 'sim'){echo "checked='checked'";}?> disabled> Disco de Freio </label>
				        </div>
				        <div class="checkbox">
				          <label><input type="checkbox" name="pastilha_freio" value="sim"  <?php if($checkl->pastilha_freio == 'sim'){echo "checked='checked'";}?> disabled> PastilhA de Freio</label>
				        </div>
				        <div class="checkbox "> 
				          <label><input type="checkbox" name="molas_freio" value="sim"  <?php if($checkl->molas_freio == 'sim'){echo "checked='checked'";}?> disabled> Molas do Freio </label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="retific_freio" value="sim"  <?php if($checkl->retific_freio == 'sim'){echo "checked='checked'";}?> disabled> Retificadora do Freio</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="pinhao" value="sim"  <?php if($checkl->pinhao == 'sim'){echo "checked='checked'";}?> disabled> Pinhão</label>
				        </div>
				    </td>
				  </tr>
				</table>
				<table>
				  <caption><h3>Imagens</h3></caption>
				  <tr>
				    <td>
				      <figure>
				        <img src="<?= base_url('uploads')?>/<?= $motor->os_atual?>_001.JPG" height="310" width="395">                   
				      </figure>
				    </td>
				    <td>
				      <figure>
				         <img src="<?= base_url('uploads')?>/<?= $motor->os_atual?>_003.JPG" height="310" width="395">                   
				      </figure>
				    </td>
				  </tr>
				  
				</table>	

			<input type ="hidden" name="Checklist" value="<?= $motor->os_atual?>"> 
			<input type="submit" class="btn btn-primary butt-loc" value="Exportar PDF"/>	
		</form>	
	</div>
</body>
</html>