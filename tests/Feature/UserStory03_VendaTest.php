<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory03_VendaTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */

  //GET: Create---------------------------------------------------------------//

  public function test_administrador_pode_acessar_a_função_de_venda_para_funcionários()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/venda');
    $response->assertStatus(200);
    $response->assertViewHas('clients');
    $response->assertViewHas('products');
  }

  public function test_usuário_autenticado_não_pode_acessar_a_função_de_venda_para_funcionários()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/venda');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_acessar_a_função_de_venda_para_funcionários()
  {
    $product = factory(Product::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->get('/venda');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Create--------------------------------------------------------------//

  public function test_administrador_pode_creditar_item_comprado_a_conta_de_um_cliente()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/venda', array(
      'client_id' => $client->id,
      'product_id' => $product->id,
      'amount' => 1,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_usuário_autenticado_não_pode_creditar_item_comprado_a_conta_de_um_cliente()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $client = factory(Client::class)->create();
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/venda', array(
      'client_id' => $client->id,
      'product_id' => $product->id,
      'amount' => 1,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_creditar_item_comprado_a_conta_de_um_cliente()
  {
    $client = factory(Client::class)->create();
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $response = $this->call('POST', '/venda', array(
      'client_id' => $client->id,
      'product_id' => $product->id,
      'amount' => 1,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Delete--------------------------------------------------------------//

  public function test_administrador_pode_excluir_item_da_conta_de_um_cliente()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $product = factory(Product::class)->create();
    $item = factory(Item::class)->create([
      'client_id' => $client->id,
      'product_id' => $product->id,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/venda/'.$item->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/cliente/'.$client->id);
  }

  public function test_usuário_autenticado_não_pode_excluir_item_da_conta_de_um_cliente()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $client = factory(Client::class)->create();
    $product = factory(Product::class)->create();
    $item = factory(Item::class)->create([
      'client_id' => $client->id,
      'product_id' => $product->id,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/venda/'.$item->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_excluir_item_da_conta_de_um_cliente()
  {
    $client = factory(Client::class)->create();
    $product = factory(Product::class)->create();
    $item = factory(Item::class)->create([
      'client_id' => $client->id,
      'product_id' => $product->id,
    ]);
    $response = $this->call('POST', '/venda/'.$item->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

}
