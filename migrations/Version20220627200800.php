<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627200800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger ADD gestionair_id INT NOT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D79599F2A FOREIGN KEY (gestionair_id) REFERENCES gestionair (id)');
        $this->addSql('CREATE INDEX IDX_EFE35A0D79599F2A ON burger (gestionair_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D79599F2A');
        $this->addSql('DROP INDEX IDX_EFE35A0D79599F2A ON burger');
        $this->addSql('ALTER TABLE burger DROP gestionair_id');
    }
}
