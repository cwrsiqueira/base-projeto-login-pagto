<?php
class Subscription
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function addSubscription(int $tenant_id, string $plan, string $price, string $currency, string $status, string $renew_at): bool
    {
        $sql = $this->db->prepare("INSERT INTO subscriptions SET tenant_id = :tenant_id, plan = :plan, price = :price, currency = :currency, status = :status, renew_at = :renew_at");
        $sql->bindParam(':tenant_id', $tenant_id, PDO::PARAM_INT);
        $sql->bindParam(':plan', $plan, PDO::PARAM_STR);
        $sql->bindParam(':price', $price, PDO::PARAM_STR);
        $sql->bindParam(':currency', $currency, PDO::PARAM_STR);
        $sql->bindParam(':status', $status, PDO::PARAM_STR);
        $sql->bindParam(':renew_at', $renew_at, PDO::PARAM_STR);

        if (!$sql->execute()) {
            return false;
        }

        return true;
    }

    public function getSubscriptionByTenantId(int $tenant_id)
    {
        $sql = $this->db->prepare("SELECT * FROM subscriptions WHERE tenant_id = :tenant_id");
        $sql->bindParam(':tenant_id', $tenant_id, PDO::PARAM_INT);
        $sql->execute();
        $subscription = $sql->fetch();
        return $subscription;
    }
}
