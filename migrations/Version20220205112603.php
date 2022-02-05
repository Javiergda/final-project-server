<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220205112603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE daily (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, breackfast VARCHAR(10) DEFAULT NULL, lunch1 VARCHAR(10) DEFAULT NULL, lunch2 VARCHAR(10) DEFAULT NULL, dessert VARCHAR(10) DEFAULT NULL, snack VARCHAR(10) DEFAULT NULL, bottle VARCHAR(10) DEFAULT NULL, diaper VARCHAR(10) DEFAULT NULL, nap VARCHAR(10) DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, absence VARCHAR(10) DEFAULT NULL, INDEX IDX_8E9DAB6ACB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(128) DEFAULT NULL, surname VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, phone1 VARCHAR(255) NOT NULL, phone2 VARCHAR(255) DEFAULT NULL, letter VARCHAR(10) NOT NULL, INDEX IDX_B723AF33A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) DEFAULT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, user_type VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE daily ADD CONSTRAINT FK_8E9DAB6ACB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE daily DROP FOREIGN KEY FK_8E9DAB6ACB944F1A');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33A76ED395');
        $this->addSql('DROP TABLE daily');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
