<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251112151853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devoirs ADD cours_id INT NOT NULL');
        $this->addSql('ALTER TABLE devoirs ADD CONSTRAINT FK_3C7810067ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (cours_id)');
        $this->addSql('CREATE INDEX IDX_3C7810067ECF78B0 ON devoirs (cours_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devoirs DROP FOREIGN KEY FK_3C7810067ECF78B0');
        $this->addSql('DROP INDEX IDX_3C7810067ECF78B0 ON devoirs');
        $this->addSql('ALTER TABLE devoirs DROP cours_id');
    }
}
