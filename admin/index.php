<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<body>
<section>
  <img src='../../images/einerlei_publishing_site001005.png'>
</section>
  <div id="container">
  <div id="content">
   <body>
      <h1>Admin Login</h1>

         <?php
            $msg = '';
         ?>

         <form class = "form-signin" role = "form"
            action = "./dashboard/authenticate.php"
             method = "post">

            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control"
               name = "username" placeholder = "email"
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required>
            <button class = "button-no-float" type = "submit"
               name = "login">Login</button>
         </form>
        <form action="reset.php" method="post">
          <input type="hidden" name="user-change-password" value="true">
          <input type = "submit" name = "login" id="button-no-float" value="Recover Password">
        </form>
      </div>
      </div>

   </body>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</html>
