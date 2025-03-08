<div class="container mt-5">
    <div class="row justify-content-center" style="margin-bottom: 100px;">
        <div class="col-md">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Checkout</h4>
                </div>
                <?php
                if (!empty($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <div class="card-body text-center">
                    <div class="text-left">
                        <h4>Dados do Cliente</h4>
                        <div class="row my-3">
                            <div class="col-sm">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control input-txt" id="email" value="<?= $user['email']; ?>" readonly>
                            </div>
                            <div class="col-sm">
                                <label for="business_first_name">Nome</label>
                                <input type="text" name="business_first_name" class="form-control input-txt" id="business_first_name" value="<?= $user['name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="payment">
                            <h4>Dados do Pagamento</h4>
                            <div class="before_Brick_container">
                                Plano: <?= $plan ?> - Preço: R$ <?= number_format($price, 2, ',', '.') ?>
                                <input type="hidden" class="subscription_value" value="<?= $price ?>" data-plan="<?= $plan ?>">
                            </div>
                            <div class="text-left">
                                <div id="cardPaymentBrick_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    var MERCADO_PAGO_PUBLIC_KEY = "<?php echo MERCADO_PAGO_PUBLIC_KEY; ?>";
</script>

<script>
    const mp = new MercadoPago(MERCADO_PAGO_PUBLIC_KEY);
    const bricksBuilder = mp.bricks();

    function renderPaymentForm() {

        const renderCardPaymentBrick = async (bricksBuilder) => {

            const settings = {
                initialization: {
                    amount: document.querySelector('.subscription_value').value
                },

                callbacks: {
                    onReady: () => {
                        // callback chamado quando o Brick estiver pronto
                        document.querySelector('.before_Brick_container').classList.add('hidden');
                    },

                    onSubmit: (cardFormData) => {
                        // callback chamado o usuário clicar no botão de submissão dos dados
                        let cardholderName = document.querySelector('input[name=HOLDER_NAME]').value;
                        let transaction_amount = document.querySelector('.subscription_value').value;
                        let description = document.querySelector(
                            '.subscription_value').getAttribute('data-plan');
                        let data = [
                            "transactionAmount=" + transaction_amount +
                            "&token=" + cardFormData.token +
                            "&description=" + description +
                            "&installments=" + cardFormData.installments +
                            "&paymentMethodId=" + cardFormData.payment_method_id +
                            "&issuer=" + cardFormData.issuer_id +
                            "&cardholderEmail=" + cardFormData.payer.email +
                            "&identificationType=" + cardFormData.payer.identification
                            .type +
                            "&identificationNumber=" + cardFormData.payer.identification
                            .number,
                            "&cardholderName=" + cardholderName
                        ];

                        // ejemplo de envío de los datos recolectados por el Brick a su servidor
                        return new Promise((resolve, reject) => {
                            const xhr = new XMLHttpRequest();
                            xhr.open('POST', BASE_URL + 'checkoutMercadoPago/process_payment',
                                true);
                            xhr.setRequestHeader("Content-type",
                                "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = () => {
                                if (xhr.readyState == 4) {
                                    if (xhr.status == 200) {
                                        let res = JSON.parse(xhr.responseText);
                                        console.log('Resolve: ' + res.id);
                                        window.location.replace(BASE_URL +
                                            "checkoutMercadoPago/statusScreen/" + res.id);
                                        resolve();
                                    } else {
                                        console.log('Resolve: ' + xhr.responseText);
                                        window.location.replace(BASE_URL +
                                            "checkoutMercadoPago");
                                        reject();
                                    }
                                }
                            }
                            xhr.send(data);
                        });
                    },

                    onError: (error) => {
                        // callback chamado para todos os casos de erro do Brick
                        console.log(error);
                    },
                },
            };

            const cardPaymentBrickController = await bricksBuilder.create('cardPayment',
                'cardPaymentBrick_container',
                settings);
        };

        renderCardPaymentBrick(bricksBuilder);
    }

    renderPaymentForm();
</script>