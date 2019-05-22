<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190325160013 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, i_dadresse_id INT NOT NULL, nom_agence VARCHAR(100) NOT NULL, INDEX IDX_64C19AA9869D02D9 (i_dadresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, id_agence_id INT NOT NULL, id_personne_id INT NOT NULL, adresse_mail VARCHAR(250) NOT NULL, photo VARCHAR(1000) DEFAULT NULL, INDEX IDX_268B9C9D57108F2A (id_agence_id), INDEX IDX_268B9C9DBA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent_client (agent_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_99A353733414710B (agent_id), INDEX IDX_99A3537319EB6921 (client_id), PRIMARY KEY(agent_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien_immobilier (id INT AUTO_INCREMENT NOT NULL, superficie INT NOT NULL, nb_pieces INT NOT NULL, etage INT NOT NULL, prix_mise_en_vente DOUBLE PRECISION NOT NULL, prix_min DOUBLE PRECISION NOT NULL, date_mise_en_vente DATE NOT NULL, visites INT NOT NULL, vendue TINYINT(1) NOT NULL, date_vente DATE DEFAULT NULL, prix_vente DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, id_parrain_id INT DEFAULT NULL, id_adresse_id INT NOT NULL, id_personne_id INT NOT NULL, adresse_mail VARCHAR(250) NOT NULL, photo VARCHAR(1000) DEFAULT NULL, INDEX IDX_C74404557BA0FAE0 (id_parrain_id), INDEX IDX_C7440455E86D5C8B (id_adresse_id), INDEX IDX_C7440455BA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_bien_immobilier (client_id INT NOT NULL, bien_immobilier_id INT NOT NULL, INDEX IDX_AC98691219EB6921 (client_id), INDEX IDX_AC9869125992120A (bien_immobilier_id), PRIMARY KEY(client_id, bien_immobilier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commenter (id INT AUTO_INCREMENT NOT NULL, id_client_id INT NOT NULL, id_bien_id INT NOT NULL, date DATE NOT NULL, commentaire LONGTEXT NOT NULL, INDEX IDX_AB751D0A99DED506 (id_client_id), INDEX IDX_AB751D0A6308117F (id_bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE communiquer (id INT AUTO_INCREMENT NOT NULL, id_client_emetteur_id INT NOT NULL, id_client_receveur_id INT NOT NULL, date DATE NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_5B2BAB9BFB80B918 (id_client_emetteur_id), INDEX IDX_5B2BAB9B3B0E71B2 (id_client_receveur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dependance (id INT AUTO_INCREMENT NOT NULL, id_bien_id INT NOT NULL, nom_dependance VARCHAR(100) NOT NULL, superficie INT NOT NULL, INDEX IDX_B43B9E1D6308117F (id_bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(250) NOT NULL, complement_adresse VARCHAR(250) DEFAULT NULL, ville VARCHAR(250) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(250) NOT NULL, prenom VARCHAR(250) NOT NULL, sexe VARCHAR(5) NOT NULL, login VARCHAR(250) NOT NULL, password VARCHAR(250) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, id_bien_id INT NOT NULL, nom_photo VARCHAR(50) DEFAULT NULL, chemin VARCHAR(1000) NOT NULL, INDEX IDX_14B784186308117F (id_bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposer (id INT AUTO_INCREMENT NOT NULL, id_client_id INT NOT NULL, id_bien_id INT NOT NULL, montant_offre DOUBLE PRECISION NOT NULL, contre_proposition DOUBLE PRECISION DEFAULT NULL, INDEX IDX_21866C1599DED506 (id_client_id), INDEX IDX_21866C156308117F (id_bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE telephone (numero INT NOT NULL, id_personne_id INT NOT NULL, id_type_id VARCHAR(100) NOT NULL, INDEX IDX_450FF010BA091CE5 (id_personne_id), INDEX IDX_450FF0101BD125E3 (id_type_id), PRIMARY KEY(numero)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_bien (id INT AUTO_INCREMENT NOT NULL, contraintes LONGTEXT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_telephone (id VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9869D02D9 FOREIGN KEY (i_dadresse_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D57108F2A FOREIGN KEY (id_agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DBA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE agent_client ADD CONSTRAINT FK_99A353733414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent_client ADD CONSTRAINT FK_99A3537319EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404557BA0FAE0 FOREIGN KEY (id_parrain_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455E86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE client_bien_immobilier ADD CONSTRAINT FK_AC98691219EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_bien_immobilier ADD CONSTRAINT FK_AC9869125992120A FOREIGN KEY (bien_immobilier_id) REFERENCES bien_immobilier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0A99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0A6308117F FOREIGN KEY (id_bien_id) REFERENCES bien_immobilier (id)');
        $this->addSql('ALTER TABLE communiquer ADD CONSTRAINT FK_5B2BAB9BFB80B918 FOREIGN KEY (id_client_emetteur_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE communiquer ADD CONSTRAINT FK_5B2BAB9B3B0E71B2 FOREIGN KEY (id_client_receveur_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE dependance ADD CONSTRAINT FK_B43B9E1D6308117F FOREIGN KEY (id_bien_id) REFERENCES bien_immobilier (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784186308117F FOREIGN KEY (id_bien_id) REFERENCES bien_immobilier (id)');
        $this->addSql('ALTER TABLE proposer ADD CONSTRAINT FK_21866C1599DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE proposer ADD CONSTRAINT FK_21866C156308117F FOREIGN KEY (id_bien_id) REFERENCES bien_immobilier (id)');
        $this->addSql('ALTER TABLE telephone ADD CONSTRAINT FK_450FF010BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE telephone ADD CONSTRAINT FK_450FF0101BD125E3 FOREIGN KEY (id_type_id) REFERENCES type_telephone (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D57108F2A');
        $this->addSql('ALTER TABLE agent_client DROP FOREIGN KEY FK_99A353733414710B');
        $this->addSql('ALTER TABLE client_bien_immobilier DROP FOREIGN KEY FK_AC9869125992120A');
        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0A6308117F');
        $this->addSql('ALTER TABLE dependance DROP FOREIGN KEY FK_B43B9E1D6308117F');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784186308117F');
        $this->addSql('ALTER TABLE proposer DROP FOREIGN KEY FK_21866C156308117F');
        $this->addSql('ALTER TABLE agent_client DROP FOREIGN KEY FK_99A3537319EB6921');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404557BA0FAE0');
        $this->addSql('ALTER TABLE client_bien_immobilier DROP FOREIGN KEY FK_AC98691219EB6921');
        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0A99DED506');
        $this->addSql('ALTER TABLE communiquer DROP FOREIGN KEY FK_5B2BAB9BFB80B918');
        $this->addSql('ALTER TABLE communiquer DROP FOREIGN KEY FK_5B2BAB9B3B0E71B2');
        $this->addSql('ALTER TABLE proposer DROP FOREIGN KEY FK_21866C1599DED506');
        $this->addSql('ALTER TABLE agence DROP FOREIGN KEY FK_64C19AA9869D02D9');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455E86D5C8B');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DBA091CE5');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BA091CE5');
        $this->addSql('ALTER TABLE telephone DROP FOREIGN KEY FK_450FF010BA091CE5');
        $this->addSql('ALTER TABLE telephone DROP FOREIGN KEY FK_450FF0101BD125E3');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE agent_client');
        $this->addSql('DROP TABLE bien_immobilier');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_bien_immobilier');
        $this->addSql('DROP TABLE commenter');
        $this->addSql('DROP TABLE communiquer');
        $this->addSql('DROP TABLE dependance');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE proposer');
        $this->addSql('DROP TABLE telephone');
        $this->addSql('DROP TABLE type_bien');
        $this->addSql('DROP TABLE type_telephone');
    }
}
