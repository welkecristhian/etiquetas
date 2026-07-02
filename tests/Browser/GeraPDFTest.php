<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class GeraPDFTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_example(): void
    {
        $this->browse(function (Browser $browser) {
            //login do usuário
            $browser->visit('/')
                ->clickLink('Entrar')
                ->waitForText('Usuário')
                ->type('#loginUsuario', '1111')
                ->press('Login')
                ->pause(1000)

              //Para mensangem de erro "o arquivo é obgrigatório"
                ->press('Enviar')
                ->assertSee('O arquivo é obrigatório.')
                ->pause('1000')
            
              //Para verificar a geração de pdf
                ->attach('file', base_path('public/modelo.csv'))
                ->press('Enviar')
                ->waitForLocation('/gera-pdf')
                ->pause('1000');
        });
    }
}