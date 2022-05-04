<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504123048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hermandad (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hermano (id INT AUTO_INCREMENT NOT NULL, hermandad_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido1 VARCHAR(255) NOT NULL, apellido2 VARCHAR(255) NOT NULL, fecha_nacimiento DATE NOT NULL, telefono INT NOT NULL, INDEX IDX_58344493F6232DEF (hermandad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hermano ADD CONSTRAINT FK_58344493F6232DEF FOREIGN KEY (hermandad_id) REFERENCES hermandad (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hermano DROP FOREIGN KEY FK_58344493F6232DEF');
        $this->addSql('DROP TABLE hermandad');
        $this->addSql('DROP TABLE hermano');
    }
}
