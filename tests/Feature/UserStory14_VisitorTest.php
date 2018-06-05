<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory14_VisitorTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */

  //GET: Venda----------------------------------------------------------------//


  public function test_administrador_pode_acessar_a_função_de_venda_para_visitantes()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/visitantes');
    $response->assertStatus(200);
    $response->assertViewHas('products');
    $response->assertViewHas('items');
    $response->assertViewHas('total');
  }

  public function test_usuário_autenticado_não_pode_acessar_a_função_de_venda_para_visitantes()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/visitantes');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_acessar_a_função_de_venda_para_visitantes()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $response = $this->get('/visitantes');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Venda---------------------------------------------------------------//

  public function test_administrador_pode_adicionar_produto_na_nota_para_visitantes()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/visitantes', array(
      'product_id' => $product->id,
      'amount' => 1,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/visitantes');
  }

  public function test_usuário_autenticado_não_pode_adicionar_produto_na_nota_para_visitantes()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/visitantes', array(
      'product_id' => $product->id,
      'amount' => 1,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_adicionar_produto_na_nota_para_visitantes()
  {
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $response = $this->call('POST', '/visitantes', array(
      'product_id' => $product->id,
      'amount' => 1,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }
  //POST: Pagamento para visitantes-------------------------------------------//

  public function test_administrador_pode_gerar_nota_eletrônica_para_visitantes()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $item = factory(Item::class)->create([
      'client_id' => null,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/visitantes/pagamento');
    $response->assertSee('O pagamento foi realizado com sucesso.');
  }

  public function test_usuário_autenticado_não_pode_gerar_nota_eletrônica_para_visitantes()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $item = factory(Item::class)->create([
      'client_id' => null,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/visitantes/pagamento');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_gerar_nota_eletrônica_para_visitantes()
  {
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $item = factory(Item::class)->create([
      'client_id' => null,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->call('POST', '/visitantes/pagamento');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Cancelar venda------------------------------------------------------//
  public function test_administrador_pode_cancelar_a_venda_para_visitantes()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $item = factory(Item::class)->create([
      'client_id' => null,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/visitantes/cancelar');
    $response->assertStatus(302);
    $response->assertRedirect('/visitantes');
  }

  public function test_usuário_autenticado_não_pode_cancelar_a_venda_para_visitantes()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $item = factory(Item::class)->create([
      'client_id' => null,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/visitantes/cancelar');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_cancelar_a_venda_para_visitantes()
  {
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $item = factory(Item::class)->create([
      'client_id' => null,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->call('POST', '/visitantes/cancelar');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }
  //POST: Excluir item da venda-----------------------------------------------//

  public function test_administrador_pode_excluir_itens_da_venda_para_visitantes()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $item = factory(Item::class)->create([
      'client_id' => null,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/visitantes/'.$item->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/visitantes');
  }

  public function test_usuário_autenticado_não_pode_excluir_itens_da_venda_para_visitantes()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $item = factory(Item::class)->create([
      'client_id' => null,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/visitantes/'.$item->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_excluir_itens_da_venda_para_visitantes()
  {
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $item = factory(Item::class)->create([
      'client_id' => null,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->call('POST', '/visitantes/'.$item->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

}
