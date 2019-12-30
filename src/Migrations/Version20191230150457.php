<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191230150457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE counter (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, crime INT NOT NULL, organized_crime INT NOT NULL, UNIQUE INDEX UNIQ_C1229478A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, experience INT NOT NULL, cash INT NOT NULL, bank INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cooldown (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, crime DATETIME NOT NULL, organized_crime DATETIME NOT NULL, UNIQUE INDEX UNIQ_DE632CD9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE counter ADD CONSTRAINT FK_C1229478A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cooldown ADD CONSTRAINT FK_DE632CD9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE counter DROP FOREIGN KEY FK_C1229478A76ED395');
        $this->addSql('ALTER TABLE cooldown DROP FOREIGN KEY FK_DE632CD9A76ED395');
        $this->addSql('DROP TABLE counter');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE cooldown');
    }
}
