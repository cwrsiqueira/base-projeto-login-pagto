<?php
class checkoutMercadoPagoController extends controller
{
    protected $user;

    public function __construct()
    {
        if (!(new User)->isLogged()) {
            header("Location: " . BASE_URL . "auth");
            exit;
        }

        $this->user = $_SESSION['user'];
    }

    public function index(string $plan)
    {
        $dados = [
            'user' => $this->user,
            'title' => 'Checkout'
        ];

        if ($plan === 'planoanual') {
            $dados['price'] = 119.90;
            $dados['plan'] = 'Plano Anual';
        } else {
            $dados['price'] = 179.60;
            $dados['plan'] = 'Plano Vitalício';
        }

        $this->loadTemplate('checkoutMercadoPago', $dados);
    }

    public function process_payment()
    {
        echo json_encode($_POST);
        exit;

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (float)$_POST['transactionAmount'];
        $payment->token = $_POST['token'];
        $payment->description = $_POST['description'];
        $payment->installments = (int)$_POST['installments'];
        $payment->payment_method_id = $_POST['paymentMethodId'];
        $payment->issuer_id = (int)$_POST['issuer'];

        $payer = new MercadoPago\Payer();
        $payer->email = $_POST['cardholderEmail'];
        $payer->identification = array(
            "type" => $_POST['identificationType'],
            "number" => $_POST['identificationNumber']
        );
        $payer->first_name = $_POST['cardholderName'];
        $payment->payer = $payer;

        $payment->save();

        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );

        if ($response['status'] === 'approved') {
            $addSubscription = (new Subscription)->addSubscription($this->user['tenant_id'], 'Standard', '0.00', 'BRL', 'active', date('Y-m-d 23:59:59', strtotime('+1 year')));
            // $addSubscription = (new Subscriptions())->add($this->user['id'], $response['id'], $payment->description);
            if ($addSubscription) {
                $_SESSION['message'] = ["success" => "Assinatura atualizada com sucesso!."];
            } else {
                $_SESSION['message'] = ["danger" => "Desculpe. O pagamento foi concluído, porém algo deu errado no registro/atualização da assinatura no sistema. Por favor, entre em contato com o suporte e informe este erro. Obrigado pela compreensão."];
            }
        } else {
            $_SESSION['message'] = ["danger" => "Desculpe. Algo deu errado e não foi possível concluir o pagamento."];
        }

        // (new Orders())->add($this->user['id'], $response['id'], $response['status'], $response['status_detail'], $payment->description, $payment->transaction_amount);

        $user = (new User())->getById($this->user['id']);
        // $order = (new Orders())->getLastOrderApprovedByUserId($this->user['id']);
        // $subscription = (new Subscriptions())->getById($this->user['id']);

        /*
        $to = $user['email'];
        $subject = "Atualização de Assinatura";
        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Syscontab - Atualização de Assinatura</title>
        </head>
        <body>
            <h2>Obrigado pela preferência.</h2>
            <h3>Assinatura atualizada com sucesso!</h3>
            <br>
            <p>Obrigado, <b>' . $user['business_first_name'] . '</b>.</p>
            <p>Sua assinatura foi atualizada e você garantiu mais 1 ano de acesso ao sistema Syscontab para continuar utilizando o melhor e mais simples sistema
                contábil gerencial do Brasil.</p>
            <p>Segue abaixo os detalhes da sua assinatura:</p>
            <ul>';

        switch ($order['plan']) {
            case 'SysContab Plano Empresário':
                $body .= "
                    <li>Plano Empresário
                        <ul>
                            <li>Acesso completo ao sistema por 1 ano</li>
                            <li>Suporte Horário Comercial</li>
                            <li>Plano para 1 empresa</li>
                        </ul>
                    </li>
                    ";
                break;
            case 'SysContab Plano Contador':
                $body .= "
                    <li>Plano Contador
                        <ul>
                            <li>Acesso completo ao sistema por 1 ano</li>
                            <li>Suporte Horário Comercial</li>
                            <li>Plano para até 100 empresas</li>
                        </ul>
                    </li>
                    ";
                break;
            case 'SysContab Plano Executivo':
                $body .= "
                    <li>Plano Executivo
                        <ul>
                            <li>Acesso completo ao sistema por 1 ano</li>
                            <li>Suporte 24/7 (24 horas/dia, 7 dias/semana)</li>
                            <li>Plano para até 500 empresas</li>
                        </ul>
                    </li>
                    ";
                break;
            default:
                "<li>Desculpe! O sistema não conseguiu identificar o plano de assinatura. Favor entrar em contato com o suporte. Obrigado.</li>";
                break;
        }


        $body .= '</ul>
            <p>Sua assinatura está ATIVA com vencimento em ' . date('d/m/Y', strtotime($subscription['due_date'])) . '.</p>
            <p>Esperamos estar atendendo às suas expectativas e estamos a disposição para críticas, sugestões e reclamações. É com o seu
                feedback que poderemos melhorar o sistema e te atender cada vez melhor.</p>
            <p>Muito obrigado e estamos a disposição.</p>
            <br>
            <br>
            <p><b>Carlos Wagner R. Siqueira</b><br>
                CEO Syscontab<br>
                suporte@syscontab.com
            </p>
        </body>
        </html>
        ';*/

        // (new emailController())->enviarEmail($to, $subject, $body);

        echo json_encode($response);
    }

    public function statusScreen($id)
    {
        $data = [
            'id' => $id,
            'user' => $this->user,
            'title' => 'Status do Pagamento',
        ];

        $this->loadTemplate('checkoutMercadoPagoStatusScreen', $data);
    }
}
