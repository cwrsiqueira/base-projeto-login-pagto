<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Detalhes da Assinatura</h4>
                </div>
                <?php if (!empty($subscription)): ?>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Plano:</strong> <?php echo $subscription['plan']; ?></li>
                            <li class="list-group-item"><strong>Preço:</strong> <?php echo number_format($subscription['price'], 2, ',', '.'); ?> <?php echo $subscription['currency']; ?></li>
                            <li class="list-group-item"><strong>Status:</strong> <span class="<?php echo $status_classes[$subscription['status']]; ?>"> <?php echo ucfirst($subscription['status']); ?></span></li>
                            <li class="list-group-item"><strong>Renovação:</strong> <?php echo date('d/m/Y', strtotime($subscription['renew_at'])); ?></li>
                            <li class="list-group-item"><strong>Início:</strong> <?php echo date('d/m/Y', strtotime($subscription['created_at'])); ?></li>
                        </ul>
                        <div class="mt-4 text-center">
                            <button class="btn btn-danger">Cancelar Assinatura</button>
                        </div>
                    </div>
                <?php else: ?>
                    <?php
                    if (!empty($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>