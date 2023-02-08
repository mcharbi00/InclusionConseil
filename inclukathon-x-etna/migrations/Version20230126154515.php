<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126154515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level_companies (level_id INT NOT NULL, companies_id INT NOT NULL, INDEX IDX_41AD14B5FB14BA7 (level_id), INDEX IDX_41AD14B6AE4741E (companies_id), PRIMARY KEY(level_id, companies_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE level_companies ADD CONSTRAINT FK_41AD14B5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE level_companies ADD CONSTRAINT FK_41AD14B6AE4741E FOREIGN KEY (companies_id) REFERENCES companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teams CHANGE enabled enabled TINYINT(1) DEFAULT 0');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE level_companies DROP FOREIGN KEY FK_41AD14B5FB14BA7');
        $this->addSql('ALTER TABLE level_companies DROP FOREIGN KEY FK_41AD14B6AE4741E');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE level_companies');
        $this->addSql('ALTER TABLE teams CHANGE enabled enabled TINYINT(1) NOT NULL');
    }
}
