	<?php if(!empty($_GET['msgError'])): ?>
		<div class="alert alert-danger">
			<?php echo $_GET['msgError']; ?>
		</div>
	<?php endif ?>

	<?php if(!empty($_GET['msgOK'])): ?>
		<div class="alert alert-success">
			<?php echo $_GET['msgOK']; ?>
		</div>
	<?php endif ?>

<header>
	<h1>Página inicial</h1>
</header>

<p><?php echo $data; ?></p>
<p><?php echo $hora; ?></p>

<ul>
	<li>Agenda do dia por médico</li>
	<li>Lista dos médicos ativos</li>
	<li>Relatórios
		<ul>
			<li>Lista de consultas canceladas</li>
			<li>Lista de consultas conflitos</li>
			<li>Indisponibilidades do médico [mostrar também no perfil dele]</li>
		</ul>
	</li>
	<li>Estatísticas</li>
</ul>