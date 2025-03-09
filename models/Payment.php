<?php
class Payment
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getPaymentsBy(int $tenant_id)
    {
        $sql = $this->db->prepare("SELECT * FROM payments WHERE tenant_id = :tenant_id");
        $sql->bindParam(':tenant_id', $tenant_id, PDO::PARAM_INT);
        $sql->execute();
        $payments = $sql->fetchAll();
        return $payments;
    }
}
