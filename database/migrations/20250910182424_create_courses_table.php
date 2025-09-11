<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCoursesTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('courses');
        $table
            ->addColumn('title', 'string', ['limit' => 150, 'null' => false])
            ->addColumn('description', 'text', ['null' => true])
            ->addTimestamps();
        $table->create();
    }
}
