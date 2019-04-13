	<?php $this->load->view('commons/headerChecklist')?> 
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
		
		<form action="<?=base_url('CheckList/SalvarDadosChecklist')?>" method="post" > 
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
				<table class="checklist">
				 <caption><h3>Peças</h3></caption>
				  <tr>
				    <td>
				        <div class="checkbox">
				          <label><input type="checkbox" name="tampa_diant" value="sim"> Tampa dianteira </label>
				        </div>
				        <div class="checkbox">
				          <label><input type="checkbox" name="tampa_tras" value="sim"> Tampa traseira</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="tampa_deflet" value="sim"> Tampa defletora </label>
				        </div> 
				        <div class="checkbox ">
				          <label><input type="checkbox" name="caixa_lig" value="sim"> Caixa de ligação</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="tampa_caixa_lig" value="sim"> Tampa caixa de ligação </label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="ventoinha" value="sim"> Ventoinha</label>
				        </div>
				        <div class="checkbox">
				          <label><input type="checkbox" name="olhal" value="sim"> Olhal</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="acoplamento" value="sim"> Acoplamento </label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="polia" value="sim"> Polia</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="protecao_grade" value="sim"> Proteção/Grade</label>
				        </div>
				    </td>
				    <td>
				        <div class="checkbox">
				          <label><input type="checkbox" name="helice" value="sim"> Hélice </label>
				        </div>
				        <div class="checkbox">
				          <label><input type="checkbox" name="rotor_bomba" value="sim"> Rotor Bomba</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="corpo_bomba" value="sim"> Corpo da Bomba </label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="intermed_bomba" value="sim"> Intermediário da Bomba</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="bobina_freio" value="sim"> Bobina de Freio</label>
				        </div>
				      
				        <div class="checkbox">
				          <label><input type="checkbox" name="disco_freio" value="sim"> Disco de Freio </label>
				        </div>
				        <div class="checkbox">
				          <label><input type="checkbox" name="pastilha_freio" value="sim"> Pastilha de Freio</label>
				        </div>
				        <div class="checkbox "> 
				          <label><input type="checkbox" name="molas_freio" value="sim"> Molas do Freio </label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="retific_freio" value="sim"> Retificadora do Freio</label>
				        </div>
				        <div class="checkbox ">
				          <label><input type="checkbox" name="pinhao" value="sim"> Pinhão</label>
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
				         <img src="<?= base_url('uploads')?>/<?= $motor->os_atual?>_002.JPG" height="310" width="395">                   
				      </figure>
				    </td>
				  </tr>
				  
				</table>	
			<input type ="hidden" name="ord_servico" value="<?= $motor->os_atual?>">
			<input type ="hidden" name="id_equip" value="<?= $motor->id_equip?>"> 

			<input type="submit" class="btn btn-primary butt-loc" value="salvar"/>		
		</form>	
	</div>
</body>
</html>