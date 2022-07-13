<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630100639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE burger (id INT NOT NULL, gestionair_id INT NOT NULL, categorie VARCHAR(255) NOT NULL, INDEX IDX_EFE35A0D79599F2A (gestionair_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE complement (id INT NOT NULL, portion_frites_id INT DEFAULT NULL, taille_boissons_id INT DEFAULT NULL, nature VARCHAR(255) NOT NULL, INDEX IDX_F8A41E34203D026B (portion_frites_id), INDEX IDX_F8A41E345193B1E9 (taille_boissons_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestionair (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreur (id INT NOT NULL, mat_moto VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, nom_menu VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, descrption VARCHAR(255) NOT NULL, is_etat TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_menu (menu_source INT NOT NULL, menu_target INT NOT NULL, INDEX IDX_B54ACADD8CCD27AB (menu_source), INDEX IDX_B54ACADD95287724 (menu_target), PRIMARY KEY(menu_source, menu_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_complement (menu_id INT NOT NULL, complement_id INT NOT NULL, INDEX IDX_D909AAE6CCD7E912 (menu_id), INDEX IDX_D909AAE640D9D0AA (complement_id), PRIMARY KEY(menu_id, complement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portion_frites (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, is_etat TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_boisson (id INT NOT NULL, taille VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, is_enable TINYINT(1) NOT NULL, expire_at DATETIME NOT NULL, role VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D79599F2A FOREIGN KEY (gestionair_id) REFERENCES gestionair (id)');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE complement ADD CONSTRAINT FK_F8A41E34203D026B FOREIGN KEY (portion_frites_id) REFERENCES portion_frites (id)');
        $this->addSql('ALTER TABLE complement ADD CONSTRAINT FK_F8A41E345193B1E9 FOREIGN KEY (taille_boissons_id) REFERENCES taille_boisson (id)');
        $this->addSql('ALTER TABLE complement ADD CONSTRAINT FK_F8A41E34BF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gestionair ADD CONSTRAINT FK_50FC8E08BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6DBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_menu ADD CONSTRAINT FK_B54ACADD8CCD27AB FOREIGN KEY (menu_source) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_menu ADD CONSTRAINT FK_B54ACADD95287724 FOREIGN KEY (menu_target) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_complement ADD CONSTRAINT FK_D909AAE6CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_complement ADD CONSTRAINT FK_D909AAE640D9D0AA FOREIGN KEY (complement_id) REFERENCES complement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portion_frites ADD CONSTRAINT FK_B3E62962BF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268BF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_complement DROP FOREIGN KEY FK_D909AAE640D9D0AA');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D79599F2A');
        $this->addSql('ALTER TABLE menu_menu DROP FOREIGN KEY FK_B54ACADD8CCD27AB');
        $this->addSql('ALTER TABLE menu_menu DROP FOREIGN KEY FK_B54ACADD95287724');
        $this->addSql('ALTER TABLE menu_complement DROP FOREIGN KEY FK_D909AAE6CCD7E912');
        $this->addSql('ALTER TABLE complement DROP FOREIGN KEY FK_F8A41E34203D026B');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0DBF396750');
        $this->addSql('ALTER TABLE complement DROP FOREIGN KEY FK_F8A41E34BF396750');
        $this->addSql('ALTER TABLE portion_frites DROP FOREIGN KEY FK_B3E62962BF396750');
        $this->addSql('ALTER TABLE taille_boisson DROP FOREIGN KEY FK_59FAC268BF396750');
        $this->addSql('ALTER TABLE complement DROP FOREIGN KEY FK_F8A41E345193B1E9');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE gestionair DROP FOREIGN KEY FK_50FC8E08BF396750');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6DBF396750');
        $this->addSql('DROP TABLE burger');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE complement');
        $this->addSql('DROP TABLE gestionair');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_menu');
        $this->addSql('DROP TABLE menu_complement');
        $this->addSql('DROP TABLE portion_frites');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE taille_boisson');
        $this->addSql('DROP TABLE user');
    }
}
