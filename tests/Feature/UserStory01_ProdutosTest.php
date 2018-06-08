<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory01_ProdutosTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */


  //GET: Index----------------------------------------------------------------//
  public function test_administrador_pode_visualizar_a_lista_de_produtos()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produtos');
    $response->assertStatus(200);
    $response->assertViewHas('products');
    $response->assertSee($product->name);
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_lista_de_produtos()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produtos');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_visualizar_a_lista_de_produtos()
  {
    $product = factory(Product::class)->create();
    $response = $this->get('/produtos');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Create---------------------------------------------------------------//

  public function test_administrador_pode_visualizar_a_tela_de_cadastro_de_produtos()

  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produtos/adicionar');
    $response->assertStatus(200);
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_tela_de_cadastro_de_produtos()

  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produtos/adicionar');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_visualizar_a_tela_de_cadastro_de_produtos()

  {
    $response = $this->get('/produtos/adicionar');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Create--------------------------------------------------------------//
  public function test_administrador_pode_cadastrar_novo_produto()

  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/produtos', array(
      'name' => 'super',
      'price' => 1.5,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/produtos');
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produtos');
    $response->assertSee('super');
  }

  public function test_usuário_autenticado_não_pode_cadastrar_novo_produto()

  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/produtos', array(
      'name' => 'super',
      'price' => 1.5,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_cadastrar_novo_produto()

  {
    $response = $this->call('POST', '/produtos', array(
      'name' => 'super',
      'price' => 1.5,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Edit-----------------------------------------------------------------//
  public function test_administrador_pode_visualizar_a_edição_de_produtos()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produto/'.$product->id.'/editar');
    $response->assertStatus(200);
    $response->assertViewHas('product');
    $response->assertSee($product->name);
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_edição_de_produtos()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produto/'.$product->id.'/editar');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }
  public function test_usuário_não_autenticado_não_pode_visualizar_a_edição_de_produtos()
  {
    $product = factory(Product::class)->create();
    $response = $this->get('/produto/'.$product->id.'/editar');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }
  //POST: Edit----------------------------------------------------------------//

  public function test_administrador_pode_editar_produtos()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/produto/'.$product->id, array(
      'name' => 'super',
      'price' => 1.5,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/produtos');
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produtos');
    $response->assertSee('super');
  }

  public function test_usuário_autenticado_não_pode_editar_produtos()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/produto/'.$product->id, array(
      'name' => 'super',
      'price' => 1.5,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_editar_produtos()
  {
    $product = factory(Product::class)->create();
    $response = $this->call('POST', '/produto/'.$product->id, array(
      'name' => 'super',
      'price' => 1.5,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Show-----------------------------------------------------------------//

  public function test_administrador_pode_visualizar_um_produto_em_específico()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produto/'.$product->id);
    $response->assertStatus(200);
    $response->assertViewHas('product');
    $response->assertViewHas('chart_products');
    $response->assertSee($product->name);
  }

  public function test_usuário_autenticado_não_pode_visualizar_um_produto_em_específico()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/produto/'.$product->id);
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }
  public function test_usuário_não_autenticado_não_pode_visualizar_um_produto_em_específico()
  {
    $product = factory(Product::class)->create();
    $response = $this->get('/produto/'.$product->id);
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }
  //POST: Delete--------------------------------------------------------------//

  public function test_administrador_pode_excluir_produto()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/produto/'.$product->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/produtos');
  }

  public function test_usuário_autenticado_não_pode_excluir_produto()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/produto/'.$product->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autorizado_não_pode_excluir_produto()
  {
    $product = factory(Product::class)->create();
    $response = $this->call('POST', '/produto/'.$product->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

}
