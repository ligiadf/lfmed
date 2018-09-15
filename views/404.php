<h1>Página não encontrada <small class="h6"><code>Erro 404</code></small></h1>

	<?php if(isset($msg404)): ?>
		<div class="alert alert-danger mt-4" role="alert">
			<h5 class="alert-heading"><?php echo $msg404; ?>
				<?php if(!empty($link404)): ?>
					<a class="alert-link" href="<?php echo $link404; ?>"><?php echo $msglink404; ?></a>
				<?php endif; ?>
			</h5>
		</div>
	<?php die; endif ?>