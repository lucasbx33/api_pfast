<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006091623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD code_verif VARCHAR(4) NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE parking_like parking_like LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE token token VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP code_verif, CHANGE mail mail VARCHAR(255) NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE parking_like parking_like LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin` COMMENT \'(DC2Type:array)\', CHANGE token token VARCHAR(255) DEFAULT NULL');
    }
}
