<!DOCTYPE html>
<html lang="pt_BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eletro Mecanica Guara</title>
    <meta name="description" content="Eletro Mecanica Guara Manutenção Industrial motores eletricos, bombas, geradores e transformadores">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300|Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    
	
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/font-awesome.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/animate.css')?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css')?>">
	
    <!-- =======================================================
        Theme Name: Bethany
        Theme URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
        Author: BootstrapMade.com
        Author URL: https://bootstrapmade.com
    ======================================================= -->
  </head>
  <body>
    <!--header-->
    <header class="main-header" id="header">
        <div class="bg-color">
            <!--nav-->
            <nav class="nav navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="col-md-12">
                        <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
                            <span class="fa fa-bars"></span>
                        </button>
                            <!--<a href="index.html" class="navbar-brand"><img src="<?= base_url('assets/img/logoemg5.png')?>" height="34" width="109"></a>-->
							<a href="#header"" class="navbar-brand" ><img src="<?= base_url('assets/img/logoemg5.png')?>" height="34" width="109"></a>
                        </div>
                        <div class="collapse navbar-collapse navbar-right" id="mynavbar">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#header">Home</a></li>
                                <li><a href="#feature">Serviços</a></li>
                               <!-- <li><a href="#portfolio">Imagens</a></li>-->
                                <li><a href="#contact">Contato</a></li>
								<?php
								if($this->session->userdata('logged')== false) {
									?>
									<li><a href="<?=base_url('login')?>">Area Restrita</a></li>
									<?php
									} 
									else{
									?>
									<li>
										<a href="<?=base_url('bemvindo')?>"><?=$this->session->userdata('nome')?></a>
									</li>
									<li>
										<li><a href="<?=base_url('logout')?>">Sair</a></li>
									</li>
								<?php
									}
								?>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <!--/ nav-->
            <div class="container text-center">
                <div class="wrapper wow fadeInUp delay-05s" >
                    <h2 class="top-title"></h2>
                    <br>
                    <br>
                    <br>
                    <h3 class="title">EMG</h3>
                    <br>
                    <h4 class="sub-title">ELETRO MECÂNICA GUARA</h4>
                </div>
            </div>
        </div>
    </header>
    <!--/ header-->
    <!---->
    
    <!---->
    <!---->
    <section id="feature" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 wow fadeInLeft delay-05s">
                    <div class="section-title">
                        <h2 class="head-title">Serviços</h2>
                        <hr class="botm-line">
                        <p class="sec-para"><b>Manutenção Corretiva</b> consiste em substituir peças ou componentes que se desgastaram ou falharam e que levaram a máquina ou o equipamento a uma parada, por falha ou pane em um ou mais componentes. É o conjunto de serviços executados nos equipamento com falha.</p>
                        <p class="sec-para"><b>Manutenção Preventiva</b> é toda a ação sistemática de controle e monitoramento, com o objetivo de reduzir ou impedir falhas no desempenho de equipamentos. A manutenção aumenta a confiabilidade e leva o equipamento a operar sempre próximo das condições em que saiu de fábrica.</p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="col-md-6 wow fadeInRight delay-02s">
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="icon-text">
                            <h3 class="txt-tl">Motores Eletricos</h3>
                            <p class="txt-para">Fazemos rejuvenecimento e rebobinamento de motores monofásicos e trifásico, corrente continua e corrente alternada. </p>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInRight delay-02s">
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="icon-text">
                            <h3 class="txt-tl">Bombas Hidraulicas</h3>
                            <p class="txt-para">Manutenção, revisão, rebobinamento e rejuvenecimento de moto-bombas centrifugas, bombas submersíveis, monofásica e trifásica. </p>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInRight delay-04s">
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="icon-text">
                            <h3 class="txt-tl">Geradores</h3>
                            <p class="txt-para">Manutenção, revisão, rebobinamento e rejuvenecimento de geradores em geral, de média e baixa tensão. </p>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInRight delay-04s">
                        <div class="icon">
                            <i class="fa fa-check"></i> 
                        </div>
                        <div class="icon-text">
                            <h3 class="txt-tl">Transformadores</h3>
                            <p class="txt-para">Manutenção, revisão, rebobinamento e rejuvenecimento de transformadores em geral, de média e baixa tensão. </p>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInRight delay-06s">
                        <div class="icon">
                            <i class="fa fa-check"></i> 
                        </div>
                        <div class="icon-text">
                            <h3 class="txt-tl">Bobinas Eletromagnéticas</h3>
                            <p class="txt-para">Manutenção, revisão, rebobinamento e rejuvenecimento de bobinas eletromagnéticas para moto-freios e embreagens. </p>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInRight delay-06s">
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="icon-text">
                            <h3 class="txt-tl">Redutores</h3>
                            <p class="txt-para">Manutenção, revisão, rebobinamento e rejuvenecimento de moto-redutores em geral, de média e baixa tensão. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---->
    <section> <!--class="section-padding parallax bg-image-2 section wow fadeIn delay-08s" id="cta-2">-->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="cta-txt">
                        <h3></h3>
                        <p></p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                </div>
            </div>
        </div>
    </section>
    <!---->
    <!---->
   <!-- <section class="section-padding wow fadeInUp delay-02s" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="section-title">
                        <h2 class="head-title">Portfolio</h2>
                        <hr class="botm-line">
                        <p class="sec-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua..</p>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="col-md-4 col-sm-6 padding-right-zero">
                        <div class="portfolio-box design">
                            <img src="img/port01.jpg" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 padding-right-zero">
                        <div class="portfolio-box design">
                            <img src="img/port02.jpg" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 padding-right-zero">
                        <div class="portfolio-box design">
                            <img src="img/port03.jpg" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 padding-right-zero">
                        <div class="portfolio-box design">
                            <img src="img/port04.jpg" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 padding-right-zero">
                        <div class="portfolio-box design">
                            <img src="img/port05.jpg" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 padding-right-zero">
                        <div class="portfolio-box design">
                            <img src="img/port06.jpg" alt="" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!---->
    <!---->
    <section class="section-padding wow fadeInUp delay-05s" id="contact">
        <div class="container">
            <div class="row white">
                <div class="col-md-8 col-sm-12">
                    <div class="section-title">
                        <h2 class="head-title black">Fale Conosco</h2>
                        <hr class="botm-line">
                        <p class="sec-para black"></p>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-4 col-sm-6" style="padding-left:0px;">
                        <h3 class="cont-title">Email</h3>
                       <?php if(isset($error)){?>
							<div class="alert alert-danger">
								<?=$error?>
							</div>
					  <?php }else{
							if(isset($success)){?>
							<div class="alert alert-success">
								<?=$success?>
							</div>
					  <?php } 
					  } ?>
                        <div class="contact-info">
                            <form action="<?=base_url('fale-conosco')?>" method="post" role="form" class="contactForm">
                                <div class="form-group">
									<input id="nome" name="nome" placeholder="Nome" class= "form-control input-md" required="" type="text" value="<?=set_value('nome')?>">	
                                   <!-- <input type="text" name="nome" class="form-control" id="name" placeholder="Seu nome" data-rule="minlen:4" data-msg="Entre com mínimo 4 caracteres" />
                                    <div class="validation"></div>-->
                                </div>
                                <div class="form-group">
									<input id="email" name="email" placeholder="Email" class="form-control input-md" required="" type="text "value="<?=set_value('email')?>"> 
                                    <!--<input type="email" class="form-control" name="email" id="email" placeholder="Seu Email" data-rule="email" data-msg="Entre com um email válido" />
                                    <div class="validation"></div>-->
                                </div>
                                
                                <div class="form-group">
									<input id="assunto"	name="assunto" placeholder="Assunto" class="form-control input-md" required="" type="text" value="<?=set_value('assunto')?>">	
                                   <!-- <input type="text" class="form-control" name="assunto" id="subject" placeholder="Título" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                    <div class="validation"></div>-->
                                </div>
                                
                                <div class="form-group">
									<textarea class="form-control" id="mensagem" name="mensagem" rows="8" placeholder="Mensagem"><?=set_value('mensagem')?></textarea>
                                    <!--<textarea class="form-control" name="mensagem" rows="5" data-rule="required" data-msg="Por favor, escreva sua mensagem!" placeholder="Mensagem"></textarea>
                                    <div class="validation"></div>-->
                                </div>
                                <button type="submit" class="btn btn-send">Enviar</button>
                            </form>
                        </div>
                        
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <h3 class="cont-title">Faça uma visita</h3>
                        <div class="location-info">
                            <p class="white"><span aria-hidden="true" class="fa fa-map-marker"></span>Av Nossa Senhora de Fátima 1023, Santa Rita, Guaratinguetá SP</p>
                            <p class="white"><span aria-hidden="true" class="fa fa-phone"></span>Fone: (12)31326855 ou (12)31327927</p>
                            <p class="white"><span aria-hidden="true" class="fa fa-envelope"></span>Email: <a href="" class="link-dec">eletromecguara@uol.com.br</a></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-icon-container hidden-md hidden-sm hidden-xs">
                            <span aria-hidden="true" class="fa fa-envelope-o"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---->
    <!---->
    <footer class="" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 footer-copyright">
                    &copy 2017 - EMG - Avenida Nossa Senhora de Fátima 1023 Santa Rita Guaratinguetá SP CEP:12520-010
                    <div class="credits">
                    </div>
                </div>
                <div class="col-sm-5 footer-social">
                    
                </div>
            </div>
        </div>
    </footer>
    <!---->
    <!--contact ends-->
    
	<script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/jquery.easing.min.js')?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/js/wow.js')?>"></script>
    <script src="<?= base_url('assets/js/custom.js')?>"></script>
    <script src="<?= base_url('assets/contactform/contactform.js')?>"></script>
    
  </body>
</html>