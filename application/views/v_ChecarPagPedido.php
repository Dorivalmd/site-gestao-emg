  <?php $this->load->view('commons/headerChecklist')?> 
  <?php
    if(!isset($_SESSION["logged"]) && !isset($_SESSION["permissao"])) {
      redirect('User/Login');
    }
  ?>
  <div  class="container">
    <div class="panel panel-primary">
      <div class="panel-body">
        <div>
          <figure>
            <img src="<?= base_url('assets/img/logoemg1.png')?>">
          </figure>
        </div>
        <div class="container-fluid">
        <h3>Guaratinguetá - SP, &nbsp;&nbsp;<?php $date=date_create("$dadosped->data_orcam"); echo date_format($date,"d/m/Y");?></h3>
        <div class="row">
            <div class="col-sm-6" style="background-color:white;">
              <div>      
                
                <p><strong> Para: </strong><?= $motor->cliente?></p>
                <p><strong> Att: </strong><?= $dadosped->contato?></p>
                <p><strong> Departamento: </strong><?= $solic->setor?></p>
                
            </div>
            </div>
            <div class="col-sm-6" style="background-color:white;">
              <div>      
              
                <p><strong>Proposta: </strong><?= $motor->os_atual?></p>
                <p><strong>Tel:  </strong>(12)<?= $solic->tel_empresa?>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Cel:</strong> (12)997123456<?= $solic->cel_empresa?></p>
               <p><strong> Email:  </strong><?= $dadosped->email_contato?></p>
                
            </div>
            </div>
            <!-- Add clearfix for only the required viewport -->
            <!-- <div class="col-xs-6 col-sm-3" style="background-color:white;">     </div> -->
            <!-- <div class="col-xs-6 col-sm-3" style="background-color:white;">   </div> -->
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
                <th>Descrição</th>
                <th>Qtde</th>
                <th>Un</th>
                <th>Valor Unit</th>
                <th>Valor Total</th>          
                </tr>
                </thead>
            <?php foreach($itemOrc as $itemRow){?>
              <tbody>
                <tr>
                  <td align= "center">
                    <?=$itemRow->item?>
                  </td>
                  <td>
                    <?=$itemRow->descricao?>
                  </td>
                  <td align= "center">
                    <?=$itemRow->quantidade?>
                  </td>
                  <td align= "center">
                    <?=$itemRow->unidade?>
                  </td>
                  <td align= "right">
                    <?=number_format($itemRow->valor_unit, 2, ",", ".")?>
                  </td>
                  <td align= "right">
                    <?=number_format($itemRow->valor_total, 2, ",", ".")?>
                  </td>
                </tr>
              </tbody>
              <?php } ?>
          </table>
          <?php } ?>

          <div class="container-fluid">
             <div class="row">
              <div class="col-sm-4" style="background-color:white;">
                <div> 
                  <p><strong> Prazo Pgto: </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $dadosped->prazo_pgto?></p>        
                  <p><strong> Prazo Entrega: </strong> &nbsp;&nbsp;<?=$dadosped->prazo_entrega?></p>       
                  <p><strong> Valid. Proposta: </strong><?php $date=date_create("$dadosped->valid_proposta"); echo date_format($date,"d/m/Y");?></p>              
                 </div>
              </div>
              <div class="col-sm-4" style="background-color:white;">
                <p><strong> Garantia: </strong>&nbsp;&nbsp;<?=$dadosped->garantia?></p>
                <p><strong> Impostos: </strong>&nbsp;<?=$dadosped->impostos?></p>
              </div>
              <div class="col-sm-4" style="background-color:white;">
                <div>
                  <!-- Values -->
                  <?php if ($motor->solicitante == "Alexandre Juarez") { ?> 
                      <p><strong>Valor Serv.: </strong><?='R$'.  " ".number_format($valPed->val_servicos, 2, ",", ".")?></p> 
                      <p><strong>Valor Mat.:  </strong>&nbsp;<?='R$'. " ". number_format($valPed->val_pecas, 2, ",", ".")?></p> 
                   <?php } ?>
                
                      <p><strong>Valor Total:  </strong><?='R$'. " ".number_format($valPed->valor_final, 2, ",", ".")?></p>
                </div>
              </div>
             </div>
          </div>
          <p><strong>Causa da Falha: </strong>&nbsp; <?=$motor->causa_problema?> </p>

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

          <!-- <h4 align="center"><strong>"Confiante em poder atende-los com eficiência e qualidade, ficamos a disposição para evoluirmos nas negociações. Grato pela atenção."</strong></h4> -->

           <!-- <h4 align="center"><strong>“Sem mais, agradeço sua atenção e me coloco ao inteiro dispor para esclarecimentos que julgue necessário” <br>Anderson - Dpto Comercial </strong></h4>  --> 

            <h4 class="border-h3 " align="center"><strong> “Sem mais, agradeço sua atenção e fico no aguardo de um breve retorno”<br>Anderson - Dpto Comercial </strong></h4> 

          <!-- ????????????????? -->

          <!-- 3 Pictures-->

          <div class="row">
                <figure class="col-md-4">
                  <img src="<?= base_url('uploads')?>/<?= $motor->os_atual?>_001.JPG" class="img-thumbnail img-responsive">                   
                </figure>
                <figure class="col-md-4">
                  <img src="<?= base_url('uploadsOrcam')?>/<?= $motor->os_atual?>_orc_002.JPG" class="img-thumbnail img-responsive">                   
                </figure>
                <figure class="col-md-4">
                  <img src="<?= base_url('uploadsOrcam')?>/<?= $motor->os_atual?>_orc_003.JPG" class="img-thumbnail img-responsive">                   
                </figure>
          </div>
          <!-- ???????????????????? -->

      </div>
    </div>
      <a href="<?=base_url('Orcamentos/ExportPdfPage')?>?os=<?=$motor->os_atual?>">
        <input type="button" class="btn btn-primary butt-loc"  value="Exportar PDF" autofocus >
      </a> 
  </div>
</body>
</html>