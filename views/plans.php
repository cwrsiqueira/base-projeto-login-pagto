<div class="container mt-5">
    <h2 class="text-center mb-4">Escolha seu Plano</h2>
    <div class="row justify-content-center">
        <?php foreach ($plans as $plan) : ?>
            <div class="col-md-4">
                <div class="card text-center mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4><?php echo $plan['name']; ?></h4>
                    </div>
                    <div class="card-body">
                        <p><?php echo $plan['description']; ?></p>
                        <h3 class="text-success">R$ <?php echo number_format($plan['price'], 2, ',', '.'); ?></h3>
                        <small class="text-muted"><?php echo $plan['billing_cycle']; ?></small>
                        <br><br>
                        <a href="#" class="btn btn-success">Assinar Agora</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>