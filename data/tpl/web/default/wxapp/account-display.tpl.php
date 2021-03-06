<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	<style>
		.account-rank img{width:20px; height:20px;}
		.alert{color:#666;padding:10px}
		.text-strong{font-size:14px;font-weight:bold;}
		.popover{max-width: 450px}
		.popover-content{padding-top: 0;line-height: 30px}
		.popover-content h5{padding-bottom: 5px}
	</style>
	<div class="container">
		<div class="panel panel-cut">
			<div class="panel-heading">
				选择小程序
				<a href="" class="panel-del"><i class="fa fa-times"></i></a>
			</div>
			<div class="panel-body">
				<div class="wxapp-manage">
					<a href="<?php  echo url('wxapp/post')?>" class="color-default"><i class="wi wi-registersite"></i>新建小程序</a>
					<a href="<?php  echo url('account/manage', array('account_type' => '4'))?>" class="color-default"><i class="wi wi-appsetting"></i>小程序管理</a>
				</div>
				<ul class="wxapp-cut-list clearfix">
					<?php  if(is_array($wxapp_lists)) { foreach($wxapp_lists as $list) { ?>
					<li class="wxapp-cut-item">
						<div class="wxapp-item-iphone">
							<img src="./resource/images/173.png"/>
							<div class="cover-dark">
								<a href="<?php  echo url('wxapp/display/switch', array('uniacid' => $list['uniacid'], 'multiid' => $list['versions']['multiid'], 'version_id' => $list['versions']['id']))?>" class="manage-fa"><i class="fa fa-angle-right"></i></a>
								<a href="<?php  echo url('wxapp/display/switch', array('uniacid' => $list['uniacid'], 'multiid' => $list['versions']['multiid'], 'version_id' => $list['versions']['id']))?>" class="manage">管理</a>
								<a href="<?php  echo url('wxapp/display/rank', array('uniacid' => $list['uniacid']))?>" class="stick">置顶</a>
							</div>
						</div>
						<div class="wxapp-item-detail">
							<p class="color-dark"><?php  echo $list['name'];?></p>
							<?php  if(!empty($list['versions'])) { ?>
							<p class="color-gray"><span>v<?php  echo $list['versions']['version'];?></span><span><?php  echo date('Y/m/d', $list['versions']['createtime'])?></span></p>
							<?php  } ?>
						</div>
					</li>
					<?php  } } ?>
				</ul>
			</div>				
		</div>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>