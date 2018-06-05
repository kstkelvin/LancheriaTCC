<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory08_ClientSearchTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */


  //GET: Searchbar------------------------------------------------------------//


  public function test_administrador_pode_pesquisar_por_clientes()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create([
      'name' => 'Pimba',
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('GET', '/clientes/pesquisar', array(
      'search' => 'Pim',
    ));
    $response->assertStatus(200);
    $response->assertSee('Pimba');
  }

  public function test_usuário_autenticado_não_pode_pesquisar_por_clientes()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $client = factory(Client::class)->create([
      'name' => 'Pimba',
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('GET', '/clientes/pesquisar', array(
      'search' => 'Pim',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_pesquisar_por_clientes()
  {
    $client = factory(Client::class)->create([
      'name' => 'Pimba',
    ]);
    $response = $this->call('GET', '/clientes/pesquisar', array(
      'search' => 'Pim',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }


}
