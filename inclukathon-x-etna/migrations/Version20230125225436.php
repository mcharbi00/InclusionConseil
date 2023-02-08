<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125225436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teams ADD companies_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C222586AE4741E FOREIGN KEY (companies_id) REFERENCES companies (id)');
        $this->addSql('CREATE INDEX IDX_96C222586AE4741E ON teams (companies_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C222586AE4741E');
        $this->addSql('DROP INDEX IDX_96C222586AE4741E ON teams');
        $this->addSql('ALTER TABLE teams DROP companies_id');
    }
}
