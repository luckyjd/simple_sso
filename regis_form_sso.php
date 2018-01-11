<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> SSO registration</title>
    </head>
    <body>
        <h1>Registration on SSO</h1>
        <?php
        if ($_POST['error'] == 'pass'){
            echo "Success regis <br>";
            echo "Go to <a href='login.php'>Login page </a>";
        } else {
            echo $_POST['error'] . '<br>';
            echo '
            <form action="http://simple.sso.tinhvan.com/regis.php" method="POST">
                <table cellpadding="0" cellspacing="0" border="1">
                    <tr>
                        <td>
                            Username : 
                        </td>
                        <td>
                            <input type="text" name="username" size="50" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password :
                        </td>
                        <td>
                            <input type="password" name="password" size="50" />
                        </td>
                        
                    </tr>
                </table>
                <input type="hidden" name="url_handle" value="http://simple.sso.tinhvan.com/regis_form_sso.php">
                <input type="hidden" name="secret_key" value="mysecretkey">
                <input type="submit" value="Submit" />
                <input type="reset" value="Reset" />
            </form> ';
        }
        ?>
    </body>
</html>