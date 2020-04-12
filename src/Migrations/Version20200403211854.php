<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200403211854 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beat ADD genre_id INT DEFAULT NULL, DROP genre');
        $this->addSql('ALTER TABLE beat ADD CONSTRAINT FK_D5F9069C4296D31F FOREIGN KEY (genre_id) REFERENCES filtre (id)');
        $this->addSql('CREATE INDEX IDX_D5F9069C4296D31F ON beat (genre_id)');
        $this->addSql('ALTER TABLE filtre DROP genre');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beat DROP FOREIGN KEY FK_D5F9069C4296D31F');
        $this->addSql('DROP INDEX IDX_D5F9069C4296D31F ON beat');
        $this->addSql('ALTER TABLE beat ADD genre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP genre_id');
        $this->addSql('ALTER TABLE filtre ADD genre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
