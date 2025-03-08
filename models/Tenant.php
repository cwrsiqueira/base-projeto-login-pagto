<?php
class Tenant
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function addTenant(string $name, string $email)
    {
        $sql = $this->db->prepare("INSERT INTO tenants (name, email) VALUES (:name, :email)");
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();
        $tenant_id = $this->db->lastInsertId();

        return $tenant_id;
    }
}
