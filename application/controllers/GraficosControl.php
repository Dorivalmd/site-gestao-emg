<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GraficosControl extends CI_Controller {

	function __construct(){	
			parent::__construct();	
			$this->load->model('GraficData_model');
			//$this->load->library('PHPlot');
			$this->load->library(array('PHPlot','session'));
		} 
	public function ShowGraf()
	{
		$this->load->view('v_mostrarGrafico');
	}

	public function GraficoBar2019(){
		$ano = "2019";
		$title = "";
		$comp = 1160;
		$larg = 420;
		$this->GraficoBarra($ano, $title, $comp, $larg);
		
	}

	public function GraficoBar2018(){
		$ano = "2018";
		$title = "";
		$comp = 1160;
		$larg = 420;
		$this->GraficoBarra($ano, $title, $comp, $larg);

	}
	public function GraficoBar2017(){
		$ano = "2017";
		$title = "";
		$comp = 1160;
		$larg = 420;
		$this->GraficoBarra($ano, $title, $comp, $larg);
		
	}
	
	public function GraficoBarra($ano, $title, $comp, $larg){
		
		// Dados de entrada
		$equipJanEnt = $this->GraficData_model->getGrafNumRegJanEnt($ano); 
		$equipFevEnt = $this->GraficData_model->getGrafNumRegFevEnt($ano);
		$equipMarEnt = $this->GraficData_model->getGrafNumRegMarEnt($ano);
		$equipAbrEnt = $this->GraficData_model->getGrafNumRegAbrEnt($ano);
		$equipMaiEnt = $this->GraficData_model->getGrafNumRegMaiEnt($ano); 
		$equipJunEnt = $this->GraficData_model->getGrafNumRegJunEnt($ano);
		$equipJulEnt = $this->GraficData_model->getGrafNumRegJulEnt($ano);
		$equipAgoEnt = $this->GraficData_model->getGrafNumRegAgoEnt($ano);
		$equipSetEnt = $this->GraficData_model->getGrafNumRegSetEnt($ano); 
		$equipOutEnt = $this->GraficData_model->getGrafNumRegOutEnt($ano);
		$equipNovEnt = $this->GraficData_model->getGrafNumRegNovEnt($ano);	
		$equipDezEnt = $this->GraficData_model->getGrafNumRegDezEnt($ano);
		// Dados de saida
		$equipJanSai = $this->GraficData_model->getGrafNumRegJanSai($ano); 
		$equipFevSai = $this->GraficData_model->getGrafNumRegFevSai($ano);
		$equipMarSai = $this->GraficData_model->getGrafNumRegMarSai($ano);
		$equipAbrSai = $this->GraficData_model->getGrafNumRegAbrSai($ano);
		$equipMaiSai = $this->GraficData_model->getGrafNumRegMaiSai($ano); 
		$equipJunSai = $this->GraficData_model->getGrafNumRegJunSai($ano);
		$equipJulSai = $this->GraficData_model->getGrafNumRegJulSai($ano);
		$equipAgoSai = $this->GraficData_model->getGrafNumRegAgoSai($ano);
		$equipSetSai = $this->GraficData_model->getGrafNumRegSetSai($ano); 
		$equipOutSai = $this->GraficData_model->getGrafNumRegOutSai($ano);
		$equipNovSai = $this->GraficData_model->getGrafNumRegNovSai($ano);	
		$equipDezSai = $this->GraficData_model->getGrafNumRegDezSai($ano);
				
		$data = array(
		  array('JAN', $equipJanEnt, $equipJanSai), array('FEV', $equipFevEnt, $equipFevSai),
		  array('MAR', $equipMarEnt, $equipMarSai), array('ABR', $equipAbrEnt, $equipAbrSai),
		  array('MAI', $equipMaiEnt, $equipMaiSai), array('JUN', $equipJunEnt, $equipJunSai),
		  array('JUL', $equipJulEnt, $equipJulSai), array('AGO', $equipAgoEnt, $equipAgoSai),
		  array('SET', $equipSetEnt, $equipSetSai), array('OUT', $equipOutEnt, $equipOutSai),
		  array('NOV', $equipNovEnt, $equipNovSai), array('DEZ', $equipDezEnt, $equipDezSai),
		);

		$plot = new CI_PHPlot($comp, $larg);
		$plot->SetImageBorderType('plain');
		$plot->SetPlotType('bars');
		$plot->SetDataType('text-data');
		$plot->SetDataValues($data);
		$plot->SetTitle($title);
		$plot->SetShading(0);
		$plot->SetDrawDashedGrid(true);

		$plot->SetDataColors(array('#0171BC','#18BC9C'));  // (array('#18BC9C','#87CEEB'))
		
		# Make a legend for the 3 data sets plotted:
		$plot->SetLegend(array('Entrada', 'Saida'));
		
		$plot->SetBackgroundColor('#F7F7F9');
		$plot->SetTextColor('black');
		//$plot->SetDataBorderColors('red');
		$plot->SetLightGridColor('black'); // So grid stands out from background

		# Turn off X tick labels and ticks because they don't apply here:
		$plot->SetXTickLabelPos('none');
		$plot->SetXTickPos('none');

		# Make sure Y=0 is displayed:
		$plot->SetPlotAreaWorld(NULL, 0);
		# Y Tick marks are off, but Y Tick Increment also controls the Y grid lines:
		$plot->SetYTickIncrement(25);

		# Turn on Y data labels:
		$plot->SetYDataLabelPos('plotin');

		# With Y data labels, we don't need Y ticks or their labels, so turn them off.
		$plot->SetYTickLabelPos('none');
		$plot->SetYTickPos('none');

		# Format the Y Data Labels as numbers with 1 decimal place.
		# Note that this automatically calls SetYLabelType('data').
		$plot->SetPrecisionY(0);

		$graf = $plot->DrawGraph();
		//$plot->PrintImage();
		return $graf;
	}
	public function GraficoPieTot(){
		$sobreaquecimento = $this->GraficData_model->getGrafNumRegSobreaquecimento(); 
		$faltaFase = $this->GraficData_model->getGrafNumRegFaltaFase();		
		$contaminacao = $this->GraficData_model->getGrafNumRegContaminacao();
		$baixaIsolacao = $this->GraficData_model->getGrafNumRegBaixaIsolacao();
		$problemaMecanico = $this->GraficData_model->getGrafNumRegProblemaMecanico();
		$revisao = $this->GraficData_model->getGrafNumRegRevisao();
		$garantia = $this->GraficData_model->getGrafNumRegGarantia();
		$outros = $this->GraficData_model->getGrafNumRegOutros(); 
		
		
		$data = array(
		 array('', $sobreaquecimento),
		 array('', $faltaFase),
		 array('', $contaminacao),
		 array('', $baixaIsolacao),
		 array('', $problemaMecanico),
		 array('', $revisao),
		 array('', $garantia),
		 array('', $outros),	 
		);
		$plot = new CI_PHPlot(760, 710);
		//$plot->SetTitle("PRINCIPAIS CAUSAS DE FALHAS");
		$plot->SetImageBorderType('plain');
		$plot->SetDataType('text-data-single');
		$plot->SetDataValues($data);
		$plot->SetPlotType('pie');
		$plot->SetBackgroundColor('#F7F7F9');
		$colors = array('red', 'green', 'blue', 'yellow', 'DarkGreen', 'orange','salmon','aquamarine1');
		$plot->SetDataColors($colors);
		$causas = array('Sobreaquecimento', 'Falta de fase', 'Contaminacao','Baixa isolacao','Problema mecanico', 'Revisao', 'Garantia', 'Outros');
		$plot->SetLegend($causas);
		$plot->SetShading(5);
		$plot->SetLabelScalePosition(0.3);
		$plot->DrawGraph();
	}
	
	//++++++++++++++++Grafico para clientes  +++++++++++++++++++++++++++++++++
	
	public function ShowGrafClient()
	{
		$this->load->view('v_mostrarGraficoClient');
	}

	public function GraficoBarClient2019(){
		$ano = "2019";
		$title = "";
		$comp = 1160;
		$larg = 420;
		$this->GraficoBarTotClient($ano, $title, $comp, $larg);
		
	}

	public function GraficoBarClient2018(){
		$ano = "2018";
		$title = "";
		$comp = 1160;
		$larg = 420;
		$this->GraficoBarTotClient($ano, $title, $comp, $larg);

	}
	public function GraficoBarClient2017(){
		$ano = "2017";
		$title = "";
		$comp = 1160;
		$larg = 420;
		$this->GraficoBarTotClient($ano, $title, $comp, $larg);
		
	}
	
	public function GraficoBarTotClient($ano, $title, $comp, $larg){
		$nomeCliente = $this->session->userdata('nome');
		// Dados de entrada
		$equipJanEnt = $this->GraficData_model->getGrafNumRegClientJanEnt($nomeCliente, $ano); 
		$equipFevEnt = $this->GraficData_model->getGrafNumRegClientFevEnt($nomeCliente, $ano);
		$equipMarEnt = $this->GraficData_model->getGrafNumRegClientMarEnt($nomeCliente, $ano);
		$equipAbrEnt = $this->GraficData_model->getGrafNumRegClientAbrEnt($nomeCliente, $ano);
		$equipMaiEnt = $this->GraficData_model->getGrafNumRegClientMaiEnt($nomeCliente, $ano); 
		$equipJunEnt = $this->GraficData_model->getGrafNumRegClientJunEnt($nomeCliente, $ano);
		$equipJulEnt = $this->GraficData_model->getGrafNumRegClientJulEnt($nomeCliente, $ano);
		$equipAgoEnt = $this->GraficData_model->getGrafNumRegClientAgoEnt($nomeCliente, $ano);
		$equipSetEnt = $this->GraficData_model->getGrafNumRegClientSetEnt($nomeCliente, $ano); 
		$equipOutEnt = $this->GraficData_model->getGrafNumRegClientOutEnt($nomeCliente, $ano);
		$equipNovEnt = $this->GraficData_model->getGrafNumRegClientNovEnt($nomeCliente, $ano);	
		$equipDezEnt = $this->GraficData_model->getGrafNumRegClientDezEnt($nomeCliente, $ano);
		// Dados de saida
		$equipJanSai = $this->GraficData_model->getGrafNumRegClientJanSai($nomeCliente, $ano); 
		$equipFevSai = $this->GraficData_model->getGrafNumRegClientFevSai($nomeCliente, $ano);
		$equipMarSai = $this->GraficData_model->getGrafNumRegClientMarSai($nomeCliente, $ano);
		$equipAbrSai = $this->GraficData_model->getGrafNumRegClientAbrSai($nomeCliente, $ano);
		$equipMaiSai = $this->GraficData_model->getGrafNumRegClientMaiSai($nomeCliente, $ano); 
		$equipJunSai = $this->GraficData_model->getGrafNumRegClientJunSai($nomeCliente, $ano);
		$equipJulSai = $this->GraficData_model->getGrafNumRegClientJulSai($nomeCliente, $ano);
		$equipAgoSai = $this->GraficData_model->getGrafNumRegClientAgoSai($nomeCliente, $ano);
		$equipSetSai = $this->GraficData_model->getGrafNumRegClientSetSai($nomeCliente, $ano); 
		$equipOutSai = $this->GraficData_model->getGrafNumRegClientOutSai($nomeCliente, $ano);
		$equipNovSai = $this->GraficData_model->getGrafNumRegClientNovSai($nomeCliente, $ano);	
		$equipDezSai = $this->GraficData_model->getGrafNumRegClientDezSai($nomeCliente, $ano);
				
		$data = array(
		  array('JAN', $equipJanEnt, $equipJanSai), array('FEV', $equipFevEnt, $equipFevSai),
		  array('MAR', $equipMarEnt, $equipMarSai), array('ABR', $equipAbrEnt, $equipAbrSai),
		  array('MAI', $equipMaiEnt, $equipMaiSai), array('JUN', $equipJunEnt, $equipJunSai),
		  array('JUL', $equipJulEnt, $equipJulSai), array('AGO', $equipAgoEnt, $equipAgoSai),
		  array('SET', $equipSetEnt, $equipSetSai), array('OUT', $equipOutEnt, $equipOutSai),
		  array('NOV', $equipNovEnt, $equipNovSai), array('DEZ', $equipDezEnt, $equipDezSai),
		);

		$plot = new CI_PHPlot($comp, $larg);
		$plot->SetImageBorderType('plain');
		$plot->SetPlotType('bars');
		$plot->SetDataType('text-data');
		$plot->SetDataValues($data);
		$plot->SetTitle($title);
		$plot->SetShading(0);
		$plot->SetDrawDashedGrid(true);

		$plot->SetDataColors(array('#0171BC','#18BC9C'));  // (array('#18BC9C','#87CEEB'))
		
		# Make a legend for the 3 data sets plotted:
		$plot->SetLegend(array('Entrada', 'Saida'));
		
		$plot->SetBackgroundColor('#F7F7F9');
		$plot->SetTextColor('black');
		//$plot->SetDataBorderColors('red');
		$plot->SetLightGridColor('black'); // So grid stands out from background

		# Turn off X tick labels and ticks because they don't apply here:
		$plot->SetXTickLabelPos('none');
		$plot->SetXTickPos('none');

		# Make sure Y=0 is displayed:
		$plot->SetPlotAreaWorld(NULL, 0);
		# Y Tick marks are off, but Y Tick Increment also controls the Y grid lines:
		$plot->SetYTickIncrement(10);

		# Turn on Y data labels:
		$plot->SetYDataLabelPos('plotin');

		# With Y data labels, we don't need Y ticks or their labels, so turn them off.
		$plot->SetYTickLabelPos('none');
		$plot->SetYTickPos('none');

		# Format the Y Data Labels as numbers with 1 decimal place.
		# Note that this automatically calls SetYLabelType('data').
		$plot->SetPrecisionY(0);

		$graf = $plot->DrawGraph();
		//$plot->PrintImage();
		return $graf;
		
	}
	public function GraficoPieTotClient(){
		$nomeCliente = $this->session->userdata('nome');
		
		$sobreaquecimento = $this->GraficData_model->getGrafNumRegClientSobreaquecimento($nomeCliente); 
		$faltaFase = $this->GraficData_model->getGrafNumRegClientFaltaFase($nomeCliente);		
		$contaminacao = $this->GraficData_model->getGrafNumRegClientContaminacao($nomeCliente);
		$baixaIsolacao = $this->GraficData_model->getGrafNumRegClientBaixaIsolacao($nomeCliente);
		$problemaMecanico = $this->GraficData_model->getGrafNumRegClientProblemaMecanico($nomeCliente);
		$revisao = $this->GraficData_model->getGrafNumRegClientRevisao($nomeCliente);
		$garantia = $this->GraficData_model->getGrafNumRegClientGarantia($nomeCliente);
		$outros = $this->GraficData_model->getGrafNumRegClientOutros($nomeCliente); 
		
		
		$data = array(
		 array('', $sobreaquecimento),
		 array('', $faltaFase),
		 array('', $contaminacao),
		 array('', $baixaIsolacao),
		 array('', $problemaMecanico),
		 array('', $revisao),
		 array('', $garantia),
		 array('', $outros),	 
		);
	
		$plot = new CI_PHPlot(760, 710);
		//$plot->SetTitle("PRINCIPAIS CAUSAS DE FALHAS");
		$plot->SetImageBorderType('plain');
		$plot->SetDataType('text-data-single');
		$plot->SetDataValues($data);
		$plot->SetPlotType('pie');
		$plot->SetBackgroundColor('#F7F7F9');
		$colors = array('red', 'green', 'blue', 'yellow', 'DarkGreen', 'orange','salmon','aquamarine1');
		$plot->SetDataColors($colors);
		$causas = array('Sobreaquecimento', 'Falta de fase', 'Contaminacao','Baixa isolacao','Problema mecanico', 'Revisao', 'Garantia', 'Outros');
		$plot->SetLegend($causas);
		$plot->SetShading(5);
		$plot->SetLabelScalePosition(0.3);
		$plot->DrawGraph();
	}
	
    //++++++++++++++++++++++++
}
