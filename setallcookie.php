<?php
    $url = $_POST['url_handle'];
    $token = $_POST['token'];
    $id = $_POST['sso_id'];
    $username = $_POST['username'];
    $url_nhat = "http://nhattx.learnphp.tinhvan.com/setcookie.php?" . "id=" . $id . "&username=" . $username . "&token=" . $token;
?>
<html>
   <head>
   <script>
   function loadComplete(){
      window.location= $('#url_handle').val();
   }
   </script>
</head>
<body onload="loadComplete()">
        
        <p>Please wait.....</p>
        <input type='hidden' id='url_handle' value="<?php echo $_POST['url_handle']; ?>">
        <img src="<?php echo $url_nhat;?>" />
        <img src="" />

    </body>
    

</html>
