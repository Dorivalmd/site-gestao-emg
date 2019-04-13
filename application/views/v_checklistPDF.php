<!DOCTYPE html>
<html>
<head>

</head>
<body>
<div>
	<div id="cabecalho-principal ">       
		<figure>
			<img src="<?= base_url('assets/img/logoemg1.png')?>" height="52" width="188">
		</figure>     
	</div>
	<div id="cabecalho-secundario ">
		<p>Av. Nossa Senhora de Fátima 1023 Santa Rita  </p>
		<p>Cep: 12520-010 - Guaratinguetá - SP </p>
		<p>Telefone: (12)3132-7927 / 3132-6855  </p>
	</div>
</div>
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
                  <label><input type="checkbox" <?php if ($checkl->tampa_diant == 'sim'){ echo "checked='checked'";}?> > Tampa dianteira </label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox"  <?php if($checkl->tampa_tras == 'sim'){echo "checked='checked'";}?> > Tampa traseira</label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"  <?php if($checkl->tampa_deflet == 'sim'){echo "checked='checked'";}?> > Tampa defletora </label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"  <?php if($checkl->caixa_lig == 'sim'){echo "checked='checked'";}?> > Caixa de ligação</label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox" <?php if($checkl->tampa_caixa_lig == 'sim'){echo "checked='checked'";}?> > Tampa caixa de ligação </label>
                </div>

                <div class="checkbox">
                  <label><input type="checkbox"  <?php if($checkl->ventoinha == 'sim'){echo "checked='checked'";}?>> Ventoinha </label>
                </div>
                <div class="checkbox"> 
                  <label><input type="checkbox"  <?php if($checkl->olhal == 'sim'){echo "checked='checked'";}?> > Olhal</label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"   <?php if($checkl->acoplamento == 'sim'){echo "checked='checked'";}?> > Acoplamento </label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"   <?php if($checkl->polia == 'sim'){echo "checked='checked'";}?> > Polia</label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"  <?php if($checkl->protecao_grade == 'sim'){echo "checked='checked'";}?> > Proteção/Grade</label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                  <label><input type="checkbox"  <?php if($checkl->helice == 'sim'){echo "checked='checked'";}?> > Hélice </label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox"  <?php if($checkl->rotor_bomba == 'sim'){echo "checked='checked'";}?> > Rotor Bomba</label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"  <?php if($checkl->corpo_bomba == 'sim'){echo "checked='checked'";}?> > Corpo da Bomba </label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"   <?php if($checkl->intermed_bomba == 'sim'){echo "checked='checked'";}?> > Intermediário da Bomba</label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"  <?php if($checkl->bobina_freio == 'sim'){echo "checked='checked'";}?> > Bobina de Freio</label>
                </div>
              
                <div class="checkbox">
                  <label><input type="checkbox"   <?php if($checkl->disco_freio == 'sim'){echo "checked='checked'";}?> > Disco de Freio </label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox"   <?php if($checkl->pastilha_freio == 'sim'){echo "checked='checked'";}?> > Pastilha de Freio</label>
                </div>
                <div class="checkbox "> 
                  <label><input type="checkbox"   <?php if($checkl->molas_freio == 'sim'){echo "checked='checked'";}?> > Molas do Freio </label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"  <?php if($checkl->retific_freio == 'sim'){echo "checked='checked'";}?> > Retificadora do Freio</label>
                </div>
                <div class="checkbox ">
                  <label><input type="checkbox"   <?php if($checkl->pinhao == 'sim'){echo "checked='checked'";}?> > Pinhão</label>
                </div>
            </td>
          </tr>
</table>
<table>
  <caption><h3>Imagens</h3></caption>
  <tr>
    <td>
      <figure>
        <img src="<?= base_url('uploads')?>/<?= $motor->os_atual?>_001.JPG" height="260" width="320">                   
      </figure>
    </td>
    <td>
      <figure>
         <img src="<?= base_url('uploads')?>/<?= $motor->os_atual?>_003.JPG" height="260" width="320">                   
      </figure>
    </td>
  </tr>
  
</table>


</body>
</html>