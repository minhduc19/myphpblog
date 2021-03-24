<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateLikes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('likes');
        $table->addColumn('vote', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('answer_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('article_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('comment_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addIndex([
            'answer_id',
        
            ], [
            'name' => 'BY_ANSWER_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'article_id',
        
            ], [
            'name' => 'BY_ARTICLE_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'user_id',
        
            ], [
            'name' => 'BY_USER_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'comment_id',
        
            ], [
            'name' => 'BY_COMMENT_ID',
            'unique' => false,
        ]);
        $table->create();
    }
}
