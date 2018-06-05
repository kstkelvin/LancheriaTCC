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



}
