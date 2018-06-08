<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory05_UserTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */


  //GET: User Homepage--------------------------------------------------------//

  public function test_usuarios_autenticados_podem_acessar_a_homepage_de_usuario()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/home');
    $response->assertStatus(200);
  }

  public function test_administradores_nao_podem_acessar_a_homepage_de_usuario()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/home');
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_usuarios_nao_autenticados_nao_podem_acessar_a_homepage_de_usuario()
  {
    $response = $this->get('/home');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Account--------------------------------------------------------------//

  public function test_conta_de_usuario_pode_ser_acessada_pelo_usuario_autenticado_com_conta()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 1,
    ]);
    $client = factory(Client::class)->create([
      'user_id' => $user->id,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/conta');
    $response->assertStatus(200);
    $response->assertViewHas('client');
    $response->assertViewHas('items');
    $response->assertViewHas('total');
  }

  public function test_conta_de_usuario_nao_pode_ser_acessada_pelo_usuario_autenticado_sem_conta()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 0,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/conta');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_conta_de_usuario_nao_pode_ser_acessada_pelo_administrador()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/conta');
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_conta_de_usuario_nao_pode_ser_acessada_por_usuario_nao_autenticado()
  {
    $response = $this->get('/conta');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  public function test_conta_de_usuario_nao_pode_ser_acessada_por_outro_usuario_autenticado()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 1,
    ]);
    $client = factory(Client::class)->create([
      'user_id' => 100,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/conta');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  //GET: User History---------------------------------------------------------//

  public function test_historico_do_usuario_pode_ser_acessado_pelo_usuario_autenticado()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 1,
    ]);
    $client = factory(Client::class)->create([
      'user_id' => $user->id,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/historico');
    $response->assertStatus(200);
    $response->assertViewHas('client');
    $response->assertViewHas('items');
  }

  public function test_historico_do_usuario_nao_pode_ser_acessado_pelo_administrador()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/historico');
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_historico_do_usuario_nao_pode_ser_acessado_pelo_usuario_nao_autenticado()
  {
    $response = $this->get('/historico');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  public function test_historico_do_usuario_nao_pode_ser_acessado_por_outro_usuario()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 1,
    ]);
    $client = factory(Client::class)->create([
      'user_id' => 100,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/historico');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
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

  public function test_usuário_autenticado_pode_abrir_a_tela_de_alteração_de_senha()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/senha');
    $response->assertStatus(200);
  }

  public function test_usuário_autenticado_não_pode_abrir_a_tela_de_alteração_de_senha()
  {
    $user = factory(User::class)->create();
    $response = $this->get('/senha');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //POST: Password Change-----------------------------------------------------//

  public function test_usuário_autenticado_pode_trocar_a_própria_senha()
  {
    $user = factory(User::class)->create([
      'password' => bcrypt('amendoimcomamente'),
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/senha', array(
      'current-password' => 'amendoimcomamente',
      'password' => 'amendoim77mente',
      'password_confirmation' => 'amendoim77mente',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_usuário_não_autenticado_não_pode_trocar_senha()
  {
    $user = factory(User::class)->create([
      'password' => bcrypt('amendoimcomamente'),
    ]);
    $response = $this->call('POST', '/senha', array(
      'current-password' => 'amendoimcomamente',
      'password' => 'amendoim77mente',
      'password_confirmation' => 'amendoim77mente',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Custom Quest---------------------------------------------------------//

  public function test_usuário_autenticado_pode_abrir_a_tela_de_configuração_da_pergunta_customizada_para_a_recuperação_de_senha()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/adicionar-pergunta');
    $response->assertStatus(200);
  }

  public function test_usuário_não_autenticado_não_pode_abrir_a_tela_de_configuração_da_pergunta_customizada_para_a_recuperação_de_senha()
  {
    $response = $this->get('/adicionar-pergunta');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }


  //POST: Custom Quest--------------------------------------------------------//

  public function test_usuário_autenticado_pode_adicionar_pergunta_customizada_para_a_recuperação_de_senha()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/prosseguir', array(
      'custom_quest' => 'Expande?',
      'custom_quest_answer' => 'A mente!',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_usuário_não_autenticado_não_pode_adicionar_pergunta_customizada_para_a_recuperação_de_senha()
  {
    $response = $this->call('POST', '/prosseguir', array(
      'custom_quest' => 'Expande?',
      'custom_quest_answer' => 'A mente!',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Recuperação de E-mail------------------------------------------------//

  public function test_usuário_não_autenticado_pode_visualizar_a_tela_da_recuperação_de_senha()
  {
    $response = $this->get('/email');
    $response->assertStatus(200);
  }

  public function test_usuário_autenticado_não_pode_visualizar_a_tela_da_recuperação_de_senha()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/email');
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  //POST: Recuperação de E-mail-----------------------------------------------//

  public function test_usuário_não_autenticado_com_conta_pode_realizar_a_recuperação_da_senha()
  {
    $user = factory(User::class)->create([
      'custom_quest' => 'O que expande?',
      'custom_quest_answer' => 'A minha mente!',
    ]);
    $response = $this->call('POST', '/email', array(
      'email' => $user->email,
    ));
    $response->assertStatus(200);
    $response->assertViewIs('auth.passwords.confirm');
    $response = $this->call('POST', '/confirm', array(
      'email' => $user->email,
      'custom_quest_answer' => 'A minha mente!',
    ));
    $response->assertStatus(200);
    $response->assertViewIs('auth.passwords.reset');
    $response = $this->call('POST', '/reset', array(
      'email' => $user->email,
      'password' => 'amendoim77mente',
      'password_confirmation' => 'amendoim77mente',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  public function test_usuário_autenticado_não_pode_realizar_a_recuperação_da_senha()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/email', array(
      'email' => $user->email,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_usuário_não_autenticado_sem_conta_não_pode_realizar_a_recuperação_da_senha()
  {
    $response = $this->call('POST', '/email', array(
      'email' => 'idont@example.com',
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  public function test_usuário_não_autenticado_com_conta_mas_sem_a_pergunta_de_recuperação_de_senha_não_pode_realizar_a_recuperação_da_senha()
  {
    $user = factory(User::class)->create([
      'custom_quest' => null,
      'custom_quest_answer' => null,
    ]);
    $response = $this->call('POST', '/email', array(
      'email' => $user->email,
    ));
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

  //GET: Custom Quest---------------------------------------------------------//
  //GET: Custom Quest---------------------------------------------------------//


}
