<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style-login.css">
  <title>Document</title>
</head>

<body>


  <div class="containerlogin">

    <div id="btnvoltar"></div>

    <div class="containerlogo">
      <div id="logo"></div>
    </div>


    <form id="formulario_login" class="formulario_login" method="POST" action="/login">

      @csrf
      <div class="containerse">
        <input type="email" id="email" placeholder="EMAIL">
        <input type="password" id="senha" placeholder="SENHA">
      </div>

      <div id="msg1"></div>
      <div class="containerb">
        <button id="entrar" type="submit">entrar</button>
      </div>
    </form>


    <a href="/cadastro" id="nao">ainda não tenho conta!</a>

  </div>


    <script src="../js/login.js"></script>
</body>

</html>