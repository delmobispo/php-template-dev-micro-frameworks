<?php


use Phinx\Migration\AbstractMigration;

class CategoriasMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('categorias', ['id' => 'cod']);
        $table->addColumn('nome','string', ['limit' => 50, 'null' => false])
            ->addIndex(['nome'], ['unique' => true, 'name' => 'idx_cat_nome'])
            ->create();
    }
}
