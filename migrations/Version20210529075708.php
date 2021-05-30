<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210529075708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE slave (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, age INT NOT NULL, weight DOUBLE PRECISION NOT NULL, color_skin VARCHAR(255) NOT NULL, location VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, wage_rate DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slave_work (slave_id INT NOT NULL, work_id INT NOT NULL, INDEX IDX_472A10062B29BD08 (slave_id), INDEX IDX_472A1006BB3453DB (work_id), PRIMARY KEY(slave_id, work_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE slave_work ADD CONSTRAINT FK_472A10062B29BD08 FOREIGN KEY (slave_id) REFERENCES slave (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE slave_work ADD CONSTRAINT FK_472A1006BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slave_work DROP FOREIGN KEY FK_472A10062B29BD08');
        $this->addSql('DROP TABLE slave');
        $this->addSql('DROP TABLE slave_work');
    }
}
