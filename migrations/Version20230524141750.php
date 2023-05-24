<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230524141750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission CHANGE loaning_duration loaning_duration VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE start_at start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE end_at end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE task CHANGE start_at start_at DATE NOT NULL, CHANGE end_at end_at DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission CHANGE loaning_duration loaning_duration DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE start_at start_at DATETIME NOT NULL, CHANGE end_at end_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE task CHANGE start_at start_at DATETIME NOT NULL, CHANGE end_at end_at DATETIME NOT NULL');
    }
}
