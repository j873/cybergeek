<head>
    <style>
        /* Estilos para o corpo da página */
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            position: relative;
        }

        /* Estilos para o conteúdo principal */
        .main-content {
            margin-bottom: 50px;
            /* Altura do footer */
        }

        /* Estilos para o footer */
        #myFooter {
            background-color: #333;
            color: #fff;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 0;
            /* Espaçamento interno */
        }
    </style>
</head>

<body>
    <footer class="bg-dark text-light text-center py-3">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Seu E-commerce. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>