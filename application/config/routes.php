<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'User/loadHome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'User/carregarPaginaPrincipal';
$route['bemvindo'] = 'User/carregarPaginaBemvindo';

//admin manipular Dados de Equipamentos
$route['incluirPorOsAnt'] = 'OrdemServico/buscarPorOsAnt';
$route['incluirOsPorCliente'] = 'OrdemServico/IncluiDadosPorCliente';
$route['alterarOs'] = 'OrdemServico/alterOs';
$route['OrdemServico/alterarOs'] = 'OrdemServico/alterarOs';
$route['OrdemServico/alterar'] = 'OrdemServico/alterar';
$route['DeletarOs'] = 'OrdemServico/BuscaDel';
$route['listarDadosPorFiltro'] = 'Listas/BuscaDadosPorFiltro';
$route['postarImagens'] = 'OrdemServico/PostarImagemUnica';
$route['postarOrcamento'] = 'OrdemServico/PostarOrcamento';
$route['incluirDadosChecklist'] = 'CheckList/BuscarOsChecklist';
$route['buscarDadosChecklist'] = 'CheckList/BuscarOsChecklistCompleto';
$route['deletarDadosChecklist'] = 'CheckList/BuscarOsChecklistDeletar';

$route['grafico'] = 'GraficosControl/ShowGraf';
$route['graficoCliente'] = 'GraficosControl/ShowGrafClient';

//admin manipular dados de rebobinamento
$route['incluir-dados-rebob'] = 'Rebobinamentos/incluiDadosRebob';
$route['alterar-dados-rebob'] = 'Rebobinamentos/alterDadosRebob';
$route['excluir-dados-rebob'] = 'Rebobinamentos/excluiDadosrebob';
$route['pesquisar-dados-rebob'] = 'Rebobinamentos/buscaDadosRebob';
$route['exportar-dados-rebob'] = 'Rebobinamentos/imprimeDadosRebob';

// area/admin manipular user
$route['login'] = 'User/Login';
$route['logout'] = 'User/Logout';
$route['showCadUser'] = 'User/ShowCad';
$route['cadastrar'] = 'User/register';
$route['register'] = 'User/Register';
$route['alterar-senha'] = 'User/UpdatePassw';
$route['showListUser'] = 'User/listUser';
//area/admin manipular clientes
$route['showCadClient'] = 'Clientes/incluiClient';
$route['showAlterClient'] = 'Clientes/alterCliente';
$route['showDelClient'] = 'Clientes/excluiClient';
$route['showListClient'] = 'Clientes/ListClient';
//area/admin manipular solicitante
$route['showCadSolic'] = 'Solicit/showIncluiSolic';
$route['showAlterSolic'] = 'Solicit/alterSolicit';
$route['showDelSolic'] = 'Solicit/excluiSolic';
$route['showListSolic'] = 'Solicit/ListSolicit';
$route['showListSolic/(:num)'] = "Solicit/ListSolicit/$1";

// admin manipular pesquizas
$route['OrdServico'] = 'OrdemServico/BuscarOs';
$route['OrdCompra'] = 'OrdemCompra/BuscarOc';
//$route['NumPedido'] = 'NumPedido/BuscarNumPed';??????????
$route['NumSerie'] = 'NumSerie/BuscarNumSerie';
// admin manipular listas
$route['listarTot'] = 'Listas/ListarTotal';
$route['listarClient'] = 'Listas/buscarClient';
$route['listarClienSolic'] = 'Listas/buscarClienSolic';
$route['listarNotaFisc'] = 'Listas/buscarNotaFisc';
$route['listarNotaFiscDev'] = 'Listas/buscarNotaFiscDev';
$route['listarNumPedido'] = 'Listas/buscarNumeroPedido';

$route['listarSetor'] = 'Listas/buscarSetor';  // corrigir
$route['listarMaquina'] = 'Listas/buscarNumMaquina'; //corrigir

// admin manipular orçamentos
$route['incluirOrcam'] = 'Orcamentos/BuscarOrcamIncluir';
$route['buscarOrcam'] = 'Orcamentos/BuscarOrcamPesq';
$route['alterarOrcam'] = 'Orcamentos/BuscarOrcamAlter';
$route['excluirOrcam'] = 'Orcamentos/BuscarOrcamDel';
$route['postImgOrcam'] = 'Orcamentos/PostarImagemOrcam';

$route['listarStatus'] = 'Listas/buscarStatus';
// usuario visualizar listas
$route['listarClientUser'] = 'Listas/mostrarClienteUser';
$route['listarSolicUser'] = 'Listas/buscarSolicitUser';
$route['listarNotaFiscUser'] = 'Listas/buscarNotaFiscUser';
$route['listarNumPedidoUser'] = 'Listas/buscarNumeroPedidoUser';

$route['listarSetorUser'] = "Listas/buscarSetorUser";
$route['listarMaquinaUser'] = "Listas/buscarNumMaquinaUser";

$route['listarStatusUser'] = 'Listas/buscarStatusUser';

// usuario visualizar dados
$route['ordemServUser'] = 'PesqEquipUser/BuscarOsUser';
$route['ordemCompUser'] = 'PesqEquipUser/BuscarOcUser';
$route['numPedidoUser'] = 'PesqEquipUser/BuscarNumPedUser';

$route['listSetor'] = "Listas/ListSetor";
$route['listSetor/(:num)'] = "Listas/ListSetor/$1";

$route['listSetorUser'] = "Listas/ListSetorUser";
$route['listSetorUser/(:num)'] = "Listas/ListSetorUser/$1";

$route['listNumMaquina'] = "Listas/ListNumMaquina";
$route['listNumMaquina/(:num)'] = "Listas/ListNumMaquina/$1";

$route['listNumMaquinaUser'] = "Listas/ListNumMaquinaUser";
$route['listNumMaquinaUser/(:num)'] = "Listas/ListNumMaquinaUser/$1";

$route['listarTot/(:num)'] = "Listas/ListarTotal/$1";

$route['listClient'] = "Listas/ListCliente";
$route['listClient/(:num)'] = "Listas/ListCliente/$1";

$route['listSolicit'] = "Listas/ListSolicitante";
$route['listSolicit/(:num)'] = "Listas/ListSolicitante/$1";

$route['listClientUser'] = "Listas/ListCliente";
$route['listClientUser/(:num)'] = "Listas/ListCliente/$1";

$route['listStatus'] = "Listas/ListStatus";
$route['listStatus/(:num)'] = "Listas/ListStatus/$1";

$route['listStatusUser'] = "Listas/ListStatusUser";
$route['listStatusUser/(:num)'] = "Listas/ListStatusUser/$1";

$route['listStatusSolic'] = "Listas/ListStatusSolic";
$route['listStatusSolic/(:num)'] = "Listas/ListStatusSolic/$1";

$route['fale-conosco'] = "Contato/FaleConosco";
