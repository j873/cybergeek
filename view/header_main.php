<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cybergeek</title>
    <link rel="stylesheet" href="/index.css">

    <style>
        /* Adicione esses estilos para o formulário de pesquisa e filtro */
        #formPesquisa {
            display: flex;
            align-items: center;
        }

        #formPesquisa input,
        #formPesquisa select {
            margin-right: 10px;
        }

        #formPesquisa button {
            background-color: #007bff;
            /* Azul */
            border: 1px solid #007bff;
            /* Borda azul */
            color: #ffffff;
            /* Texto branco */
        }

        #formPesquisa button:hover {
            background-color: #0056b3;
            /* Azul mais escuro no hover */
        }

        /* Estilo para o seletor de tipo */
        #formPesquisa select {
            background-color: #9a9faa;
            /* Cinza */
            border: 1px solid #9a9fa3;
            /* Borda cinza */
            color: #495057;
            /* Cor do texto */
            margin-top: 20px;
        }

        /* Adicione um pouco de espaço abaixo do formulário de pesquisa e filtro */
        #formPesquisa {
            margin-bottom: 20px;
        }
    </style>


</head>

<body>
    <header>
        <div class="top-right">
            <ul class="nav-links">
                <li>
                    <?php if (isset($_SESSION['apelido'])) : ?>
                        <span>Bem-vindo, <?php echo $_SESSION['apelido']; ?>!</span>
                        <a href="logout.php">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </a>
                    <?php else : ?>
                        <a href="login.php">
                            <i class="fas fa-user"></i> Logar
                        </a>
                </li>
                <li>
                    <a href="cadastrar.php">
                        <i class="fas fa-user"></i> Cadastrar
                    </a>
                </li>
            <?php endif; ?>
            <li>
                <a href="carrinho.php" id="cart-button">
                    <img src="img/fotor-ai-2023111321025-removebg-preview.png" alt="Ícone do Carrinho">
                </a>
            </li>
            </ul>
        </div>
        <nav class="navbar navbar-expand-lg ">
            <a href="index.php" id="cart-button">
                <img src="img/logo1.png" alt="Ícone da logo">
                <p>Cybergeek</p>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">

                        <form class="form-inline" id="formPesquisa">
                            <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" name="searchTerm">
                            <button class="btn btn-outline-primary my-2 my-sm-0 pesquisar" type="submit">Pesquisar</button>
                        </form>
                    </li>
                    <li>

                        <form id="formPesquisa">
                            <select class="form-control mr-sm-2" name="searchTerm">
                                <option value="" selected>Todos os Tipos</option>
                                <option value="roupa">Roupa</option>
                                <option value="funko pop">Funko Pop</option>
                                <option value="decoracao">Decoração</option>
                                <option value="cosplay">Cosplay</option>
                            </select>
                            <button class="btn btn-outline-primary my-2 my-sm-0 pesquisar" type="submit">Filtrar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</body>

</html>

<script>
    $(document).ready(function() {
        $("#formPesquisa").submit(function(event) {
            event.preventDefault(); // Impede que o formulário seja enviado normalmente

            // Obtém o valor do campo de pesquisa
            var searchTerm = $("input[name='searchTerm']").val();

            // Envia uma solicitação AJAX para buscar os resultados da pesquisa
            $.ajax({
                url: "processar_search.php", // Substitua pelo caminho do seu script de pesquisa no servidor
                type: "GET",
                data: {
                    searchTerm: searchTerm
                },
                dataType: 'html', // Você pode ajustar isso com base na resposta do servidor
                success: function(response) {
                    // Atualiza a parte da página que deseja mostrar os resultados
                    $("#resultadosDaPesquisa").html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Erro na pesquisa: ' + error);
                }
            });
        });
    });
</script>