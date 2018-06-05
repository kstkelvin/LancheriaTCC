<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory09_StockTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */

  use RefreshDatabase;

  //GET: Stock----------------------------------------------------------------//


  public function test_administrador_pode_acrescentar_ao_estoque_de_produtos()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produto/'.$product->id.'/estoque');
    $response->assertStatus(200);
    $response->assertViewHas('product');
  }

  public function test_usuário_autenticado_não_pode_acrescentar_ao_estoque_de_produtos()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produto/'.$product->id.'/estoque');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_acrescentar_ao_estoque_de_produtos()
  {
    $product = factory(Product::class)->create();
    $response = $this->get('/produto/'.$product->id.'/estoque');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Stock---------------------------------------------------------------//

  public function test_administrador_pode_adicionar_no_estoque()

  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/produto/'.$product->id.'/armazem', array(
      'stock' => 1,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/produto/'.$product->id);
  }

  public function test_usuário_autenticado_não_pode_adicionar_no_estoque()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/produto/'.$product->id.'/armazem', array(
      'stock' => 1,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_adicionar_no_estoque()
  {
    $product = factory(Product::class)->create();
    $response = $this->call('POST', '/produto/'.$product->id.'/armazem', array(
      'stock' => 1,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

}
