<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCoursesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('courses');
        $table
            ->addColumn('title', 'string', ['limit' => 150, 'null' => false])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('course_area_id', 'integer', ['signed' => false])
            ->addForeignKey('course_area_id', 'course_areas', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addTimestamps();
        $table->create();
    }
}
