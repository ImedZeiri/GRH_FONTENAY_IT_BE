<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120210455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, country_id_id INT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, INDEX IDX_D4E6F81D8A48BBD (country_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, capacity INT DEFAULT NULL, deleted_file_expiration DATE DEFAULT NULL, tax_number INT NOT NULL, identity_number INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_associate (id INT AUTO_INCREMENT NOT NULL, company_id_id INT DEFAULT NULL, principal VARCHAR(255) DEFAULT NULL, social_part INT DEFAULT NULL, INDEX IDX_3FD5D7D538B53C32 (company_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, iso_code VARCHAR(255) DEFAULT NULL, phone_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, company_id_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, capacity INT DEFAULT NULL, category INT DEFAULT NULL, INDEX IDX_CD1DE18A38B53C32 (company_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department_user (department_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2F89B11CAE80F5DF (department_id), INDEX IDX_2F89B11CA76ED395 (user_id), PRIMARY KEY(department_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `right` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, technical_name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, company_associate_id INT DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, cin INT DEFAULT NULL, birthday DATE DEFAULT NULL, hiring_date DATE DEFAULT NULL, account_status INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, token_expires_at DATETIME DEFAULT NULL, api_key VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649D5C34757 (company_associate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_rights (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, status INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_6432CA3EB03A8386 (created_by_id), INDEX IDX_6432CA3E896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81D8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE company_associate ADD CONSTRAINT FK_3FD5D7D538B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A38B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE department_user ADD CONSTRAINT FK_2F89B11CAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE department_user ADD CONSTRAINT FK_2F89B11CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649D5C34757 FOREIGN KEY (company_associate_id) REFERENCES company_associate (id)');
        $this->addSql('ALTER TABLE user_rights ADD CONSTRAINT FK_6432CA3EB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_rights ADD CONSTRAINT FK_6432CA3E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81D8A48BBD');
        $this->addSql('ALTER TABLE company_associate DROP FOREIGN KEY FK_3FD5D7D538B53C32');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18A38B53C32');
        $this->addSql('ALTER TABLE department_user DROP FOREIGN KEY FK_2F89B11CAE80F5DF');
        $this->addSql('ALTER TABLE department_user DROP FOREIGN KEY FK_2F89B11CA76ED395');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649D5C34757');
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3EB03A8386');
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3E896DBBDE');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_associate');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE department_user');
        $this->addSql('DROP TABLE `right`');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_rights');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
