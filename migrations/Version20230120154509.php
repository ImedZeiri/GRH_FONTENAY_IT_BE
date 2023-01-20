<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120154509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_rights ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL, DROP created_by, DROP updated_by');
        $this->addSql('ALTER TABLE user_rights ADD CONSTRAINT FK_6432CA3EB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_rights ADD CONSTRAINT FK_6432CA3E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_6432CA3EB03A8386 ON user_rights (created_by_id)');
        $this->addSql('CREATE INDEX IDX_6432CA3E896DBBDE ON user_rights (updated_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3EB03A8386');
        $this->addSql('ALTER TABLE user_rights DROP FOREIGN KEY FK_6432CA3E896DBBDE');
        $this->addSql('DROP INDEX IDX_6432CA3EB03A8386 ON user_rights');
        $this->addSql('DROP INDEX IDX_6432CA3E896DBBDE ON user_rights');
        $this->addSql('ALTER TABLE user_rights ADD created_by INT DEFAULT NULL, ADD updated_by INT DEFAULT NULL, DROP created_by_id, DROP updated_by_id');
    }
}
