<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>Distribuidor de Grupos regional 10</title>
  
</head>
<body>
  <h1>Distribuidor de Grupos regional 10</h1>

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

  <script>
    let grupos = [[], [], [], []];
    let pessoaSobrando = "";

    document.getElementById("names").addEventListener("input", () => {
      const nomes = document.getElementById("names").value
        .split("\n")
        .map(n => n.trim())
        .filter(n => n);
      document.getElementById("liveCount").textContent = `Total de nomes: ${nomes.length}`;
    });

    function sortearGrupos() {
      const input = document.getElementById("names").value.trim();
      const nomes = input.split("\n").map(n => n.trim()).filter(n => n);
      const grupoSize = parseInt(document.getElementById("groupSize").value);
      grupos = [[], [], [], []];
      pessoaSobrando = "";

      if (nomes.length === 0) {
        alert("Insira pelo menos um nome!");
        return;
      }

      document.getElementById("sobrando").style.display = "none";

      const shuffled = nomes.sort(() => Math.random() - 0.5);
      const maxPessoas = grupoSize * 4;

      let limite = Math.min(maxPessoas, nomes.length);
      let grupoAtual = 0;

      for (let i = 0; i < limite; i++) {
        while (grupos[grupoAtual].length >= grupoSize) {
          grupoAtual = (grupoAtual + 1) % 4;
        }
        grupos[grupoAtual].push(shuffled[i]);
        grupoAtual = (grupoAtual + 1) % 4;
      }

      if (nomes.length > maxPessoas) {
        pessoaSobrando = shuffled[maxPessoas];
        document.getElementById("sobrandoNome").textContent = pessoaSobrando;
        document.getElementById("sobrando").style.display = "block";
      }

      atualizarGrupos();
    }

    function atualizarGrupos() {
      for (let i = 0; i < 4; i++) {
        const ul = document.getElementById(`grupo${i + 1}`);
        ul.innerHTML = "";
        grupos[i].forEach((nome, index) => {
          const li = document.createElement("li");
          li.textContent = nome;
          li.onclick = () => moverPessoa(i, index);
          ul.appendChild(li);
        });
        document.getElementById(`count${i + 1}`).textContent = `Total: ${grupos[i].length}`;
      }
    }

    function adicionarSobrando() {
      const indice = parseInt(document.getElementById("grupoExtra").value);
      grupos[indice].push(pessoaSobrando);
      pessoaSobrando = "";
      document.getElementById("sobrando").style.display = "none";
      atualizarGrupos();
    }

    function moverPessoa(origem, index) {
      const nome = grupos[origem][index];
      const destino = prompt(
        `Mover "${nome}" para qual grupo? (1=Vermelho, 2=Amarelo, 3=Verde, 4=Azul)`
      );

      const destIdx = parseInt(destino) - 1;
      if (destIdx >= 0 && destIdx <= 3 && destIdx !== origem) {
        grupos[origem].splice(index, 1);
        grupos[destIdx].push(nome);
        atualizarGrupos();
      }
    }
  </script>
</body>
</html>
