<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327104627 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien_immobilier ADD type_bien_id INT NOT NULL, ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE bien_immobilier ADD CONSTRAINT FK_D1BE34E195B4D7FA FOREIGN KEY (type_bien_id) REFERENCES type_bien (id)');
        $this->addSql('CREATE INDEX IDX_D1BE34E195B4D7FA ON bien_immobilier (type_bien_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien_immobilier DROP FOREIGN KEY FK_D1BE34E195B4D7FA');
        $this->addSql('DROP INDEX IDX_D1BE34E195B4D7FA ON bien_immobilier');
        $this->addSql('ALTER TABLE bien_immobilier DROP type_bien_id, DROP description');
    }
}
