<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="main" style="margin-top:-7%;height:500px" >
	<div class="login"  >
		<div class="logo text-center" style='margin-bottom: 25px;'>
			<a href="javascript:void(0);" style='display:inline-block'>
				<h1 style='color:#428bca;'> <span style='display:inline-block;margin-bottom:10px;'>广州九加一电子科技有限公司</span></br>移动商城后台管理系统</h1>
			</a>
		</div>
		<div class="panel panel-default">
			<div class="panel-body" >
				<form action="" method="post" role="form" id="form1" onsubmit="return formcheck();">

					<div class="form-group input-group">
						<div class="input-group-addon"><img src="./resource/images/icon-user.png" alt="" /></div>
						<input name="username"  type="text" class="form-control" placeholder="请输入用户名登录">

					</div>
					<div class="form-group input-group">
						<div class="input-group-addon"><img src="./resource/images/icon-pass.png" alt="" /></div>
						<input name="password" type="password" class="form-control " placeholder="请输入登录密码">
					</div>
					<?php  if(!empty($_W['setting']['copyright']['verifycode'])) { ?>
					<div class="form-group input-group">
						<div class="input-group-addon"><img src="./resource/images/icon-code.png" alt="" /></div>
						<input name="verify" type="text" class="form-control" placeholder="请输入验证码">
						<a href="javascript:;" id="toggle" class="input-group-btn imgverify"><img id="imgverify" src="<?php  echo url('utility/code')?>" title="点击图片更换验证码" /></a>
					</div>
					<?php  } ?>
					<div class="form-group">
						<label class="">
							<input type="checkbox" value="true" name="rember"> 记住用户名
						</label>
					</div>
					<div class="login-submit text-center">
						<input type="submit" id="submit" name="submit" value="登录" class="btn btn-primary" />
						<?php  if(!$_W['siteclose']) { ?>
						<a href="<?php  echo url('user/register');?>" class="btn btn-default">注册</a>
						<?php  } ?>
						<input name="token" value="<?php  echo $_W['token'];?>" type="hidden" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-base', TEMPLATE_INCLUDEPATH));?>
<script>
function formcheck() {
	if($('#remember:checked').length == 1) {
		cookie.set('remember-username', $(':text[name="username"]').val());
	} else {
		cookie.del('remember-username');
	}
	return true;
}
var h = document.documentElement.clientHeight;
$(".login").css('min-height',h);
$('#toggle').click(function() {
	$('#imgverify').prop('src', '<?php  echo url('utility/code')?>r='+Math.round(new Date().getTime()));
	return false;
});
<?php  if(!empty($_W['setting']['copyright']['verifycode'])) { ?>
	$('#form1').submit(function() {
		var verify = $(':text[name="verify"]').val();
		if (verify == '') {
			alert('请填写验证码');
			return false;
		}
	});
<?php  } ?>
</script>
