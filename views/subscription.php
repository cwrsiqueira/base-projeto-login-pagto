<?php
switch ($subscription['status']) {
    case 'active':
        $status_class = "badge badge-success";
        break;
    case 'canceled':
        $status_class = "badge badge-danger";
        break;
    case 'expired':
        $status_class = "badge badge-warning";
        break;

    default:
        $status_class = "badge badge-secondary";
        break;
}

$status_translate = [
    'active' => 'Ativa',
    'expired' => 'Vencida',
    'canceled' => 'Cancelada',
];

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Detalhes da Assinatura</h4>
                </div>
                <?php
                if (!empty($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <?php if (!empty($subscription)): ?>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Plano:</strong> <?php echo $subscription['plan']; ?></li>
                            <li class="list-group-item"><strong>Preço:</strong> <?php echo number_format($subscription['price'], 2, ',', '.'); ?> <?php echo $subscription['currency']; ?></li>
                            <li class="list-group-item"><strong>Status:</strong> <span class="<?= $status_class ?> p-2"> <?= $status_translate[$subscription['status']] ?></span></li>
                            <li class="list-group-item"><strong>Renovação:</strong> <?php echo date('d/m/Y', strtotime($subscription['renew_at'])); ?></li>
                            <li class="list-group-item"><strong>Início:</strong> <?php echo date('d/m/Y', strtotime($subscription['created_at'])); ?></li>
                        </ul>
                        <div class="mt-4 text-center d-flex justify-content-between">
                            <a class="btn btn-success" href="<?= BASE_URL ?>subscription/plans">Renovar Assinatura</a>
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