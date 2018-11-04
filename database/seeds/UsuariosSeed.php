<?php


use Phinx\Seed\AbstractSeed;

class UsuariosSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'login' => 'email@email.com',
                'senha' => password_hash('1234', PASSWORD_BCRYPT)
            ],
        ];
        $ufs = $this->table('usuarios');
        $ufs->insert($data)->save();
    }
}
