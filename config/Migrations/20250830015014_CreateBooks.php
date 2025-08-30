<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateBooks extends BaseMigration
{
    public function change()
    {
        $table = $this->table('books');
        $table->addColumn('title', 'string', ['limit' => 255])
              ->addColumn('year', 'integer')
              ->addColumn('author_id', 'integer')
              ->addForeignKey('author_id', 'authors', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
              ->create();
    }
}
