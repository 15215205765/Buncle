<?php
//载入ucpass类
require_once('lib/Ucpaas.class.php');

//初始化必填
//填写在开发者控制台首页上的Account Sid
$options['accountsid']='78863b7b5f77b676061188946c09767d';
//填写在开发者控制台首页上的Auth Token
$options['token']='af51905b29824549ad30bfea373e5546';

//初始化 $options必填
$ucpass = new Ucpaas($options);