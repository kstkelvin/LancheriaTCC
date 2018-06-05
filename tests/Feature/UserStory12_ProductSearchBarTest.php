<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory12_ProductSearchTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */

  //GET: Searchbar------------------------------------------------------------//

  public function test_administrador_pode_pesquisar_por_produtos()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create([
      'name' => 'Pimba',
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('GET', '/produtos/pesquisar', array(
      'search' => 'Pim',
    ));
    $response->assertStatus(200);
    $response->assertSee('Pimba');
  }

  public function test_usuário_autenticado_não_pode_pesquisar_por_produtos()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create([
      'name' => 'Pimba',
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('GET', '/produtos/pesquisar', array(
      'search' => 'Pim',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_pesquisar_por_produtos()
  {
    $product = factory(Product::class)->create([
      'name' => 'Pimba',
    ]);
    $response = $this->call('GET', '/produtos/pesquisar', array(
      'search' => 'Pim',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

}
