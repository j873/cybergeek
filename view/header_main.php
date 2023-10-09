<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Cybergeek</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carrinho.php" id="cart-button">
                            <i class="fas fa-shopping-cart"></i> Carrinho
                        </a>
                    </li>
                    <?php if (isset($_SESSION['apelido'])): ?>
                        <!-- Se o usuário estiver logado, mostre seu nome e um botão de logout -->
                        <li class="nav-item">
                            <span class="nav-link">Bem-vindo, <?php echo $_SESSION['apelido']; ?>!</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Sair
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Se o usuário não estiver logado, mostre os botões de login e registro -->
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fas fa-user"></i> Logar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastro.php">
                                <i class="fas fa-user"></i> Cadastrar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>



   
