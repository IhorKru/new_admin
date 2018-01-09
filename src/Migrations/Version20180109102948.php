<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180109102948 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE email_status (id INT AUTO_INCREMENT NOT NULL, emailaddress VARCHAR(100) NOT NULL, emailstatus VARCHAR(100) NOT NULL, datecreated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP INDEX UNIQ_E3737470BF396750 ON campaigns');
        $this->addSql('DROP INDEX UNIQ_8269FA5BF396750 ON lists');
        $this->addSql('DROP INDEX UNIQ_2FCD16ACBF396750 ON subscribers');
        $this->addSql('DROP INDEX UNIQ_97601F83BF396750 ON template');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE email_status');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E3737470BF396750 ON campaigns (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8269FA5BF396750 ON lists (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FCD16ACBF396750 ON subscribers (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97601F83BF396750 ON template (id)');
    }
}
