<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251112135656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE professeurs_matieres (professeur_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_9A64F58ABAB22EE9 (professeur_id), INDEX IDX_9A64F58AF46CD258 (matiere_id), PRIMARY KEY(professeur_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE professeurs_matieres ADD CONSTRAINT FK_9A64F58ABAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeurs (professeur_id)');
        $this->addSql('ALTER TABLE professeurs_matieres ADD CONSTRAINT FK_9A64F58AF46CD258 FOREIGN KEY (matiere_id) REFERENCES matieres (matiere_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professeurs_matieres DROP FOREIGN KEY FK_9A64F58ABAB22EE9');
        $this->addSql('ALTER TABLE professeurs_matieres DROP FOREIGN KEY FK_9A64F58AF46CD258');
        $this->addSql('DROP TABLE professeurs_matieres');
    }
}
