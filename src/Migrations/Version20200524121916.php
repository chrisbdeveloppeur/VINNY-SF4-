<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200524121916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beat (id INT AUTO_INCREMENT NOT NULL, genre_id INT DEFAULT NULL, beat_image_name VARCHAR(255) DEFAULT NULL, beat_name VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, artiste VARCHAR(255) DEFAULT NULL, album VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, bpm DOUBLE PRECISION DEFAULT NULL, iframe VARCHAR(255) DEFAULT NULL, INDEX IDX_D5F9069C4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diapo (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, diapo_image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, text LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filtre (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licence (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, euro DOUBLE PRECISION DEFAULT NULL, dollar DOUBLE PRECISION DEFAULT NULL, info_1 VARCHAR(255) DEFAULT NULL, info_2 VARCHAR(255) DEFAULT NULL, info_3 VARCHAR(255) DEFAULT NULL, info_4 VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, info_5 VARCHAR(255) DEFAULT NULL, info_6 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, nom LONGTEXT DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email LONGTEXT NOT NULL, objet VARCHAR(255) DEFAULT NULL, message TEXT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_video (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, couleur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, section_id INT NOT NULL, titre VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, info VARCHAR(255) DEFAULT NULL, INDEX IDX_7CC7DA2CD823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beat ADD CONSTRAINT FK_D5F9069C4296D31F FOREIGN KEY (genre_id) REFERENCES filtre (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CD823E37A FOREIGN KEY (section_id) REFERENCES section_video (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beat DROP FOREIGN KEY FK_D5F9069C4296D31F');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CD823E37A');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE beat');
        $this->addSql('DROP TABLE diapo');
        $this->addSql('DROP TABLE filtre');
        $this->addSql('DROP TABLE licence');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE section_video');
        $this->addSql('DROP TABLE video');
    }
}
