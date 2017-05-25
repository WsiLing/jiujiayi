<?php defined('IN_IA') or exit('Access Denied');?></div>
	<div class="container-fluid footer text-center" role="footer">	
		<span>
			<?php  if(empty($_W['setting']['copyright']['footerright'])) { ?>

			<?php  } else { ?>
				<?php  echo $_W['setting']['copyright']['footerright'];?>
			<?php  } ?>
		</span>
		<br/>
		<span><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="#"><b>韦思玲</b></a> v0.1 &copy; 2017-2018 <?php  } else { ?><?php  } ?></span>
	</div>

	<script>
		require(['bootstrap']);
	</script>
	<?php  } ?>
</body>
</html>
