<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180124145017 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_color (id INT UNSIGNED NOT NULL, value VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B5BF396750 FOREIGN KEY (id) REFERENCES product_attributes (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_attribute_color');
        $this->addSql('ALTER TABLE product_attributes DROP attribute_id, CHANGE product_id product_id SMALLINT UNSIGNED DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_attribute_color (id INT UNSIGNED NOT NULL, value VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_attribute_color ADD CONSTRAINT FK_B7E5AEC2BF396750 FOREIGN KEY (id) REFERENCES product_attributes (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_color');
        $this->addSql('ALTER TABLE product_attributes ADD attribute_id SMALLINT UNSIGNED NOT NULL, CHANGE product_id product_id SMALLINT UNSIGNED NOT NULL');
    }
}
