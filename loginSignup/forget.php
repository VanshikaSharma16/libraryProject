<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forget.css">
</head>

<body>
    <div class="container1">
        <h1 id="hd">Change Password</h1>
        <div id="code_id" class="cont1">
            <h1 id="codehead">Varification</h1>
            <form action="forgetdb.php" id="form_varify" method="post">

                <div id="err" style="color: red; margin-bottom:2.5vh; font-weight: bold;">
                    <?php if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'nouser') {
                            echo 'Could not send varification! <br> The User Doesnot Exist.<br>';
                            header("Refresh:3; url=forget.php");
                        }
                    } ?>
                </div>

                <label for="user_v">UserName</label> <br>
                <input type="email" id="ml" name="user_v" required><br><br>

                <input type="submit" id="sub" value="VARIFY">
            </form>

        </div>

        <div id="forgot" class="cont1">

            <div class="cross">
                <box-icon name='x' size="5vh" display="inline-block" color="white" id="crs"></box-icon>
                <script>
                    document.getElementById('crs').onclick = function() {
                        location.href = "home.php";
                    }
                </script>
                <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

            </div>
            <h1>Change Password</h1>
            <form action="#" id="form_chngpwd" method="post">

                <div id="err" style="color: red; margin-bottom: 2.5vh; font-weight: bold;">
                    <?php if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'codenotmatch') {
                            echo 'Could not Change Password! <br> Your Code is incorrect.<br>';
                            header("Refresh:2; url=forget.php");
                        }
                    } ?>
                </div>
    
                <div id="err" style="color: red; margin-bottom: 2.5vh; font-weight: bold;">
                    <?php if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'passworderror') {
                            echo 'Could not Change Password! <br> The Password and Confirm Password does not match.<br>';
                            header("Refresh:2; url=forget.php");
                        }
                    } ?>
                </div>

                <label for="code">Varification Code</label><br>
                <input type="text" id="code" name="code" minlength="6" required>
                <br><br>

                <label for="vpwd">Password</label><br>
                <input type="password" id="vpwd" name="vpwd" minlength="8" required>
                <box-icon type='solid' name='low-vision' color='white' size='3vh' id="eye3" display='inline-block' class="eye"></box-icon>
                <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
                <br><br>

                <label for="vconfirm_pwd">Confirm Password</label><br>
                <input type="password" id="vconfirm_pwd" name="vconfirm_pwd" minlength="8" required>
                <box-icon type='solid' name='low-vision' color='white' size='3vh' id="eye4" display='inline-block' class="eye"></box-icon>
                <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
                <br><br>

                <input type="submit" id="sub" value="SUBMIT">
            </form>
        </div>

    </div>
    <script src="javas.js"></script>
    <script>
        let eyeicon = document.getElementById("eye3");
        let password = document.getElementById("vpwd");

        let eyeicon1 = document.getElementById("eye4");
        let password1 = document.getElementById("vconfirm_pwd");

        eyeicon.onclick = function() {
            if (password.type == "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }


        eyeicon1.onclick = function() {
            if (password1.type == "password") {
                password1.type = "text";
            } else {
                password1.type = "password";
            }
        }
    </script>
</body>

</html>