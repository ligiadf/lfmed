<h1>Você não tem permissão <small class="h6"><code>Erro 403</code></small></h1>

	<?php if(isset($msg403)): ?>
		<div class="alert alert-danger mt-4" role="alert">
			<h5 class="alert-heading"><?php echo $msg403; ?>
				<?php if(!empty($link403)): ?>
					<a class="alert-link" href="<?php echo $link403; ?>"><?php echo $msglink403; ?></a>
				<?php endif; ?>
			</h5>
		</div>
	<?php die; endif ?>