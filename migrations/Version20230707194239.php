<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230707194239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, user_avis_id INT DEFAULT NULL, produit_avis_id INT DEFAULT NULL, note DOUBLE PRECISION NOT NULL, description VARCHAR(1000) NOT NULL, INDEX IDX_8F91ABF041736E95 (user_avis_id), INDEX IDX_8F91ABF0DF85FBE6 (produit_avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF041736E95 FOREIGN KEY (user_avis_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0DF85FBE6 FOREIGN KEY (produit_avis_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF041736E95');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0DF85FBE6');
        $this->addSql('DROP TABLE avis');
    }
}
