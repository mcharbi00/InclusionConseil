<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126224011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE companies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, img_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incluscore (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, smallname VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, can_be_public TINYINT(1) DEFAULT NULL, description VARCHAR(2000) DEFAULT NULL, is_inclucard TINYINT(1) DEFAULT NULL, quizz_link VARCHAR(255) NOT NULL, INDEX IDX_E7FFC00D979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level_companies (level_id INT NOT NULL, companies_id INT NOT NULL, INDEX IDX_41AD14B5FB14BA7 (level_id), INDEX IDX_41AD14B6AE4741E (companies_id), PRIMARY KEY(level_id, companies_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id INT AUTO_INCREMENT NOT NULL, companies_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, enabled TINYINT(1) DEFAULT 0, project_description VARCHAR(255) NOT NULL, INDEX IDX_96C222586AE4741E (companies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, companies_id INT DEFAULT NULL, avatar_img_path VARCHAR(255) NOT NULL, lang VARCHAR(255) NOT NULL, team_id INT NOT NULL, has_apassword TINYINT(1) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, email VARCHAR(255) NOT NULL, pwd VARCHAR(255) NOT NULL, super_admin TINYINT(1) NOT NULL, INDEX IDX_8D93D6496AE4741E (companies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incluscore ADD CONSTRAINT FK_E7FFC00D979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id)');
        $this->addSql('ALTER TABLE level_companies ADD CONSTRAINT FK_41AD14B5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE level_companies ADD CONSTRAINT FK_41AD14B6AE4741E FOREIGN KEY (companies_id) REFERENCES companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C222586AE4741E FOREIGN KEY (companies_id) REFERENCES companies (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496AE4741E FOREIGN KEY (companies_id) REFERENCES companies (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE incluscore DROP FOREIGN KEY FK_E7FFC00D979B1AD6');
        $this->addSql('ALTER TABLE level_companies DROP FOREIGN KEY FK_41AD14B5FB14BA7');
        $this->addSql('ALTER TABLE level_companies DROP FOREIGN KEY FK_41AD14B6AE4741E');
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C222586AE4741E');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496AE4741E');
        $this->addSql('DROP TABLE companies');
        $this->addSql('DROP TABLE incluscore');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE level_companies');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
