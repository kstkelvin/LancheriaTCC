<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Client;
use App\Product;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStory06_StatsTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */

    use RefreshDatabase;

    //------------------------ Testes: User Side Homepage -----------------------

    public function test_administradores_podem_ver_as_estatisticas()
    {
      $user = factory(User::class)->create();
      $response = $this->actingAs($user, 'web')
      ->withSession(['foo' => 'bar'])
      ->get('/stats');
      $response->assertStatus(200);
      $response->assertViewHas('chart1');
      $response->assertViewHas('chart2');
      $response->assertViewHas('chart3');
      $response->assertViewHas('chart4');
    }

    public function test_usuarios_autenticados_nao_podem_ver_as_estatisticas()
    {
      $user = factory(User::class)->create([
        'is_admin' => 0,
      ]);
      $response = $this->actingAs($user, 'web')
      ->withSession(['foo' => 'bar'])
      ->get('/stats');
      $response->assertStatus(302);
      $response->assertRedirect('/home');
    }

    public function test_usuarios_nao_autenticados_nao_podem_ver_as_estatisticas()
    {
      $response = $this->get('/stats');
      $response->assertStatus(302);
      $response->assertRedirect('/login');
    }



}
