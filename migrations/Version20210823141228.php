<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823141228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, jeuxvideo_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2C8FCB884A (jeuxvideo_id), INDEX IDX_7CC7DA2CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C8FCB884A FOREIGN KEY (jeuxvideo_id) REFERENCES jeuxvideo (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE categorie_jeuxvideo ADD CONSTRAINT FK_F9D4E35DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_jeuxvideo ADD CONSTRAINT FK_F9D4E35D8FCB884A FOREIGN KEY (jeuxvideo_id) REFERENCES jeuxvideo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8FCB884A FOREIGN KEY (jeuxvideo_id) REFERENCES jeuxvideo (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F8FCB884A FOREIGN KEY (jeuxvideo_id) REFERENCES jeuxvideo (id)');
        $this->addSql('ALTER TABLE jeuxvideo ADD CONSTRAINT FK_548BEC5A391E226B FOREIGN KEY (plateforme_id) REFERENCES plateforme (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE video');
        $this->addSql('ALTER TABLE categorie_jeuxvideo DROP FOREIGN KEY FK_F9D4E35DBCF5E72D');
        $this->addSql('ALTER TABLE categorie_jeuxvideo DROP FOREIGN KEY FK_F9D4E35D8FCB884A');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8FCB884A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F8FCB884A');
        $this->addSql('ALTER TABLE jeuxvideo DROP FOREIGN KEY FK_548BEC5A391E226B');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
