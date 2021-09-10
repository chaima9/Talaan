<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210907223401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opportunity ADD territoire_id INT DEFAULT NULL, ADD etapedetransaction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE opportunity ADD CONSTRAINT FK_8389C3D7D0F97A8 FOREIGN KEY (territoire_id) REFERENCES territoire (id)');
        $this->addSql('ALTER TABLE opportunity ADD CONSTRAINT FK_8389C3D7BEDE27E8 FOREIGN KEY (etapedetransaction_id) REFERENCES etapedetransaction (id)');
        $this->addSql('CREATE INDEX IDX_8389C3D7D0F97A8 ON opportunity (territoire_id)');
        $this->addSql('CREATE INDEX IDX_8389C3D7BEDE27E8 ON opportunity (etapedetransaction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opportunity DROP FOREIGN KEY FK_8389C3D7D0F97A8');
        $this->addSql('ALTER TABLE opportunity DROP FOREIGN KEY FK_8389C3D7BEDE27E8');
        $this->addSql('DROP INDEX IDX_8389C3D7D0F97A8 ON opportunity');
        $this->addSql('DROP INDEX IDX_8389C3D7BEDE27E8 ON opportunity');
        $this->addSql('ALTER TABLE opportunity DROP territoire_id, DROP etapedetransaction_id');
    }
}
