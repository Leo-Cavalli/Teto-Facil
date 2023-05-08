<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
</head>
<nav> 
  <!-- navegacao entre pags !-->
</nav>
<body>
  <h1>Bem vindo ...... <!-- nome do usuario !--></h1>
  <input type="button" value="Edit profile" onclick = "editProfile()" id="btnEditProfile">
  
  <h3>Seus anuncios </h3>
  <ul>
    <!-- lista de anuncios do usuario !-->
  </ul>
</body>
</html>

<script>
  function editProfile(){
    <?php 
    header(Location: editProfile.php);
    ?>
  }
</script>