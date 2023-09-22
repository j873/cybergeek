<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/6dda5f6271.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript">
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");

        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('uf').value = (conteudo.uf);

            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('uf').value = "...";


                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>
    <style>
        dialog {
            width: 34%;
        }
    </style>
    <div>
        <dialog id="Dialog">
            <p>
                <label>Cep:
                    <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" />
                </label><br />
                <label>Rua:
                    <input name="rua" type="text" id="rua" size="60" /></label><br />
                <label>Bairro:
                    <input name="bairro" type="text" id="bairro" size="40" /></label><br />
                <label>Cidade:
                    <input name="cidade" type="text" id="cidade" size="40" /></label><br />
                <label>Estado:
                    <input name="uf" type="text" id="uf" size="2" /></label><br />
            </p>
            <button id="hide">Voltar</button>

        </dialog>
        <button id="show">CEP</button>
    </div>
    <script type="text/JavaScript">
        (function() { var dialog = document.getElementById('Dialog'); document.getElementById('show').onclick = function() { dialog.show(); }; document.getElementById('hide').onclick = function() { dialog.close(); }; })();
    </script>
</head>

<body>
    <header>
        <header>
            <form action="#" method="post">
                <input type="text" name="search" id="search">
                <button type="submit"><i>Pesquisa</i></button>
            </form>
            <div class="container" id="menu">
                <div class="logo"><img src="img/WhatsApp Image 2023-08-30 at 20.40 1.svg"></div>
                <div class="carrinho"><img src="img/icons8-carrinho-de-compras-64.png" alt="Carinhho"></div>
                <div class="menu">
                    <nav>
                        <a href="#categoria">Categorias</a>
                        <a href="#ofertas">Ofertas</a>
                        <a href="#historico">Historico</a>
                        <a href="#contato">Contato</a>
                        <a href="login.php">Logar</a>
                        <a href="cadastrar.php">Crie sua Conta </a>
                        <a href="#compras">Compras</a>
                    </nav>
                </div>
        </header>
        <section id="ofertas">
            <div class="container1">
                <h2>Moletom unissex Akastuki Naruto</h2>
                <a href=""><img src="img/images.png" alt="moletom_naruto"></a>
                <p>De 149,90 por 49,90</p>
                <details>
                    <summary>Descrição</summary>
                    <p>Tem no tamanho PP, P, M, G, GG e XGG</p>
                </details>

                <h2>Funko Pop do Harry potter</h2>
                <a href=""><img src="img/funko.pop_luna.jpg" alt="funko_luna"></a>
                <p>De 180,90 por 100,00</p>
                <details>
                    <summary>Descrição</summary>
                    <p>Funko Pop da Personagem Luna de Harry potter</p>
                </details>

                <h2>Caneca do Naruto</h2>
                <a href=""><img src="img/presentes-animes-4.webp" alt="Caneca_naruto"></a>
                <p>De 70,90 por 49,90</p>
                <details>
                    <summary>Descrição</summary>
                    <p>Caneca do Naruto e do Sasuke</p>
                </details>
                
                <h2>Luminaria Do Dragon Ball</h2>
                <a href=""><img src="img/luminari_dragonball.webp" alt="Luminaria"></a>
                <p>De 379,90 por 249,90</p>
                <details>
                    <summary>Descrição</summary>
                    <p>Luminaria Do Shen-long</p>
                </details>
            </div>
        </section>

        </main>

</body>
<footer id="contato">
    <a href="#menu">Voltar para Cima</a>
    <p>Entre em Contato:</p>
    <a href="">
        <p><button><i class="fa-brands fa-whatsapp"></i></button>(41)989026701</p>
    </a>
    <a href="">
        <p>E-mai:jd9730541@gmail.com</p>
    </a>

    </div>
</footer>

</html>