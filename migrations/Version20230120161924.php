<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120161924 extends AbstractMigration
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
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81D8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE company_associate ADD CONSTRAINT FK_3FD5D7D538B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A38B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE department_user ADD CONSTRAINT FK_2F89B11CAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE department_user ADD CONSTRAINT FK_2F89B11CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD company_associate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D5C34757 FOREIGN KEY (company_associate_id) REFERENCES company_associate (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D5C34757 ON user (company_associate_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649D5C34757');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81D8A48BBD');
        $this->addSql('ALTER TABLE company_associate DROP FOREIGN KEY FK_3FD5D7D538B53C32');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18A38B53C32');
        $this->addSql('ALTER TABLE department_user DROP FOREIGN KEY FK_2F89B11CAE80F5DF');
        $this->addSql('ALTER TABLE department_user DROP FOREIGN KEY FK_2F89B11CA76ED395');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_associate');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE department_user');
        $this->addSql('DROP INDEX IDX_8D93D649D5C34757 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP company_associate_id');
    }
}
