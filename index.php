<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>Distribuidor de Grupos Regional 10</title>
  
</head>
<body>
  <h1>Distribuidor de Grupos Regional 10</h1>

  <textarea id="names" placeholder="Digite um nome por linha..."></textarea>
  <div class="info" id="liveCount">Total de nomes: 0</div>

  <div class="controls">
    <label for="groupSize">Pessoas por grupo:</label>
    <input type="number" id="groupSize" value="7" min="1" />
    <button onclick="sortearGrupos()">Sortear</button>
  </div>

  <div class="groups">
    <div class="group red">
      <h2>Grupo Vermelho</h2>
      <ul id="grupo1"></ul>
      <div class="count" id="count1"></div>
    </div>
    <div class="group yellow">
      <h2>Grupo Amarelo</h2>
      <ul id="grupo2"></ul>
      <div class="count" id="count2"></div>
    </div>
    <div class="group green">
      <h2>Grupo Verde</h2>
      <ul id="grupo3"></ul>
      <div class="count" id="count3"></div>
    </div>
    <div class="group blue">
      <h2>Grupo Azul</h2>
      <ul id="grupo4"></ul>
      <div class="count" id="count4"></div>
    </div>
  </div>

  <div class="selector" id="sobrando" style="display: none;">
    <span id="sobrandoNome"></span> sobrou. Escolha um grupo:
    <select id="grupoExtra">
      <option value="0">Grupo Vermelho</option>
      <option value="1">Grupo Amarelo</option>
      <option value="2">Grupo Verde</option>
      <option value="3">Grupo Azul</option>
    </select>
    <button onclick="adicionarSobrando()">Adicionar</button>
  </div>
  <script src="/js/principal.js"></script>
</body>
</html>
