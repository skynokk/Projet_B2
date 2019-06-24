<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529132544 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BA091CE5');
        $this->addSql('DROP INDEX IDX_C7440455BA091CE5 ON client');
        $this->addSql('ALTER TABLE client CHANGE id_client_id id_personne_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('CREATE INDEX IDX_C7440455BA091CE5 ON client (id_personne_id)');
        $this->addSql('DROP INDEX IDX_AB751D0A99DED506 ON commenter');
        $this->addSql('ALTER TABLE commenter CHANGE id_personne_id id_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0A99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_AB751D0A99DED506 ON commenter (id_client_id)');
        $this->addSql('ALTER TABLE personne CHANGE avatar avatar VARCHAR(250) NOT NULL, CHANGE agent agent VARCHAR(250) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BA091CE5');
        $this->addSql('DROP INDEX IDX_C7440455BA091CE5 ON client');
        $this->addSql('ALTER TABLE client CHANGE id_personne_id id_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BA091CE5 FOREIGN KEY (id_client_id) REFERENCES personne (id)');
        $this->addSql('CREATE INDEX IDX_C7440455BA091CE5 ON client (id_client_id)');
        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0A99DED506');
        $this->addSql('DROP INDEX IDX_AB751D0A99DED506 ON commenter');
        $this->addSql('ALTER TABLE commenter CHANGE id_client_id id_personne_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_AB751D0A99DED506 ON commenter (id_personne_id)');
        $this->addSql('ALTER TABLE personne CHANGE avatar avatar VARCHAR(255) DEFAULT \'images/avatar.png\' COLLATE utf8mb4_unicode_ci, CHANGE agent agent VARCHAR(250) DEFAULT \'0\' COLLATE utf8mb4_unicode_ci');
    }
}
