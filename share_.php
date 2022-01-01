<?php
require __DIR__ . '/parts/__connect_db.php';

$sql = "SELECT * FROM `share_item`";
$rows = $pdo->query($sql)->fetchAll();


?>
<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__navbar.php' ?>


<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6">

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">會員ID</th>
            <th scope="col">訂單ID</th>
            <th scope="col">訂單種類</th>
            <th scope="col">分享物件標題</th>
            <th scope="col">分享物件照片</th>
            <th scope="col">分享物件井號</th>
            <th scope="col">建立日期</th>
            <th scope="col">分享物件描述</th>
            <th scope="col">分享物件讚數</th>
            <th scope="col">分享物件被收藏</th>
            <th scope="col">分享狀態</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach($rows as $row): ?>
          <tr>
            <th scope="row"><?= $row['share_item_id'];?></th>
            <th scope="row"><?= $row['member_id'];?></th>
            <th scope="row"><?= $row['share_order_id'];?></th>
            <th scope="row"><?= $row['share_order_category'];?></th>
            <th scope="row"><?= $row['share_title'];?></th>
            <th scope="row"><?= $row['share_img'];?></th>
            <th scope="row"><?= $row['share_hash'];?></th>
            <th scope="row"><?= $row['share_date'];?></th>
            <th scope="row"><?= $row['share_desc'];?></th>
            <th scope="row"><?= $row['share_liked'];?></th>
            <th scope="row"><?= $row['share_saved'];?></th>
            <th scope="row"><?= $row['share_status'] = '1' ? "已分享" : "未分享";?></th>
          </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>
</div>


<?php include __DIR__ . '/parts/__scripts.php' ?>
<?php include __DIR__ . '/parts/__html_foot.php' ?>