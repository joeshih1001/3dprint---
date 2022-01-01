<?php 
session_start();
$title = '登入';
$pageName = 'login';

?>

<?php include __DIR__ . '/parts/__html_head.php'?>
<?php include __DIR__ . '/parts/__navbar__user.php'?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">管理者登入介面</h5>
                        <p><a href="login-user.php">會員登入介面</a></p>
                    </div>
                    <form name="form1" onsubmit="doLogin(); return false">
                        <div class="mb-3">
                            <label for="account" class="form-label">管理員帳戶</label>
                            <input type="text" class="account" id="account" name="account">
                            
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">管理員密碼</label>
                            <input type="password" class="Password" id="Password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">登入</button>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/__scripts.php'?>
<script>
    function doLogin(){
        const fd = new FormData(document.form1);

        fetch('login_api.php', {
            method: 'POST',
            body: fd,
        }).then(r =>r.json()).then(obj=>{
            if(obj.success){
                console.log(obj);
                location.href='./index_cms.php'
            }else{
                alert(obj.error);
            }
            
            
        });
    }

</script>
<?php include __DIR__ . '/parts/__html_foot.php'?>