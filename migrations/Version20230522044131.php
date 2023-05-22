<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522044131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD name VARCHAR(255) NOT NULL, ADD start_at DATETIME NOT NULL , ADD end_at DATETIME NOT NULL, ADD field VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task ADD name VARCHAR(255) NOT NULL, ADD start_at DATETIME NOT NULL, ADD end_at DATETIME NOT NULL, ADD complexity INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP name, DROP start_at, DROP end_at, DROP field');
        $this->addSql('ALTER TABLE task DROP name, DROP start_at, DROP end_at, DROP complexity');
    }
}
