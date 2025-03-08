# 📌 Estrutura MVC para SaaS com Multi-Tenant

Este é um projeto base em PHP utilizando o padrão MVC, com suporte a multi-tenancy e integração com pagamentos. Ele serve como uma fundação para criar qualquer SaaS que exija autenticação, gerenciamento de usuários e assinaturas recorrentes.

---

## 📂 Estrutura do Projeto

```
📁 base-projeto-login-pagto/
 ├── .htaccess              # Configuração de segurança e roteamento
 ├── database.php            # Gerencia a conexão com o banco de dados
 ├── config.php             # Definições globais do sistema
 ├── create_database_mysql.php  # Script para criar o banco MySQL
 ├── create_database_sqlite.php # Script para criar o banco SQLite
 ├── env.php                # Configurações de ambiente (desenvolvimento/produção)
 ├── index.php              # Ponto de entrada principal da aplicação
 ├── README.md              # Documentação do projeto
 ├── assets/                # Arquivos estáticos (CSS, JS, imagens)
 ├── controllers/           # Controladores da aplicação
 ├── core/                  # Classes base do framework
 ├── views/                 # Arquivos de visualização (front-end)
```

---

## ✅ **Pré-requisitos**

Para rodar este projeto, você precisará de:

- PHP 7.4+ (recomendado)
- Servidor Apache com mod_rewrite ativado (O **XAMPP** já possui isso configurado)
- SQLite 3 (caso opte por usar SQLite)
- MySQL (caso opte por usar MySQL)

---

## 🚀 **Instalação e Configuração**

### 1️⃣ **Baixe e configure o projeto**

1. **Clone o repositório ou copie os arquivos para o seu servidor local:**
   ```sh
   git clone https://github.com/cwrsiqueira/base-projeto-login-pagto.git
   cd base-projeto-login-pagto
   ```

2. **Configure o servidor Apache:**
   - Certifique-se de que o módulo `mod_rewrite` está ativado.
   - Se estiver usando **XAMPP**, basta iniciar o Apache pelo painel de controle.

### 2️⃣ **Escolha o Banco de Dados**

No arquivo `env.php`, escolha o banco de dados alterando a constante `DB_DRIVER`:
```php
// Opções disponíveis: 'sqlite' ou 'mysql'
define("DB_DRIVER", "sqlite");
```

Caso queira usar MySQL, altere para:
```php
define("DB_DRIVER", "mysql");
```

### 3️⃣ **Criação do banco de dados**

🔹 **Se estiver usando SQLite**, rode:
```sh
php create_database_sqlite.php
```
Isso criará o arquivo `database.sqlite` automaticamente.

🔹 **Se estiver usando MySQL**, rode:
```sh
php create_database_mysql.php
```
Isso criará o banco de dados e as tabelas necessárias no MySQL.

---

## ▶️ **Executando o Projeto**

1. **Inicie o Apache (se estiver usando XAMPP, inicie pelo painel).**
2. **Acesse no navegador:**
   ```
   http://localhost/base-projeto-login-pagto/
   ```
3. O sistema estará rodando e pronto para uso! 🎉

---

## 🔐 **Autenticação e Multi-Tenancy**

- Cada **tenant (cliente da plataforma)** tem seus próprios usuários, assinaturas e métodos de pagamento.
- O **admin do tenant** pode gerenciar usuários e pagamentos dentro do seu próprio espaço.
- O login é baseado em e-mail e senha.

---

## 💳 **Gerenciamento de Pagamentos e Assinaturas**

O projeto já inclui tabelas para gerenciar pagamentos e assinaturas recorrentes. Cada tenant pode ter uma única assinatura ativa e realizar pagamentos utilizando os métodos disponíveis (Cartão, Pix, Boleto, etc.).

---

## ❓ **Dúvidas ou melhorias?**

Sinta-se à vontade para contribuir ou relatar problemas no repositório. 🚀

## **Melhorias**
- Sistema de envio de email:
   - cadastro: confirmar email
   - esqueci a senha
   - vencimento da assinatura:
      - 1 dia antes
      - no dia
      - todos os dias vencidos

- Login com Google
