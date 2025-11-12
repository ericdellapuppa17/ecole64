<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251112115333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_matiere (formation_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_D5EB12315200282E (formation_id), INDEX IDX_D5EB1231F46CD258 (matiere_id), PRIMARY KEY(formation_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres (matiere_id INT AUTO_INCREMENT NOT NULL, matiere_nom VARCHAR(255) NOT NULL, matiere_desc LONGTEXT DEFAULT NULL, PRIMARY KEY(matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation_matiere ADD CONSTRAINT FK_D5EB12315200282E FOREIGN KEY (formation_id) REFERENCES formations (frm_id)');
        $this->addSql('ALTER TABLE formation_matiere ADD CONSTRAINT FK_D5EB1231F46CD258 FOREIGN KEY (matiere_id) REFERENCES matieres (matiere_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_matiere DROP FOREIGN KEY FK_D5EB12315200282E');
        $this->addSql('ALTER TABLE formation_matiere DROP FOREIGN KEY FK_D5EB1231F46CD258');
        $this->addSql('DROP TABLE formation_matiere');
        $this->addSql('DROP TABLE matieres');
    }
}
