<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230707193833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnalisation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_personnalisation (produit_id INT NOT NULL, personnalisation_id INT NOT NULL, INDEX IDX_3A2A956EF347EFB (produit_id), INDEX IDX_3A2A956E3DD790BB (personnalisation_id), PRIMARY KEY(produit_id, personnalisation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_personnalisation ADD CONSTRAINT FK_3A2A956EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_personnalisation ADD CONSTRAINT FK_3A2A956E3DD790BB FOREIGN KEY (personnalisation_id) REFERENCES personnalisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27A21214B7 ON produit (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A21214B7');
        $this->addSql('ALTER TABLE produit_personnalisation DROP FOREIGN KEY FK_3A2A956EF347EFB');
        $this->addSql('ALTER TABLE produit_personnalisation DROP FOREIGN KEY FK_3A2A956E3DD790BB');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE personnalisation');
        $this->addSql('DROP TABLE produit_personnalisation');
        $this->addSql('DROP INDEX IDX_29A5EC27A21214B7 ON produit');
        $this->addSql('ALTER TABLE produit DROP categories_id');
    }
}
