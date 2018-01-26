<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180126090656 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_groups CHANGE value value INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE product_groups ADD CONSTRAINT FK_921178D41D775834 FOREIGN KEY (value) REFERENCES group_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_groups ADD CONSTRAINT FK_921178D4BF396750 FOREIGN KEY (id) REFERENCES product_attributes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_groups DROP FOREIGN KEY FK_921178D41D775834');
        $this->addSql('ALTER TABLE product_groups DROP FOREIGN KEY FK_921178D4BF396750');
        $this->addSql('ALTER TABLE product_groups CHANGE value value INT NOT NULL');
    }
}
