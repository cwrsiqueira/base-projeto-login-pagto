<?php
switch ($subscription['status'] ?? '') {
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

$status_payment_translate = [
    'pending' => 'Pendente',
    'paid' => 'Pago',
    'failed' => 'Falhou',
];

$method_payment_translate = [
    'credit_card' => 'Cartão de Crédito'
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

    <div class="row">
        <h4>Pagamentos</h4>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Moeda</th>
                        <th>Status</th>
                        <th>Método de Pagamento</th>
                        <th>Id da transação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $item): ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= date('d/m/Y', strtotime($item['created_at'])) ?></td>
                            <td><?= number_format($item['amount'], 2, ',', '.') ?></td>
                            <td><?= $item['currency'] ?></td>

                            <?php switch ($item['status']) {
                                case 'pending':
                                    $status_payment_class = "badge badge-warning";
                                    break;
                                case 'paid':
                                    $status_payment_class = "badge badge-success";
                                    break;
                                case 'failed':
                                    $status_payment_class = "badge badge-danger";
                                    break;

                                default:
                                    $status_payment_class = "badge badge-secondary";
                                    break;
                            } ?>

                            <td><span class="<?= $status_payment_class ?> p-2"> <?= $status_payment_translate[$item['status']] ?></span></td>
                            <td><?= $method_payment_translate[$item['payment_method']] ?></td>
                            <td><?= $item['transaction_id'] ?></td>
                            <td>
                                <a title="Visualizar" href="<?= BASE_URL ?>subscription/view/<?= $item['id'] ?>" class="btn btn-success"><i class="fa-regular fa-eye"></i></a>
                                <a title="Editar" href="<?= BASE_URL ?>subscription/edit/<?= $item['id'] ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a title="Excluir" href="<?= BASE_URL ?>subscription/delete/<?= $item['id'] ?>" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>