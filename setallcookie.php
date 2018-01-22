<?php
    $url = $_POST['url_handle'];
    $token = $_POST['token'];
    $id = $_POST['sso_id'];
    $username = $_POST['username'];
    $url_nhat = "http://nhattx.learnphp.tinhvan.com/setcookie.php?" . "id=" . $id . "&username=" . $username . "&token=" . $token;
    $url_nghia= "http://nghiatt1.com/edx1/set_cookie.php?" . "id=" . $id . "&username=" . $username . "&token=" . $token;
?>
<html>
   <head>
   <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
</head>
<body onload="loadComplete()">
        
        <p>Please wait.....</p>
        <input type='hidden' id='url_handle' value="<?php echo $_POST['url_handle']; ?>">
        <img src="<?php echo $url_nhat;?>" />
        <img src="<?php echo $url_nghia;?>"/>
        <img src="" />

    </body>
    <script>
   function loadComplete(){
      window.location= $('#url_handle').val();
   }
   </script>

</html>
