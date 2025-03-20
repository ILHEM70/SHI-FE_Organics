<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250320131251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE capacity (id INT AUTO_INCREMENT NOT NULL, value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products_capacity (products_id INT NOT NULL, capacity_id INT NOT NULL, INDEX IDX_A0E9A1C76C8A81A9 (products_id), INDEX IDX_A0E9A1C766B6F0BA (capacity_id), PRIMARY KEY(products_id, capacity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE products_capacity ADD CONSTRAINT FK_A0E9A1C76C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_capacity ADD CONSTRAINT FK_A0E9A1C766B6F0BA FOREIGN KEY (capacity_id) REFERENCES capacity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products ADD stocks INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_capacity DROP FOREIGN KEY FK_A0E9A1C76C8A81A9');
        $this->addSql('ALTER TABLE products_capacity DROP FOREIGN KEY FK_A0E9A1C766B6F0BA');
        $this->addSql('DROP TABLE capacity');
        $this->addSql('DROP TABLE products_capacity');
        $this->addSql('ALTER TABLE products DROP stocks');
    }
}
