<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Base - Esqueci a senha</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg">
            <div class="text-center">
                <img src="<?= BASE_URL ?>assets/images/logo.png" alt="Logo" class="logo mb-3" width="150">
                <h4 class="mb-3">Projeto Base<br>Esqueci a senha</h4>
            </div>
            <form action="<?= BASE_URL ?>auth/login" method="POST">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Resetar senha</button>
            </form>
            <div class="text-center mt-3">
                <a href="<?= BASE_URL ?>auth/login" class="text-muted">Lembrei a senha</a>
            </div>
        </div>
    </div>
</body>

</html>