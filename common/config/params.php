<?php

$config['site_lang'] = ['zh-CN', 'en-US'];
$config['site_name_en-US'] = 'AceMap'; //英文网站名称
$config['site_name_zh-CN'] = 'AceMap'; //中文网站名称
$config['site_url'] = 'http://www.acemap.info'; //网站URL
$config['admin_url'] = 'http://admin.acemap.info'; //后台管理URL
$config['admin_super_user_id'] = [1]; //超级管理员不受权限管理
$config['admin_login_max_count'] = 2; //管理员登录错误默认数量，之后会被锁定，只能联系管理员去后台重置密码
$config['user_login_max_count'] = 5; //用户登录错误默认数量，之后会被锁定，只能通过重置密码
$config['user_name_field'] = 'username'; //用户名在用户表中对应的字段名，以便在发送邮件时替换，如果字段不存在将使用邮件地址替换
$config['email_reset_token_expire'] = 24 * 3600; //邮箱重置密码有效期默认1天
$config['email_code_expire'] = 300; //邮箱验证码过期时间
$config['email_ip_max_count'] = 50; //每个IP在一天发送相同邮箱的总数
$config['email_send_count'] = 50; //每个邮箱当日发送总数
$config['email_send_time'] = 60; //每次发送时间隔60秒
$config['email_send'] = [
    'smtp_server' => 'smtpdm.aliyun.com',
    'smtp_server_port' => 465, //阿里云禁用25
    'smtp_user' => $config['site_name_en-US'],
    'smtp_user_mail' => 'noreply@notice.jjcms.com',
    'smtp_pass' => 'AceMap'
];
$config['email_register_code'] = [
    'zh-CN' => [
        'subject' => '邮箱注册验证码',
        'body' => '亲爱的用户：您正在{site_name_zh-CN}通过邮箱注册，本次验证码{code}，5分钟内有效，验证码告诉他人将导致账号被盗，请勿泄露。'
    ],
    'en' => [
        'subject' => '{site_name_en-US} email registration verification code',
        'body' => 'Dear User: You are registering with {site_name_en-US} via email. This verification code {code} is valid within 5 minutes. If the verification code tells others that the account will be stolen, please do not disclose it.'
    ],
];
$config['email_register_success'] = [
    'zh-CN' => [
        'subject' => '{site_name_zh-CN} 注册成功',
        'body' => '亲爱的用户 {username}：您已在{site_name_zh-CN}网站注册成功，使用电子邮箱登录。'
    ],
    'en' => [
        'subject' => '{site_name_en-US} registered successfully',
        'body' => 'Dear User {username}: You have successfully registered on the {site_name_en-US} website and log in using your email address.'
    ],
];

return $config;
