<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310235706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creacion del usuario administrador';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $sql = "INSERT INTO `user` (`id`, `email`, `roles`, `password`, `password_request_token`) 
                VALUES (4, 'admin@admin.com', '["ROLE_USER", "ROLE_ADMIN"]', '$argon2id$v=19$m=65536,t=4,p=1$+GTfVL+z/vt77nUYQ+NrhA$eckMzul8qHyy8ACExBkM31kbRmf94Wtau8mzoippcSc', NULL);";
        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM `user` WHERE email="admin@admin.com"');
    }
}
