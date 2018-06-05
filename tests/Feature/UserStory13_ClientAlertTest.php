<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory13_ClientAlertTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */

  //POST: Alerta de débitos para administrador----------------------------------

  public function test_usuário_autenticado_pode_visualizar_alertas_de_usuários_em_débito()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
      'has_account' => 1,
    ]);
    $client = factory(Client::class)->create([
      'user_id' => $user->id,
    ]);
    $product = factory(Product::class)->create();
    $item = factory(Item::class)->create([
      'client_id' => $client->id,
      'product_id' => $product->id,
      'created_at' => \Carbon\Carbon::now()->subMonth(),
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/home');
    $response->assertStatus(200);
    $response->assertSee('Você tem uma dívida de');
  }

  public function test_administrador_não_pode_visualizar_alertas_de_usuários_em_débito()
  {
    $user = factory(User::class)->create();
    $client = factory(Client::class)->create();
    $product = factory(Product::class)->create();
    $item = factory(Item::class)->create([
      'client_id' => $client->id,
      'product_id' => $product->id,
      'created_at' => \Carbon\Carbon::now()->subMonth(),
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->get('/home');
    $response->assertStatus(302);
    $response->assertRedirect('/');
  }

  public function test_usuário_não_autenticado_não_pode_visualizar_alertas_de_usuários_em_débito()
  {
    $client = factory(Client::class)->create();
    $product = factory(Product::class)->create();
    $item = factory(Item::class)->create([
      'client_id' => $client->id,
      'product_id' => $product->id,
      'created_at' => \Carbon\Carbon::now()->subMonth(),
    ]);
    $response = $this->get('/');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }

}
