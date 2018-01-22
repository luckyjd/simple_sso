<!DOCTYPE html>
<html>
    <head>
    <?php header("Access-Control-Allow-Origin: *"); ?>
        <title></title>
        <meta http-equiv="Content-Type" content="text/plain; charset=UTF-8">
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    </head>
    <body>
        <form method="post" action="">
            <table border="0" cellpadding="10" cellspacing="0">
                <tr>
                    <td>Username</td>
                    <td><input type="text" id="username" name="username" value=""/></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" id="password" name="password" value=""/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='hidden' id='secret_key' value='mysecretkey'>
                        <input type='hidden' id='url_handle' value="<?php echo $_GET['url_handle']; ?>">
                        <button type="button" onclick="loadDoc()">Login</button>
                        <input type="reset" name="submit" value="Clear"/>
                        
                    </td>
                </tr>
            </table>
        </form>
        <div id="showerror"></div>
        <script language="javascript">
            function loadDoc() {
                $('#showerror').html('');
 
                var username = $('#username').val();
                var password = $('#password').val();

                // Kiểm tra dữ liệu có null hay không
                if ($.trim(username) == ''){
                    alert('Please enter your username.');
                    return false;
                }

                if ($.trim(password) == ''){
                    alert('Please enter your password');
                    return false;
                }
                
                str_send = "";
                str_send += "username=" + username + "&" + "password=" + password + "&" + "url_handle=" +  $('#url_handle').val();
                str_send += "&" + "secret_key=" + $('#secret_key').val();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    var mydata = JSON.parse(this.responseText);
                    if (mydata.status == 1) {
                        redirectPost("http://simple.sso.tinhvan.com/setallcookie.php", mydata);
                    } else { 
                        document.getElementById("showerror").innerHTML = mydata.mess;
                    }
                  }
                };
                xhttp.open("POST", "http://simple.sso.tinhvan.com/login.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(str_send);
              }
              function redirectPost(url, data) {
                var form = document.createElement('form');
                document.body.appendChild(form);
                form.method = 'post';
                form.action = url;
                for (var name in data) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    input.value = data[name];
                    form.appendChild(input);
                }
                form.submit();
                }
        </script>
    </body>
</html>