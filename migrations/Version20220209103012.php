<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220209103012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE daily CHANGE breackfast breackfast VARCHAR(10) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lunch1 lunch1 VARCHAR(10) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lunch2 lunch2 VARCHAR(10) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dessert dessert VARCHAR(10) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE snack snack VARCHAR(10) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE bottle bottle VARCHAR(10) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE diaper diaper VARCHAR(10) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nap nap VARCHAR(10) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE message message VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE absence absence VARCHAR(10) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE student CHANGE name name VARCHAR(128) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE surname surname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone1 phone1 VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone2 phone2 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE letter letter VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user DROP roles, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(128) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE surname surname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE user_type user_type VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
