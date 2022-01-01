<?php
require __DIR__ . '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

$name = $_POST['member_name'] ?? '';
$email = $_POST['member_email'] ?? '';
$mobile = $_POST['member_mobile'] ?? '';


//檢查欄位資料 // 

if(empty($name)){
    $output['code'] = 401;
    $output['error'] = '請輸入正確的姓名';
    echo json_encode($output); exit;
}
if(empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $output['code'] = 405;
    $output['error'] = '請輸入正確的郵件';
    echo json_encode($output); exit;
}
if(empty($mobile) or !preg_match("/^09\d{2}-?\d{3}-?\d{3}$/", $mobile)){
    $output['code'] = 408;
    $output['error'] = '請輸入正確的手機號碼';
    echo json_encode($output); exit;
}


$sql = "INSERT INTO `member`(
    `member_account`, `member_password`, 
    `member_name`, `member_nickname`, 
    `member_level`, `member_credit`, 
    `member_total_credit`, `member_coupon`, 
    `member_mobile`, `member_address`, 
    `member_email`, `member_birthday`, `member_everyday_login_record`, `member_lottery_by_day`, `member_ceate_date`) VALUES (
        ?,?,
        ?,?,
        DEFAULT,DEFAULT,
        DEFAULT,DEFAULT,
        ?,?,
        ?,?,
        DEFAULT,DEFAULT,NOW())";


$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['member_account'] ?? '',
    $_POST['member_password'] ?? '',
    $name,
    $_POST['member_nickname'] ?? '',
    $mobile,
    $_POST['member_address'] ?? '',
    $email,
    empty($_POST['member_birthday']) ? NULL : $_POST['member_birthday'],
    //資料庫要記得允許是NULL
]);

$output['success'] = $stmt->rowCount()==1;
$output['rowCount'] = $stmt->rowCount();



echo json_encode($output);