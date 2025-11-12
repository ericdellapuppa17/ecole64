<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251112141000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations_matieres RENAME INDEX idx_d5eb12315200282e TO IDX_3C4B85315200282E');
        $this->addSql('ALTER TABLE formations_matieres RENAME INDEX idx_d5eb1231f46cd258 TO IDX_3C4B8531F46CD258');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations_matieres RENAME INDEX idx_3c4b85315200282e TO IDX_D5EB12315200282E');
        $this->addSql('ALTER TABLE formations_matieres RENAME INDEX idx_3c4b8531f46cd258 TO IDX_D5EB1231F46CD258');
    }
}
