<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522042326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, company_id_id INT DEFAULT NULL, user_id_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C744045538B53C32 (company_id_id), UNIQUE INDEX UNIQ_C74404559D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, current_company_id_id INT DEFAULT NULL, origine_company_id_id INT DEFAULT NULL, project_id_id INT DEFAULT NULL, loaning_duration DATE DEFAULT NULL, loaning_start_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', loaning_active TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_9067F23C9D86650F (user_id_id), INDEX IDX_9067F23C294B86D0 (current_company_id_id), UNIQUE INDEX UNIQ_9067F23CE4699CA1 (origine_company_id_id), INDEX IDX_9067F23C6C1197C9 (project_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, INDEX IDX_2FB3D0EE7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_members (id INT AUTO_INCREMENT NOT NULL, project_id_id INT DEFAULT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_D3BEDE9A6C1197C9 (project_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, project_id_id INT DEFAULT NULL, INDEX IDX_527EDB256C1197C9 (project_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_project_members (task_id INT NOT NULL, project_members_id INT NOT NULL, INDEX IDX_95CB49958DB60186 (task_id), INDEX IDX_95CB4995A5A78EDF (project_members_id), PRIMARY KEY(task_id, project_members_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_skills (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_EE9892A38DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_skills (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, rate INT NOT NULL, INDEX IDX_B0630D4DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045538B53C32 FOREIGN KEY (company_id_id) REFERENCES `company` (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C294B86D0 FOREIGN KEY (current_company_id_id) REFERENCES `company` (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CE4699CA1 FOREIGN KEY (origine_company_id_id) REFERENCES `company` (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C6C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE project_members ADD CONSTRAINT FK_D3BEDE9A6C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB256C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE task_project_members ADD CONSTRAINT FK_95CB49958DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_project_members ADD CONSTRAINT FK_95CB4995A5A78EDF FOREIGN KEY (project_members_id) REFERENCES project_members (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_skills ADD CONSTRAINT FK_EE9892A38DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE user_skills ADD CONSTRAINT FK_B0630D4DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045538B53C32');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404559D86650F');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C9D86650F');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C294B86D0');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CE4699CA1');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C6C1197C9');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE7E3C61F9');
        $this->addSql('ALTER TABLE project_members DROP FOREIGN KEY FK_D3BEDE9A6C1197C9');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB256C1197C9');
        $this->addSql('ALTER TABLE task_project_members DROP FOREIGN KEY FK_95CB49958DB60186');
        $this->addSql('ALTER TABLE task_project_members DROP FOREIGN KEY FK_95CB4995A5A78EDF');
        $this->addSql('ALTER TABLE task_skills DROP FOREIGN KEY FK_EE9892A38DB60186');
        $this->addSql('ALTER TABLE user_skills DROP FOREIGN KEY FK_B0630D4DA76ED395');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_members');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_project_members');
        $this->addSql('DROP TABLE task_skills');
        $this->addSql('DROP TABLE user_skills');
    }
}
