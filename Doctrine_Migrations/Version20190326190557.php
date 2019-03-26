<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326190557 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP TABLE Status');
        $this->addSql('DROP INDEX IDX_E0A2CC827B00651C ON Customers');
        $this->addSql('ALTER TABLE Customers CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_4ACC380C7B00651C ON Products');
        $this->addSql('ALTER TABLE Products CHANGE status status VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('CREATE TABLE Status (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE Customers CHANGE status status INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_E0A2CC827B00651C ON Customers (status)');
        $this->addSql('ALTER TABLE Products CHANGE status status INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_4ACC380C7B00651C ON Products (status)');
    }
}
