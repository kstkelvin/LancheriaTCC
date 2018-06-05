<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory04_AdminTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */

  //GET: Login----------------------------------------------------------------//

  public function test_usuário_não_autenticado_pode_visualizar_a_tela_de_login()
  {
    $response = $this->get('/login');
    $response->assertStatus(200);
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_tela_de_login()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/login');
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  //POST: Login---------------------------------------------------------------//


  public function test_usuário_não_autenticado_pode_efetuar_login()
  {
    $user = factory(User::class)->create();
    $response = $this->call('POST', '/login', array(
      'email' => $user->email,
      'password' => $user->password,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_usuário_autenticado_não_pode_efetuar_login()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $user2 = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/login', array(
      'email' => $user2->email,
      'password' => $user2->password,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  //GET: Logout---------------------------------------------------------------//

  public function test_usuário_autenticado_pode_efetuar_logout()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/logout');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Register-------------------------------------------------------------//

  public function test_usuário_não_autenticado_pode_visualizar_a_tela_de_cadastro()
  {
    $response = $this->get('/registrar');
    $response->assertStatus(200);
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_tela_de_cadastro()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/registrar');
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  //POST: Register------------------------------------------------------------//

  public function test_usuário_não_autenticado_pode_efetuar_cadastro()
  {
    $response = $this->call('POST', '/registrar', array(
      'email' => 'pensamamente@example.com',
      'name' => 'Superpimpa',
      'surname' => 'Douper',
      'password' => 'amendoim77225',
      'password_confirmation' => 'amendoim77225',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_autenticado_não_pode_efetuar_cadastro()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/registrar', array(
      'email' => 'userpensacomamente@example.com',
      'name' => 'super',
      'surname' => 'duper',
      'password' => 'amendoim77',
      'password_confirmation' => 'amendoim77',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  //GET: Admin Homepage-------------------------------------------------------//

  public function test_administradores_podem_acessar_a_homepage_de_administrador()
  {

    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/');
    $response->assertStatus(200);
    $response->assertViewHas('count');
    $response->assertViewHas('clientes');
  }

  public function test_usuarios_autenticados_nao_podem_acessar_a_homepage_de_administrador()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuarios_nao_autenticados_nao_podem_acessar_a_homepage_de_administrador()
  {
    $response = $this->get('/');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }


  //GET: Edit-----------------------------------------------------------------//

  public function test_usuário_autenticado_pode_visualizar_a_tela_de_edição_de_usuário()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/editar');
    $response->assertStatus(200);
    $response->assertViewHas('user');
  }

  public function test_usuário_nao_autenticado_não_pode_visualizar_a_tela_de_edição_de_usuário()
  {
    $response = $this->get('/editar');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Edit----------------------------------------------------------------//

  public function test_usuário_autenticado_pode_editar_os_dados_próprios()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/editar', array(
      'name' => 'super',
      'surname' => 'duper',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_usuário_não_autenticado_não_pode_editar_os_dados_próprios()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $response = $this->call('POST', '/editar', array(
      'name' => 'super',
      'surname' => 'duper',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: About----------------------------------------------------------------//

  public function test_usuário_autenticado_pode_ver_a_tela_sobre_a_lancheria()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/sobre');
    $response->assertStatus(200);
  }

  public function test_usuário_não_autenticado_não_pode_ver_a_tela_sobre_a_lancheria()
  {
    $response = $this->get('/sobre');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Password Change------------------------------------------------------//

  public function test_get_pass_user()
  {
    // code...
  }

  public function test_get_pass_guest()
  {
    // code...
  }

  //POST: Password Change-----------------------------------------------------//

  public function test_post_pass_user()
  {
    // code...
  }

  public function test_post_pass_guest()
  {
    // code...
  }

  //GET: Bind-----------------------------------------------------------------//
  public function test_administrador_pode_visualizar_a_lista_de_usuários_não_vinculados()
  {
    $user = factory(User::class)->create();
    $user2 = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 0,
    ]);
    $client = factory(Client::class)->create([
      'user_id' => null,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/cliente/'.$client->id.'/bind');
    $response->assertStatus(200);
    $response->assertViewHas('client');
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_lista_de_usuários_não_vinculados()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/cliente/1/bind');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autorizado_não_pode_visualizar_a_lista_de_usuários_não_vinculados()
  {
    $response = $this->get('/cliente/1/bind');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Bind----------------------------------------------------------------//

  public function test_administrador_pode_vincular_a_conta_de_cliente_a_uma_de_usuário()
  {
    $user = factory(User::class)->create();
    $user2 = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 0,
    ]);
    $client = factory(Client::class)->create([
      'user_id' => null,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/cliente/'.$client->id.'/bind', array(
      'user_id' => $user2->id,
      'id' => $client->id,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_usuário_autenticado_não_pode_vincular_a_conta_de_cliente_a_uma_de_usuário()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $user2 = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 0,
    ]);
    $client = factory(Client::class)->create([
      'user_id' => null,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/cliente/'.$client->id.'/bind', array(
      'user_id' => $user2->id,
      'id' => $client->id,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autenticado_não_pode_vincular_a_conta_de_cliente_a_uma_de_usuário()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 0,
    ]);
    $client = factory(Client::class)->create([
      'user_id' => null,
    ]);
    $response = $this->call('POST', '/cliente/'.$client->id.'/bind', array(
      'user_id' => $user->id,
      'id' => $client->id,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

}
