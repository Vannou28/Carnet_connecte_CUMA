<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722064003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE where_material ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE where_material ADD CONSTRAINT FK_9FEF7234A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9FEF7234A76ED395 ON where_material (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE where_material DROP FOREIGN KEY FK_9FEF7234A76ED395');
        $this->addSql('DROP INDEX IDX_9FEF7234A76ED395 ON where_material');
        $this->addSql('ALTER TABLE where_material DROP user_id');
    }
}
