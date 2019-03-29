<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190328212326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_E0A2CC82F85E0677 ON Customers');
        $this->addSql('DROP INDEX UNIQ_E0A2CC82E7927C74 ON Customers');
        $this->addSql('ALTER TABLE Customers ADD username_canonical VARCHAR(180) NOT NULL, ADD email_canonical VARCHAR(180) NOT NULL, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) DEFAULT NULL, ADD last_login DATETIME DEFAULT NULL, ADD confirmation_token VARCHAR(180) DEFAULT NULL, ADD password_requested_at DATETIME DEFAULT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP apiToken, CHANGE username username VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E0A2CC8292FC23A8 ON Customers (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E0A2CC82A0D96FBF ON Customers (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E0A2CC82C05FB297 ON Customers (confirmation_token)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_E0A2CC8292FC23A8 ON Customers');
        $this->addSql('DROP INDEX UNIQ_E0A2CC82A0D96FBF ON Customers');
        $this->addSql('DROP INDEX UNIQ_E0A2CC82C05FB297 ON Customers');
        $this->addSql('ALTER TABLE Customers ADD apiToken VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP username_canonical, DROP email_canonical, DROP enabled, DROP salt, DROP last_login, DROP confirmation_token, DROP password_requested_at, DROP roles, CHANGE username username VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci, CHANGE email email VARCHAR(60) NOT NULL COLLATE utf8_unicode_ci, CHANGE password password VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E0A2CC82F85E0677 ON Customers (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E0A2CC82E7927C74 ON Customers (email)');
    }
}
