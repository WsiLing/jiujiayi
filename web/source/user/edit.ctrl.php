<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.suibianlu.com/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

load()->model('user');
load()->func('file');

$dos = array('edit_base', 'edit_modules_tpl', 'edit_account');
$do = in_array($do, $dos) ? $do: 'edit_base';
uni_user_permission_check('system_user_post');

$_W['page']['title'] = '编辑用户 - 用户管理';

$uid = intval($_GPC['uid']);
$user = user_single($uid);
if (empty($user)) {
	message('访问错误, 未找到该操作员.', url('user/display'), 'error');
} else {
	if ($user['status'] == 1) message('访问错误，该用户未审核通过，请先审核通过再修改！', url('user/display/check_display'), 'error');
	if ($user['status'] == 3) message('访问错误，该用户已被禁用，请先启用再修改！', url('user/display/recycle_display'), 'error');
}
$founders = explode(',', $_W['config']['setting']['founder']);
$profile = pdo_fetch('SELECT * FROM '.tablename('users_profile').' WHERE `uid` = :uid LIMIT 1',array(':uid' => $uid));
if (!empty($profile)) $profile['avatar'] = tomedia($profile['avatar']);
$avatar = file_fetch($profile['avatar']);
if (is_error($avatar)) {
	$profile['avatar'] = './resource/images/nopic-107.png';
}

if ($do == 'edit_base') {
	$user['last_visit'] = date('Y-m-d H:i:s', $user['lastvisit']);
	$user['end'] = $user['endtime'] == 0 ? '永久' : date('Y-m-d', $user['endtime']);
	$user['endtype'] = $user['endtime'] == 0 ? 1 : 2;
	if (!empty($profile)) {
		$profile['reside'] = array(
			'province' => $profile['resideprovince'],
			'city' => $profile['residecity'],
			'district' => $profile['residedist']
		);
		$profile['birth'] = array(
			'year' => $profile['birthyear'],
			'month' => $profile['birthmonth'],
			'day' => $profile['birthday'],
		);
		$profile['resides'] = $profile['resideprovince'] . $profile['residecity'] . $profile['residedist'] ;
		$profile['births'] =($profile['birthyear'] ? $profile['birthyear'] : '--') . '年' . ($profile['birthmonth'] ? $profile['birthmonth'] : '--') . '月' . ($profile['birthday'] ? $profile['birthday'] : '--') .'日';
	}
	template('user/edit-base');
}
if ($do == 'edit_modules_tpl') {
	if ($_W['isajax'] && $_W['ispost']) {
		if (intval($_GPC['groupid']) == $user['groupid']){
			message(error(2, '未做更改！') , '', 'ajax');
		}
		if (!empty($_GPC['type']) && !empty($_GPC['groupid'])) {
			$data['uid'] = $uid;
			$data[$_GPC['type']] = intval($_GPC['groupid']);
			if (user_update($data)) {
				$group_info = user_group_detail_info($_GPC['groupid']);
				message(error(0, $group_info), '', 'ajax');
			} else {
				message(error(1, '更改失败！'), '', 'ajax');
			}
		} else {
			message(error(-1, '参数错误！'), '', 'ajax');
		}
	}
	$groups = pdo_getall('users_group', array(), array('id', 'name'), 'id');
	$group_info = user_group_detail_info($user['groupid']);

	template('user/edit-modules-tpl');
}

if ($do == 'edit_account') {
	$account_detail = user_account_detail_info($uid);
	template('user/edit-account');
}