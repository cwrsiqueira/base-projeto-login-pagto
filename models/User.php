<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function addUser(int $tenant_id, string $name, string $email, string $hashPassword, string $role): int
    {
        $sql = $this->db->prepare("INSERT INTO users (tenant_id, name, email, password, role) VALUES (:tenant_id, :name, :email, :password, :role)");
        $sql->bindParam(':tenant_id', $tenant_id, PDO::PARAM_INT);
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':password', $hashPassword, PDO::PARAM_STR);
        $sql->bindParam(':role', $role, PDO::PARAM_STR);
        $sql->execute();
        $user_id = $this->db->lastInsertId();

        return $user_id;
    }

    public function getUserById(int $user_id): array
    {
        $sql = $this->db->prepare("SELECT id as user_id, tenant_id, name, email, role, (select name from tenants where users.tenant_id = tenants.id) as tenant_nome FROM users WHERE id = :user_id");
        $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function getUserByEmail(string $email): array|bool
    {
        $sql = $this->db->prepare("SELECT id as user_id, tenant_id, name, email, role, (select name from tenants where users.tenant_id = tenants.id) as tenant_nome FROM users WHERE email = :email LIMIT 1");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function updateUserPassword(string $password, int $id): bool
    {
        $newPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $sql->bindParam(':password', $newPassword,  PDO::PARAM_STR);
        $sql->bindParam(':id', $id,  PDO::PARAM_INT);
        if (!$sql->execute()) {
            return false;
        }

        return true;
    }

    public function updateUser(string $name, string $email, int $id)
    {
        $sql = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $sql->bindParam(':name', $name,  PDO::PARAM_STR);
        $sql->bindParam(':email', $email,  PDO::PARAM_STR);
        $sql->bindParam(':id', $id,  PDO::PARAM_INT);
        if (!$sql->execute()) {
            return false;
        }

        return true;
    }

    public function authentication(string $email, string $password): array|bool
    {
        $user = $this->getUserByEmail($email);

        if (!$user) {
            return false;
        }

        $user_password = $this->getUserPassword($user['user_id']);

        if (!password_verify($password, $user_password)) {
            return false;
        }

        // 🔥 Verificar se a senha precisa ser re-hashada
        if (password_needs_rehash($user_password, PASSWORD_DEFAULT)) {
            $newHash = password_hash($password, PASSWORD_DEFAULT);

            $updateStmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
            $updateStmt->bindValue(":password", $newHash, PDO::PARAM_STR);
            $updateStmt->bindValue(":id", $user['user_id'], PDO::PARAM_INT);
            $updateStmt->execute();
        }

        return $user;
    }

    public function getUserPassword(int $id): string
    {
        $sql = $this->db->prepare("SELECT password FROM users WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        return $user['password'];
    }

    public function isLogged()
    {
        if (!isset($_SESSION['user'])) {
            return false;
        }

        return true;
    }
}
