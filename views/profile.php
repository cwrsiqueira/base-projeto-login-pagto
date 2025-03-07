<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Perfil do Usuário</h4>
                </div>
                <?php
                if (!empty($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <div class="card-body text-center">
                    <form method="POST">
                        <div class="mb-3 text-start">
                            <label class="form-label">Tenant</label>
                            <input type="text" class="form-control" value="<?php echo $user['tenant_nome']; ?>" disabled>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" value="<?php echo $user['role']; ?>" disabled>
                        </div>
                        <hr>
                        <h5 class="text-start">Preencha as senhas para alterar</h5>
                        <div class="mb-3 text-start">
                            <label class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Digite a senha para alterar">
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label">Confirmar Nova Senha</label>
                            <input type="password" class="form-control" name="password_confirm" placeholder="Confirme a senha para alterar">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>