<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529121926 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0A99DED506');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0ABA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE commenter RENAME INDEX idx_ab751d0a99ded506 TO IDX_AB751D0ABA091CE5');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0ABA091CE5');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0A99DED506 FOREIGN KEY (id_personne_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commenter RENAME INDEX idx_ab751d0aba091ce5 TO IDX_AB751D0A99DED506');
    }
}
