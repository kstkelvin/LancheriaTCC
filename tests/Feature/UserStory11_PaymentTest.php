<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory11_PaymentTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */

  //POST: Pagamento-----------------------------------------------------------//

  public function test_administrador_pode_gerar_nota_eletrônica()
  {
    $user = factory(User::class)->create();
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $client = factory(Client::class)->create();
    $item = factory(Item::class)->create([
      'client_id' => $client->id,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/cliente/'.$client->id.'/pagamento', array(
      'id' => $client->id,
    ));
    $response->assertSee('O pagamento foi realizado com sucesso.');
  }

  public function test_usuário_autorizado_não_pode_gerar_nota_eletrônica()
  {
    $user = factory(User::class)->create([
      'is_admin' => 0,
    ]);
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $client = factory(Client::class)->create();
    $item = factory(Item::class)->create([
      'client_id' => $client->id,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->actingAs($user, 'web')
    ->withSession(['foo' => 'bar'])
    ->call('POST', '/cliente/'.$client->id.'/pagamento');
    $response->assertStatus(302);
    $response->assertRedirect('/home');
  }

  public function test_usuário_não_autorizado_não_pode_gerar_nota_eletrônica()
  {
    $product = factory(Product::class)->create([
      'stock' => 1,
    ]);
    $client = factory(Client::class)->create();
    $item = factory(Item::class)->create([
      'client_id' => $client->id,
      'product_id' => $product->id,
      'amount' => 1,
    ]);
    $response = $this->call('POST', '/cliente/'.$client->id.'/pagamento');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
  }


}
