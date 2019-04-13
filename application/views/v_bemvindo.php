	<?php $this->load->view('commons/header')?> 
	<?php
	if(!isset($_SESSION["logged"]) && !isset($_SESSION["permissao"])) {
		redirect('User/Login');
	}
	?>
	<div class="container">
		<br/>	
		<div class="jumbotron"> 
			<br/><br/>
			<h1 align="center">Bem vindo usuário <?=$this->session->userdata('nome')?>!</h1>
			<h2 align="center">
				<br/>
				Obrigado por visitar nosso site!
				<br/><br/>
				Navegue pelo menu acima.
			</h2>
			<br/><br/>
		</div>	
	</div>
	
</body>
</html>