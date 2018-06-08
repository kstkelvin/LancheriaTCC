<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory02_ClientesTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */

  //GET: Index----------------------------------------------------------------//
  public function test_administrador_pode_visualizar_a_lista_de_clientes()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/clientes');
    $response->assertStatus(200);
    $response->assertViewHas('clients');
    $response->assertSee($client->name);
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_lista_de_clientes()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/clientes');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_visualizar_a_lista_de_clientes()
  {
    $client = factory(Client::class)->create();
    $response = $this->get('/clientes');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Create---------------------------------------------------------------//

  public function test_administrador_pode_visualizar_a_tela_de_cadastro_de_clientes()
  {
    $user = factory(User::class)->create();
    $response =$this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/clientes/adicionar');
    $response->assertStatus(200);
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_tela_de_cadastro_de_clientes()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $response =$this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/clientes/adicionar');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_visualizar_a_tela_de_cadastro_de_clientes()
  {
    $response =$this->get('/clientes/adicionar');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Create--------------------------------------------------------------//
  public function test_administrador_pode_cadastrar_novo_cliente()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/clientes', array(
      'name' => 'super',
      'surname' => 'duper',
      'setor' => 'Amanhã',
      'phone_number' => '',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/clientes');
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/clientes');
    $response->assertSee('super duper');
  }

  public function test_usuário_autenticado_não_pode_cadastrar_novo_cliente()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/clientes', array(
      'name' => 'super',
      'surname' => 'duper',
      'setor' => 'Amanhã',
      'phone_number' => '',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_cadastrar_novo_cliente()
  {
    $response = $this->call('POST', '/clientes', array(
      'name' => 'super',
      'surname' => 'duper',
      'setor' => 'Amanhã',
      'phone_number' => '',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Edit-----------------------------------------------------------------//
  public function test_administrador_pode_visualizar_a_edição_do_perfil_de_um_cliente_específico()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/cliente/'.$client->id.'/editar');
    $response->assertStatus(200);
    $response->assertViewHas('client');
    $response->assertSee($client->name);
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_edição_do_perfil_de_um_cliente_específico()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/cliente/'.$client->id.'/editar');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_visualizar_a_edição_do_perfil_de_um_cliente_específico()
  {
    $client = factory(Client::class)->create();
    $response = $this->get('/cliente/'.$client->id.'/editar');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Edit----------------------------------------------------------------//

  public function test_administrador_pode_editar_cliente()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/cliente/'.$client->id, array(
      'name' => 'super',
      'surname' => 'duper',
      'setor' => 'Amanhã',
      'phone_number' => '',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/clientes');
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/clientes');
    $response->assertSee('super duper');
  }

  public function test_usuário_autenticado_não_pode_editar_cliente()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/cliente/'.$client->id, array(
      'name' => 'super',
      'surname' => 'duper',
      'setor' => 'Amanhã',
      'phone_number' => '',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_editar_cliente()
  {
    $client = factory(Client::class)->create();
    $response = $this->call('POST', '/cliente/'.$client->id, array(
      'name' => 'super',
      'surname' => 'duper',
      'setor' => 'Amanhã',
      'phone_number' => '',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Show-----------------------------------------------------------------//

  public function test_administrador_pode_visualizar_o_perfil_de_um_cliente_específico()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/cliente/'.$client->id);
    $response->assertStatus(200);
    $response->assertViewHas('client');
    $response->assertViewHas('items');
    $response->assertViewHas('user');
    $response->assertViewHas('chart_clients');
    $response->assertSee($client->name);
  }

  public function test_usuário_autenticado_nao_pode_visualizar_o_perfil_de_um_cliente_específico()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/cliente/'.$client->id);
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_nao_autenticado_nao_pode_visualizar_o_perfil_de_um_cliente_específico()
  {
    $client = factory(Client::class)->create();
    $response = $this->get('/cliente/'.$client->id);
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }


  //POST: Delete--------------------------------------------------------------//

  public function test_administrador_pode_excluir_cliente()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/cliente/'.$client->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/clientes');
  }

  public function test_usuário_autenticado_não_pode_excluir_cliente()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/cliente/'.$client->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_excluir_cliente()
  {
    $client = factory(Client::class)->create();
    $response = $this->call('POST', '/cliente/'.$client->id.'/excluir');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: History--------------------------------------------------------------//

  public function test_administrador_pode_visualizar_o_histórico_de_um_cliente_específico()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/cliente/'.$client->id.'/historico');
    $response->assertStatus(200);
    $response->assertViewHas('client');
    $response->assertViewHas('items');
    $response->assertViewHas('user');
    $response->assertSee($client->name);
  }

  public function test_usuário_autenticado_não_pode_visualizar_o_histórico_de_um_cliente_específico()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/cliente/'.$client->id.'/historico');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_visualizar_o_histórico_de_um_cliente_específico()
  {
    $client = factory(Client::class)->create();
    $response = $this->get('/cliente/'.$client->id.'/historico');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

}
