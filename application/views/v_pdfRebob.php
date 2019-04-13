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
		<div class="panel ">
			<div class="panel-heading">
				<h3 class="panel-title">OS: <?= $rebob->ord_servico?></h3>
			</div>
			
			<div class="panel-body">
				<div>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dados de Bobinagem Original
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="original" <?php if($rebob->original == 'sim'){echo "checked='checked'";}?> >&nbsp;&nbsp;SIM
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="original" <?php if($rebob->original == 'nao'){echo "checked='checked'";}?> >&nbsp;&nbsp;NÃO
					
				</div>
				<div class="detalhes"> 
					<table border="1">
						<thead> 
							<tr>
								<th height="43"></th>
								<th><h4><?= $rebob->campo?></h4></th> 
								<th><h4><?= $rebob->auxiliar?></h4></th> 
							</tr>
						</thead> 
						<tbody> 
							<tr> 
								<td width="140" align="right"><h4>Nº de Fios:</h4></td>
								<td><?= $rebob->fios_campo?></td>
								<td><?= $rebob->fios_aux?></td>
							</tr> 
							<tr> 
								<td align="right"><h4>Nº de Canais:</h4></td>
								<td><?= $rebob->canais_campo?></td>
								<td><?= $rebob->canais_aux?></td>
							</tr> 
							<tr>
								<td align="right"><h4>Nº de Passos:</h4></td>
								<td><?= $rebob->passo_campo?></td> 
								<td><?= $rebob->passo_aux?></td>
							</tr>
							<tr>
								<td align="right"><h4>Nº de Espiras:</h4></td>
								<td><?= $rebob->espiras_campo?></td> 
								<td><?= $rebob->espiras_aux?></td>
							</tr>
							<tr>
								<td align="right"><h4>Nº de Grupos:</h4></td>
								<td><?= $rebob->grupos_campo?></td> 
								<td><?= $rebob->grupos_aux?></td>
							</tr> 
							<tr>
								<td align="right"><h4>Nº Bob/Grupos:</h4></td>
								<td><?= $rebob->bob_gr_campo?></td> 
								<td><?= $rebob->bob_gr_aux?></td>
							</tr>
							<tr>
								<td align="right"><h4>Ligação:</h4></td>
								<td><?= $rebob->ligacao_campo?></td> 
								<td><?= $rebob->ligacao_aux?></td>
							</tr>
							<tr>
								<td align="right"><h4>Peso do Fio:</h4></td>
								<td><?= $rebob->peso_campo?></td> 
								<td><?= $rebob->peso_aux?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<h4>Obs:<h4>
				<p><?= $rebob->observacao?></p>
			</div>
		</div>

