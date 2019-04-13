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
		<!--<p>Site:www.eletromecguara.om.br</p>-->
	</div>
</div>
<h3>Guaratinguetá - SP, &nbsp;&nbsp;<?php $date=date_create("$dadosped->data_orcam"); echo date_format($date,"d/m/Y");?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proposta: <?= $motor->os_atual?></h3>
<div id="conteudo" class="grupo">
  <div id="conteudo-principal ">      
      
      <p><strong> Para: </strong><?= $motor->cliente?></p>
      <p><strong> Att: </strong><?= $dadosped->contato?></p>
      <p><strong> Departamento: </strong><?= $solic->setor?></p>
      
  </div>
  <div id="conteudo-secundario ">      
     <p><strong>Tel:  </strong><?= $solic->tel_empresa?></p>
     <p><strong>Cel:</strong><?= $solic->cel_empresa?></p>
	 <p><strong> Email:  </strong><?= $dadosped->email_contato?></p>
      
  </div>
</div>
  <table>
		
		<tr>
			<td><strong>Ref sua NF:</strong> <?= $motor->nota_fiscal?></td>
			<td><strong>Equip:</strong> <?= $motor->equipamento?></td>
			<td><strong>Marca:</strong> <?= $motor->marca?></td>
			<td><strong>Mod:</strong> <?= $motor->modelo?></td>
		</tr>
				  
		<tr>
			<td><strong>Patrim.:</strong>  <?= $motor->setor_maquina?></td>
			<td><strong>Tensão:</strong> <?= $motor->tensao_nominal?></td>
			<td><strong>RPM: </strong> <?= $motor->rotacao?></td>
			<td><strong>Potencia: </strong> <?= $motor->potencia?></td>
		</tr>
	</table>
  <?php if($itemOrc){?>
  <table>
    <thead>
      <tr>
        <th>Item</th>
        <th align= "left">Serviços a serem executados</th>
		<th>Un</th>
        <th>Qtde</th>
        <!--<th align= "right">Valor Unit</th>-->
        <th align= "right">Valor</th>          
        </tr>
        </thead>
    <?php foreach($itemOrc as $itemRow){?>
      <tbody id="tr1">
        <tr>
          <td align= "center">
            <?=$itemRow->item?>
          </td>
          <td>
            <?=$itemRow->descricao?>
          </td>
		  <td align= "center">
            <?=$itemRow->unidade?>
          </td>
          <td align= "center">
            <?=$itemRow->quantidade?>
          </td>
          
         <!-- <td align= "right">
            <?=number_format($itemRow->valor_unit, 2, ",", ".")?>
          </td>-->
          <td align= "right">
		  <?php if ($dadosped->formato_pagina == "2" || $dadosped->formato_pagina == "3") { ?> 
            <?=number_format($itemRow->valor_total, 2, ",", ".")?>
		  <?php }?>
          </td>
        </tr>
      </tbody>
      <?php } ?>
  </table>
  <?php } ?>

  <div class="infos">
    <div class="box-left">
      <div class="float-left-box">      
          <p><strong> Prazo Pgto: </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $dadosped->prazo_pgto?></p>        
          <p><strong> Prazo Entrega: </strong> &nbsp;&nbsp;<?= $dadosped->prazo_entrega?></p>       
          <p><strong> Valid. Proposta: </strong><?php $date=date_create("$dadosped->valid_proposta"); echo date_format($date,"d/m/Y");?></p>
          
      </div>
      <div class="float-right-box ">
          <p align= "center"><strong> Garantia: </strong><?=$dadosped->garantia?></p>
          <p align= "center"><strong> Impostos: </strong><?=$dadosped->impostos?></p>
      </div>
    </div>
    <div class="float-right-val"> 

    <!-- Values -->
     <?php if ($dadosped->formato_pagina == "3") { ?> 
        <p align= "right"><strong>Valor Serv.: </strong><?='R$'.  " ".number_format($valPed->val_servicos, 2, ",", ".")?></p> 
        <p align= "right"><strong>Valor Mat.:  </strong>&nbsp;<?='R$'. " ". number_format($valPed->val_pecas, 2, ",", ".")?></p> 
     <?php } ?>
    
        <p align= "right" ><strong>Valor Total:  </strong><?='R$'. " ".number_format($valPed->valor_final, 2, ",", ".")?></p>
      
    </div>
  </div>
  <p>
    <strong>Causa da Falha: </strong> <?=$motor->causa_problema?></p>
  <p>
    <?php if (!empty($motor->descricao_falha)) {
      echo "( $motor->descricao_falha ) ";
     } ?> 
  </p>
  <p>
     <?php if (!empty($dadosped->obs_orcam)) { ?>
      <strong>Observação:</strong> <?= $dadosped->obs_orcam?>
     <?php } ?>
  </p>

  <!-- Messages -->

  <h3 class="border-h3 " align="center"><strong>"Confiante em poder atende-los com eficiência e qualidade, ficamos a disposição para evoluirmos nas negociações. Grato pela atenção."<br>Anderson - Dpto Comercial</strong></h3> 

  <!-- <h3 class="border-h3 " align="center"><strong>“Sem mais, agradeço sua atenção e me coloco ao inteiro dispor para esclarecimentos que julgue necessário” <br>Anderson - Dpto Comercial </strong></h3>  -->


  <!--<h3 class="border-h3 " align="center"><strong> “Sem mais, agradeço sua atenção e fico no aguardo de um breve retorno”<br>Anderson - Dpto Comercial </strong></h3>-->

  <!-- ????????????????? -->

  <!-- 3 Pictures-->

  <div class="fotosOrc"> 
    <div class="fotosOrc-left">
      <div class="float-left-foto">      
        <figure>
          <img src="<?= base_url('uploads')?>/<?= $motor->os_atual?>_001.JPG" height="140" width="200">
        </figure>
      </div>
      <div class="float-center-foto">
        <figure>
          <img src="<?= base_url('uploadsOrcam')?>/<?= $motor->os_atual?>_orc_001.JPG" height="140" width="200">
        </figure> 
      </div>
    </div>
    <div class="float-right-foto">      
      <figure>
        <img src="<?= base_url('uploadsOrcam')?>/<?= $motor->os_atual?>_orc_003.JPG" height="140" width="200">
      </figure>   
    </div>
  </div>
   
  <!-- ??????????????? -->
</body>
</html>