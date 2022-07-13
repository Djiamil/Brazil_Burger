<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707110126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, livreur_id INT DEFAULT NULL, zone_id INT DEFAULT NULL, gestionairs_id INT DEFAULT NULL, telephone VARCHAR(255) NOT NULL, etatlivraison VARCHAR(255) NOT NULL, INDEX IDX_A60C9F1FF8646701 (livreur_id), INDEX IDX_A60C9F1F9F2C3FAB (zone_id), INDEX IDX_A60C9F1F3CB32D6C (gestionairs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, nomzone VARCHAR(255) NOT NULL, prix_livraison VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FF8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F3CB32D6C FOREIGN KEY (gestionairs_id) REFERENCES gestionair (id)');
        $this->addSql('ALTER TABLE commande ADD livraison_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('ALTER TABLE livreur ADD telephone VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F9F2C3FAB');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE zone');
        $this->addSql('DROP INDEX IDX_6EEAA67D8E54FB25 ON commande');
        $this->addSql('ALTER TABLE commande DROP livraison_id');
        $this->addSql('ALTER TABLE livreur DROP telephone');
    }
}
