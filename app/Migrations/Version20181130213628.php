<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181130213628 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE unit_measure (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, shortName VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D44E17E75E237E06 (name), UNIQUE INDEX UNIQ_D44E17E7C43A885D (shortName), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cloth (id INT AUTO_INCREMENT NOT NULL, unit_of_measure_id INT NOT NULL, group_cloth_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_22F16BBE77153098 (code), INDEX IDX_22F16BBEDA4E2C90 (unit_of_measure_id), INDEX IDX_22F16BBEEC022A91 (group_cloth_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_cloth (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_72DD40D95E237E06 (name), INDEX IDX_72DD40D9727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cloth ADD CONSTRAINT FK_22F16BBEDA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES unit_measure (id)');
        $this->addSql('ALTER TABLE cloth ADD CONSTRAINT FK_22F16BBEEC022A91 FOREIGN KEY (group_cloth_id) REFERENCES group_cloth (id)');
        $this->addSql('ALTER TABLE group_cloth ADD CONSTRAINT FK_72DD40D9727ACA70 FOREIGN KEY (parent_id) REFERENCES group_cloth (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cloth DROP FOREIGN KEY FK_22F16BBEDA4E2C90');
        $this->addSql('ALTER TABLE cloth DROP FOREIGN KEY FK_22F16BBEEC022A91');
        $this->addSql('ALTER TABLE group_cloth DROP FOREIGN KEY FK_72DD40D9727ACA70');
        $this->addSql('DROP TABLE unit_measure');
        $this->addSql('DROP TABLE cloth');
        $this->addSql('DROP TABLE group_cloth');
    }
}
