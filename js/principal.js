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