<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateAuthors extends BaseMigration
{
    public function change()
    {
        $table = $this->table('authors');
        $table->addColumn('first_name', 'string', ['limit' => 255])
              ->addColumn('last_name', 'string', ['limit' => 255])
              ->create();
    }
}
