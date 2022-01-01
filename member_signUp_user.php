<?php
require __DIR__ . '/parts/__connect_db.php';
$title = '會員註冊';
$pageName = 'member_signUp';



?>
<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__navbar__user.php' ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <h3 class="card-title bg-primary">會員註冊</h3>

                <form name="form1" onsubmit="sendData(); return false;">
                        <div class="mb-3">
                            <label for="member_account" class="form-label">會員帳戶</label>
                            <input type="text" class="form-control" id="member_account" name="member_account">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_password" class="form-label">密碼</label>
                            <input type="text" class="form-control" id="member_password" name="member_password">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_name" class="form-label">姓名</label>
                            <input type="text" class="form-control" id="member_name" name="member_name">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_nickname" class="form-label">暱稱</label>
                            <input type="text" class="form-control" id="member_nickname" name="member_nickname">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_mobile" class="form-label">手機號碼</label>
                            <input type="text" class="form-control" id="member_mobile" name="member_mobile">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_email" class="form-label">email</label>
                            <input type="email" class="form-control" id="member_email" name="member_email">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_birthday" class="form-label">生日</label>
                            <input type="date" class="form-control" id="member_birthday" name="member_birthday">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_address" class="form-label">居住地址</label>
                            <input type="text" class="form-control" id="member_address" name="member_address">
                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">送出註冊</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">會員新增成功</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


</div>
<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    const name = document.querySelector('#member_name');
    const account = document.querySelector('#member_account');
    const password = document.querySelector('#member_password');
    const mobile = document.querySelector('#member_mobile');
    const email = document.querySelector('#member_email');

    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));

    const email_re = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;  //驗證郵件//
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/; //驗證手機//
    


    function sendData() {

        name.nextElementSibling.innerHTML = '';
        account.nextElementSibling.innerHTML = '';
        password.nextElementSibling.innerHTML = '';
        mobile.nextElementSibling.innerHTML = '';
        email.nextElementSibling.innerHTML = '';

        let isPass = true;

        if(!account.value){
            isPass = false;
            account.nextElementSibling.innerHTML = `<div class="alert alert-danger" role="alert">請輸入帳戶
            </div>`;
        }

        if(!password.value){
            isPass = false;
            password.nextElementSibling.innerHTML = `<div class="alert alert-danger" role="alert">請輸入密碼
            </div>`;
        }

        if(!name.value || name.value.length <2){
            isPass = false;
            name.nextElementSibling.innerHTML = `<div class="alert alert-danger" role="alert">請輸入正確姓名
            </div>`;
        }

        if(!email.value || !email_re.test(email.value) ){
            isPass = false;
            email.nextElementSibling.innerHTML = `<div class="alert alert-danger" role="alert">請輸入正確郵件
            </div>`;
        }

        if(!mobile.value || !mobile_re.test(mobile.value) ){
            isPass = false;
            mobile.nextElementSibling.innerHTML = `<div class="alert alert-danger " role="alert">請輸入正確手機號碼
            </div>`;
        }


        if (isPass) {

            const fd = new FormData(document.form1);

            fetch('member_signUp_user_api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json())
                .then(obj => {
                    if(obj.success){
                        console.log(obj);
                        alert('感謝加入會員!');
                        location.href = 'index_user.php';
                    } else {
                        document.querySelector(".modal-body").innerHTML = obj.error || '資料新增發生錯誤';
                        modal.show();
                    }
                })
        }
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>