<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style-cadastro.css">
  <title>Document</title>
</head>

<body>


  <div class="ContainerCadastro">

    <a href="/login" id="btnvoltar"></a>

    <div class="containerlogo">
      <div id="logo"></div>
    </div>
    <form id="formulario_cadastro" class="formulario_cadastro" method="POST" action="/register">
      <div class="containerse">

        @csrf
        <input type="text" id="nome" name="nome" placeholder="nome" required>
        <input type="text" id="cpf" name="cpf" placeholder="cpf" required>
        <input type="text" id="rg" name="rg" placeholder="rg" required>
        <input type="date" id="data_nascimento" name="data_nascimento" placeholder="data de nascimento" required>
        <input type="text" id="endereco" name="endereco" placeholder="endereco" required>
        <input type="text" id="telefone" name="telefone" placeholder="telefone" required>
        <input type="email" id="email" name="email" placeholder="EMAIL" required>
        <input type="email" id="confemail" name="email_confirmation" placeholder="CONFIRMAR EMAIL" required>
        <input type="password" id="senha" name="senha" placeholder="SENHA" required>
        <input type="password" id="confsenha" name="senha_confirmation" placeholder="CONFIRMAR SENHA" required>
        <select id="genero" name="genero" required>
          <option value="">Selecione</option>
          <option value="masculino" id="g1">masculino</option>
          <option value="feminino" id="g2">feminino</option>
          <option value="outro" id="g3">outro</option>
        </select>
      </div>
      <div id="msg"></div>

      <div class="containerb">
        <button id="confirmar" type="submit">confirmar</button>
      </div>

    </form>

    <button id="simular1">preencher automaticamente</button>



    <script src="js/register.js"></script>
    <script src="js/preencher-automaticamente-cadastro.js"></script>
  </div>
</body>

</html>