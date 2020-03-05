<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305142838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE turno (id INT AUTO_INCREMENT NOT NULL, cola_id INT NOT NULL, fecha_creacion DATETIME NOT NULL, atendido TINYINT(1) NOT NULL, fecha_atendido DATETIME DEFAULT NULL, INDEX IDX_E797676298C82281 (cola_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_cola (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cola (id INT AUTO_INCREMENT NOT NULL, tipo_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_B8A17E89A9276E6C (tipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE turno ADD CONSTRAINT FK_E797676298C82281 FOREIGN KEY (cola_id) REFERENCES cola (id)');
        $this->addSql('ALTER TABLE cola ADD CONSTRAINT FK_B8A17E89A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_cola (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cola DROP FOREIGN KEY FK_B8A17E89A9276E6C');
        $this->addSql('ALTER TABLE turno DROP FOREIGN KEY FK_E797676298C82281');
        $this->addSql('DROP TABLE turno');
        $this->addSql('DROP TABLE tipo_cola');
        $this->addSql('DROP TABLE cola');
    }
}
