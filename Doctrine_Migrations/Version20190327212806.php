<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327212806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE Customers ADD username VARCHAR(25) NOT NULL, ADD password VARCHAR(64) NOT NULL, ADD email VARCHAR(60) NOT NULL, ADD apiToken VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E0A2CC82F85E0677 ON Customers (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E0A2CC82E7927C74 ON Customers (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP INDEX UNIQ_E0A2CC82F85E0677 ON Customers');
        $this->addSql('DROP INDEX UNIQ_E0A2CC82E7927C74 ON Customers');
        $this->addSql('ALTER TABLE Customers DROP username, DROP password, DROP email, DROP apiToken');
    }
}
