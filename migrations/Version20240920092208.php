<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240920092208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, motif VARCHAR(150) NOT NULL, interrogation VARCHAR(150) NOT NULL, date_consultation DATETIME NOT NULL, date_cons_prochaine DATETIME NOT NULL, type VARCHAR(15) NOT NULL, suivi VARCHAR(100) NOT NULL, diagnostique VARCHAR(100) NOT NULL, INDEX IDX_964685A66B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation_exam_clinique (consultation_id INT NOT NULL, exam_clinique_id INT NOT NULL, INDEX IDX_B7C070662FF6CDF (consultation_id), INDEX IDX_B7C07063D422EA2 (exam_clinique_id), PRIMARY KEY(consultation_id, exam_clinique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE effectue (id INT AUTO_INCREMENT NOT NULL, consultation_id INT DEFAULT NULL, examen_id INT DEFAULT NULL, resultat VARCHAR(100) NOT NULL, INDEX IDX_8FCB9C1662FF6CDF (consultation_id), INDEX IDX_8FCB9C165C8659A (examen_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exam_clinique (id INT AUTO_INCREMENT NOT NULL, nom_examen VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mutuelle (id INT AUTO_INCREMENT NOT NULL, titre_mutuelle VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, mutuelle_id INT DEFAULT NULL, cni VARCHAR(20) NOT NULL, nom_patient VARCHAR(40) NOT NULL, prenom_patient VARCHAR(30) NOT NULL, adresse VARCHAR(60) NOT NULL, date_naissance DATE NOT NULL, telephone VARCHAR(30) DEFAULT NULL, genre VARCHAR(10) NOT NULL, INDEX IDX_1ADAD7EBC6DA041E (mutuelle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescrire (id INT AUTO_INCREMENT NOT NULL, traitement_id INT NOT NULL, consultation_id INT NOT NULL, prescription VARCHAR(150) NOT NULL, INDEX IDX_D494463DDDA344B6 (traitement_id), INDEX IDX_D494463D62FF6CDF (consultation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traitement (id INT AUTO_INCREMENT NOT NULL, nom_traitement VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(60) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE consultation_exam_clinique ADD CONSTRAINT FK_B7C070662FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_exam_clinique ADD CONSTRAINT FK_B7C07063D422EA2 FOREIGN KEY (exam_clinique_id) REFERENCES exam_clinique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE effectue ADD CONSTRAINT FK_8FCB9C1662FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id)');
        $this->addSql('ALTER TABLE effectue ADD CONSTRAINT FK_8FCB9C165C8659A FOREIGN KEY (examen_id) REFERENCES exam_clinique (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBC6DA041E FOREIGN KEY (mutuelle_id) REFERENCES mutuelle (id)');
        $this->addSql('ALTER TABLE prescrire ADD CONSTRAINT FK_D494463DDDA344B6 FOREIGN KEY (traitement_id) REFERENCES traitement (id)');
        $this->addSql('ALTER TABLE prescrire ADD CONSTRAINT FK_D494463D62FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A66B899279');
        $this->addSql('ALTER TABLE consultation_exam_clinique DROP FOREIGN KEY FK_B7C070662FF6CDF');
        $this->addSql('ALTER TABLE consultation_exam_clinique DROP FOREIGN KEY FK_B7C07063D422EA2');
        $this->addSql('ALTER TABLE effectue DROP FOREIGN KEY FK_8FCB9C1662FF6CDF');
        $this->addSql('ALTER TABLE effectue DROP FOREIGN KEY FK_8FCB9C165C8659A');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBC6DA041E');
        $this->addSql('ALTER TABLE prescrire DROP FOREIGN KEY FK_D494463DDDA344B6');
        $this->addSql('ALTER TABLE prescrire DROP FOREIGN KEY FK_D494463D62FF6CDF');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE consultation_exam_clinique');
        $this->addSql('DROP TABLE effectue');
        $this->addSql('DROP TABLE exam_clinique');
        $this->addSql('DROP TABLE mutuelle');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE prescrire');
        $this->addSql('DROP TABLE traitement');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
