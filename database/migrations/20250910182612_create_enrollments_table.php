<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateEnrollmentsTable extends AbstractMigration
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
    $table = $this->table('enrollments');
    $table
        ->addColumn('student_id', 'integer', ['signed' => false])
        ->addForeignKey('student_id', 'students', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->addColumn('course_id', 'integer', ['signed' => false])
        ->addForeignKey('course_id', 'courses', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->addTimestamps();
    $table->create();
}

}
