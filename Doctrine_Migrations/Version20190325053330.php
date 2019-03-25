<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190325053330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE Customers DROP INDEX UNIQ_E0A2CC827B00651C, ADD INDEX IDX_E0A2CC827B00651C (status)');
        $this->addSql('ALTER TABLE Products DROP INDEX UNIQ_4ACC380C7B00651C, ADD INDEX IDX_4ACC380C7B00651C (status)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Customers DROP INDEX IDX_E0A2CC827B00651C, ADD UNIQUE INDEX UNIQ_E0A2CC827B00651C (status)');
        $this->addSql('ALTER TABLE Products DROP INDEX IDX_4ACC380C7B00651C, ADD UNIQUE INDEX UNIQ_4ACC380C7B00651C (status)');
    }
}
