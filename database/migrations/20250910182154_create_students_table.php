<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateStudentsTable extends AbstractMigration
{
    public function change(): void
{
    $table = $this->table('students');
    $table
        ->addColumn('name', 'string', ['limit' => 100, 'null' => false])
        ->addColumn('email', 'string', ['limit' => 100, 'null' => false])
        ->addIndex(['email'], ['unique' => true])
        ->addColumn('birth_date', 'date', ['null' => true])
        ->addTimestamps();

    $table->create();
}


}
