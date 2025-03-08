<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Base - Login</title>
    <link rel="icon" href="<?= BASE_URL ?>assets/images/logo.png" type="image/png">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg">
            <div class="text-center">
                <img src="<?= BASE_URL ?>assets/images/logo.png" alt="Logo" class="logo mb-3" width="150">
                <h4 class="mb-3">Projeto Base<br>Login</h4>
            </div>
            <?php
            if (!empty($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <form action="<?= BASE_URL ?>auth/login" method="POST">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Digite a senha" aria-label="Digite a senha" aria-describedby="showPass" id="password" name="password">
                        <div class="input-group-append">
                            <span class="input-group-text" style="cursor: pointer;" id="showPass">
                                <i class="fa-solid fa-eye"></i>
                                <i class="fa-solid fa-eye-slash d-none"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </form>
            <div class="text-center mt-3">
                <a href="<?= BASE_URL ?>auth/signup" class="text-muted">Não tenho cadastro</a>
            </div>
            <div class="text-center mt-3">
                <a href="<?= BASE_URL ?>auth/forgotPassword" class="text-muted">Esqueci a senha</a>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>assets/js/login.js"></script>
</body>

</html>