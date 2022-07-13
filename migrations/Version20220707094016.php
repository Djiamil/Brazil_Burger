<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707094016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_burger (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, burger_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_3CA402D5CCD7E912 (menu_id), INDEX IDX_3CA402D517CE5090 (burger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D5CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('DROP TABLE boisson_taille_boisson');
        $this->addSql('DROP TABLE burger_menu');
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('ALTER TABLE ligne_commande CHANGE produit_id produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3CCD7E912');
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3734B8089');
        $this->addSql('ALTER TABLE menu_boisson ADD id INT AUTO_INCREMENT NOT NULL, ADD quantity INT NOT NULL, CHANGE menu_id menu_id INT DEFAULT NULL, CHANGE boisson_id boisson_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE menu_frite DROP FOREIGN KEY FK_B147E70ACCD7E912');
        $this->addSql('ALTER TABLE menu_frite DROP FOREIGN KEY FK_B147E70ABE00B4D9');
        $this->addSql('ALTER TABLE menu_frite ADD id INT AUTO_INCREMENT NOT NULL, ADD quantity INT NOT NULL, CHANGE menu_id menu_id INT DEFAULT NULL, CHANGE frite_id frite_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE menu_frite ADD CONSTRAINT FK_B147E70ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_frite ADD CONSTRAINT FK_B147E70ABE00B4D9 FOREIGN KEY (frite_id) REFERENCES frite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boisson_taille_boisson (boisson_id INT NOT NULL, taille_boisson_id INT NOT NULL, INDEX IDX_3AAEDEC8734B8089 (boisson_id), INDEX IDX_3AAEDEC88421F13F (taille_boisson_id), PRIMARY KEY(boisson_id, taille_boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE burger_menu (burger_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_E42E02517CE5090 (burger_id), INDEX IDX_E42E025CCD7E912 (menu_id), PRIMARY KEY(burger_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande_produit (commande_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_DF1E9E8782EA2E54 (commande_id), INDEX IDX_DF1E9E87F347EFB (produit_id), PRIMARY KEY(commande_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE boisson_taille_boisson ADD CONSTRAINT FK_3AAEDEC88421F13F FOREIGN KEY (taille_boisson_id) REFERENCES taille_boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_taille_boisson ADD CONSTRAINT FK_3AAEDEC8734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_menu ADD CONSTRAINT FK_E42E025CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_menu ADD CONSTRAINT FK_E42E02517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E8782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE menu_burger');
        $this->addSql('ALTER TABLE ligne_commande CHANGE produit_id produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE menu_boisson MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3CCD7E912');
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3734B8089');
        $this->addSql('ALTER TABLE menu_boisson DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE menu_boisson DROP id, DROP quantity, CHANGE menu_id menu_id INT NOT NULL, CHANGE boisson_id boisson_id INT NOT NULL');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_boisson ADD PRIMARY KEY (menu_id, boisson_id)');
        $this->addSql('ALTER TABLE menu_frite MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE menu_frite DROP FOREIGN KEY FK_B147E70ACCD7E912');
        $this->addSql('ALTER TABLE menu_frite DROP FOREIGN KEY FK_B147E70ABE00B4D9');
        $this->addSql('ALTER TABLE menu_frite DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE menu_frite DROP id, DROP quantity, CHANGE menu_id menu_id INT NOT NULL, CHANGE frite_id frite_id INT NOT NULL');
        $this->addSql('ALTER TABLE menu_frite ADD CONSTRAINT FK_B147E70ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_frite ADD CONSTRAINT FK_B147E70ABE00B4D9 FOREIGN KEY (frite_id) REFERENCES frite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_frite ADD PRIMARY KEY (menu_id, frite_id)');
    }
}
