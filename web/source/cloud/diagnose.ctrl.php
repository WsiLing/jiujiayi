<?php 
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.suibianlu.com/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

load()->model('cloud');
load()->model('setting');

$dos = array('display', 'testapi');
$do = in_array($do, $dos) ? $do : 'display';
uni_user_permission_check('system_cloud_diagnose');

$_W['page']['title'] = '云服务诊断 - 云服务';

if ($do == 'testapi') {
	$starttime = microtime(true);
	$response = cloud_request('http://www.baidu.com', array(), array('ip' => $_GPC['ip']));
	$endtime = microtime(true);
	message('请求接口成功，耗时 '.(round($endtime - $starttime, 5)).' 秒', '', 'ajax');
} else {
	if(checksubmit()) {
		setting_save('', 'site');
		message('成功清除站点记录.', 'refresh');
	}
	if (checksubmit('updateserverip')) {
		if (!empty($_GPC['ip'])) {
			setting_save(array('ip' => $_GPC['ip'], 'expire' => TIMESTAMP + 201600), 'cloudip');
		} else {
			setting_save(array(), 'cloudip');
		}
		message('修改云服务ip成功.', 'refresh');
	}
	if(empty($_W['setting']['site'])) {
		$_W['setting']['site'] = array();
	}
	$checkips = array();
	if (!empty($_W['setting']['cloudip']['ip'])) {
		$checkips[] = $_W['setting']['cloudip']['ip'];
	}
	if (strexists(strtoupper(PHP_OS), 'WINNT')) {
		$cloudip = gethostbyname('www.baidu.com');
		if (!in_array($cloudip, $checkips)) {
			$checkips[] = $cloudip;
		}
	} else {
		for ($i = 0; $i <= 10; $i++) {
			$cloudip = gethostbyname('www.baidu.com');
			if (!in_array($cloudip, $checkips)) {
				$checkips[] = $cloudip;
			}
		}
	}
	template('cloud/diagnose');
}