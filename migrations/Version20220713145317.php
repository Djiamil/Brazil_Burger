<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713145317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson ADD taille_boissons_id INT DEFAULT NULL, ADD quantity_stock INT NOT NULL');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84D5193B1E9 FOREIGN KEY (taille_boissons_id) REFERENCES taille_boisson (id)');
        $this->addSql('CREATE INDEX IDX_8B97C84D5193B1E9 ON boisson (taille_boissons_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84D5193B1E9');
        $this->addSql('DROP INDEX IDX_8B97C84D5193B1E9 ON boisson');
        $this->addSql('ALTER TABLE boisson DROP taille_boissons_id, DROP quantity_stock');
    }
}
