<?php

return [
  'menu' => [
    'users' => '管理員',
    'users_setting' => '管理員設定',
    'roles' => '角色權限設定',
    'user_groups' => '管理員群組',
    'suppliers' => '供應商管理',

    'test' => '測試',
    'template' => '模板',
    'audits' => '異動紀錄',
  ],
  'audits' => [
    'user' => '管理員',
    'event' => '動作',
    'auditing' => '操作紀錄',
    'created' => '「:name」 => [:new]',
    'updated' => '「:name」 => [:new]',
    'deleted' => '「:name」 => [:old]',
    'menu' => '選單',
  ],
  'users' => [
    'name' => '名稱',
    'email' => '信箱',
    'roles' => '角色',
    'password' => '密碼',
    'password_error' => '密碼錯誤',
    'password_confirmation' => '密碼確認',
    'status' => '狀態',
  ],
  'roles' => [
    'name' => '角色名稱',
    'permissions' => '角色權限',
    'super_admin_err' => '該角色不能 刪除 或 修改',
  ]
];
