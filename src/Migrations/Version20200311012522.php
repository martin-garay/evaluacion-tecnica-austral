<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311012522 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {            
        $this->addSql('INSERT INTO tipo_cola(id,descripcion) VALUES(1,"FIFO")');
    }

    public function down(Schema $schema) : void
    {     
        $this->addSql('DELETE FROM tipo_cola WHERE id=1');
    }
}
