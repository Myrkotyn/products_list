<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180126101047 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_groups DROP FOREIGN KEY FK_921178D41D775834');
        $this->addSql('DROP INDEX IDX_921178D41D775834 ON product_groups');
        $this->addSql('ALTER TABLE product_groups ADD group_type_id INT UNSIGNED DEFAULT NULL, DROP value');
        $this->addSql('ALTER TABLE product_groups ADD CONSTRAINT FK_921178D4434CD89F FOREIGN KEY (group_type_id) REFERENCES group_types (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_921178D4434CD89F ON product_groups (group_type_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_groups DROP FOREIGN KEY FK_921178D4434CD89F');
        $this->addSql('DROP INDEX IDX_921178D4434CD89F ON product_groups');
        $this->addSql('ALTER TABLE product_groups ADD value INT UNSIGNED NOT NULL, DROP group_type_id');
        $this->addSql('ALTER TABLE product_groups ADD CONSTRAINT FK_921178D41D775834 FOREIGN KEY (value) REFERENCES group_types (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_921178D41D775834 ON product_groups (value)');
    }
}
