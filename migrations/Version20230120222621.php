<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120222621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `userr` (id INT AUTO_INCREMENT NOT NULL, company_associate_id INT DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, cin INT DEFAULT NULL, birthday DATE DEFAULT NULL, hiring_date DATE DEFAULT NULL, account_status INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, token_expires_at DATETIME DEFAULT NULL, api_key VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_6384957FE7927C74 (email), INDEX IDX_6384957FD5C34757 (company_associate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `userr` ADD CONSTRAINT FK_6384957FD5C34757 FOREIGN KEY (company_associate_id) REFERENCES company_associate (id)');
        $this->addSql('ALTER TABLE department_user DROP FOREIGN KEY FK_2F89B11CA76ED395');
        $this->addSql('ALTER TABLE department_user ADD CONSTRAINT FK_2F89B11CA76ED395 FOREIGN KEY (user_id) REFERENCES `userr` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D5C34757');
        $this->addSql('DROP INDEX IDX_8D93D649D5C34757 ON user');
        $this->addSql('ALTER TABLE user DROP company_associate_id, DROP first_name, DROP last_name, DROP cin, DROP birthday, DROP hiring_date, DROP account_status, DROP phone, DROP gender, DROP token, DROP token_expires_at, DROP api_key');
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3E896DBBDE');
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3EB03A8386');
        $this->addSql('ALTER TABLE user_rights ADD CONSTRAINT FK_6432CA3E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `userr` (id)');
        $this->addSql('ALTER TABLE user_rights ADD CONSTRAINT FK_6432CA3EB03A8386 FOREIGN KEY (created_by_id) REFERENCES `userr` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE department_user DROP FOREIGN KEY FK_2F89B11CA76ED395');
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3EB03A8386');
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3E896DBBDE');
        $this->addSql('ALTER TABLE `userr` DROP FOREIGN KEY FK_6384957FD5C34757');
        $this->addSql('DROP TABLE `userr`');
        $this->addSql('ALTER TABLE department_user DROP FOREIGN KEY FK_2F89B11CA76ED395');
        $this->addSql('ALTER TABLE department_user ADD CONSTRAINT FK_2F89B11CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD company_associate_id INT DEFAULT NULL, ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, ADD cin INT DEFAULT NULL, ADD birthday DATE DEFAULT NULL, ADD hiring_date DATE DEFAULT NULL, ADD account_status INT DEFAULT NULL, ADD phone VARCHAR(255) DEFAULT NULL, ADD gender VARCHAR(255) DEFAULT NULL, ADD token VARCHAR(255) DEFAULT NULL, ADD token_expires_at DATETIME DEFAULT NULL, ADD api_key VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D5C34757 FOREIGN KEY (company_associate_id) REFERENCES company_associate (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D5C34757 ON user (company_associate_id)');
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3EB03A8386');
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3E896DBBDE');
        $this->addSql('ALTER TABLE user_rights ADD CONSTRAINT FK_6432CA3EB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_rights ADD CONSTRAINT FK_6432CA3E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
    }
}
