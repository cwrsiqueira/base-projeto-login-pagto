<html>

<head>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>

<body>
    <div class="container">
        <div id="statusScreenBrick_container"></div>
    </div>
    <script>
        var MERCADO_PAGO_PUBLIC_KEY = "<?php echo MERCADO_PAGO_PUBLIC_KEY; ?>";
        var BASE_URL = "<?php echo BASE_URL; ?>";
    </script>
    <script>
        const mp = new MercadoPago(MERCADO_PAGO_PUBLIC_KEY);
        const bricksBuilder = mp.bricks();
        const renderStatusScreenBrick = async (bricksBuilder) => {
            const settings = {
                initialization: {
                    paymentId: '<?= $id; ?>', // id do pagamento gerado pelo mercado pago
                },
                callbacks: {
                    onReady: () => {
                        // callback chamado quando o Brick estiver pronto
                    },
                    onError: (error) => {
                        // callback chamado para todos os casos de erro do Brick
                    },
                },
                customization: {
                    visual: {
                        showExternalReference: true,
                        hideTransactionDate: false,
                        hideStatusDetails: false,
                        texts: {
                            // customization.visual.texts.{ctaGeneralErrorLabel, ctaCardErrorLabel, ctaReturnLabel}
                            'ctaReturnLabel': 'Voltar para Assinaturas'
                        },
                    },
                    backUrls: {
                        'error': BASE_URL + '/checkoutMercadoPago',
                        'return': BASE_URL + '/subscription/',
                    }
                }
            };
            window.statusScreenBrickController = await bricksBuilder.create('statusScreen',
                'statusScreenBrick_container', settings);
        };
        renderStatusScreenBrick(bricksBuilder);
        console.log('<?= $id; ?>');
    </script>
</body>

</html>