<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201117105641 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beat ADD created_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE diapo ADD titre_fr VARCHAR(255) DEFAULT NULL, ADD text_fr LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE licence ADD titre_fr VARCHAR(255) DEFAULT NULL, ADD info_1_fr VARCHAR(255) DEFAULT NULL, ADD info_2_fr VARCHAR(255) DEFAULT NULL, ADD info_3_fr VARCHAR(255) DEFAULT NULL, ADD info_4_fr VARCHAR(255) DEFAULT NULL, ADD info_5_fr VARCHAR(255) DEFAULT NULL, ADD info_6_fr VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE video CHANGE link link VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beat DROP created_date');
        $this->addSql('ALTER TABLE diapo DROP titre_fr, DROP text_fr');
        $this->addSql('ALTER TABLE licence DROP titre_fr, DROP info_1_fr, DROP info_2_fr, DROP info_3_fr, DROP info_4_fr, DROP info_5_fr, DROP info_6_fr');
        $this->addSql('ALTER TABLE video CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
