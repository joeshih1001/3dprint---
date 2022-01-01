<?php
require __DIR__ . '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

$account = $_POST['account'] ?? '';
$password = $_POST['password'] ?? '';

if(empty($account) or empty($password)){
    $output['error'] = '欄位資料不足';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = sprintf("SELECT * FROM `member` WHERE `member_account`=%s", $pdo->quote($account));

$row = $pdo->query($sql)->fetch();
if(empty($row)){
    $output['error'] = '帳號或密碼錯誤';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if($password==$row['member_password']){
    $output['success'] = true;
    $_SESSION['admin'] = [
        'account' => $row['member_account'],
        'nickname' => $row['member_nickname'],
    ];
}



echo json_encode($output);