<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_beranda_to_login(): void
    {
        $response = $this->get('/beranda');

        $response->assertRedirect('/login');
    }

    public function test_user_can_login_and_access_beranda(): void
    {
        $user = User::factory()->create([
            'name' => 'Amanda Eka',
            'email' => 'amanda@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->withSession(['_token' => 'test-token'])
            ->from('/login')
            ->post('/login', [
                '_token' => 'test-token',
                'email' => $user->email,
                'password' => 'password',
            ]);

        $response->assertRedirect('/beranda');
        $this->assertAuthenticatedAs($user);
    }

    public function test_api_anggota_returns_json_data(): void
    {
        Anggota::create([
            'nama' => 'Amanda Eka',
            'status' => 'paid',
        ]);

        $this->getJson('/api/anggota')
            ->assertOk()
            ->assertJsonPath('data.0.nama', 'Amanda Eka')
            ->assertJsonPath('data.0.status', 'paid');
    }

    public function test_api_transaksi_returns_json_data(): void
    {
        Transaction::create([
            'description' => 'Iuran mingguan',
            'category' => 'Iuran anggota',
            'type' => 'in',
            'amount' => 90000,
            'transaction_date' => '2026-09-25',
        ]);

        $this->getJson('/api/transaksi')
            ->assertOk()
            ->assertJsonPath('transactions.0.desc', 'Iuran mingguan')
            ->assertJsonPath('transactions.0.cat', 'Iuran anggota');
    }

    public function test_api_anggota_can_update_and_delete_member(): void
    {
        $createResponse = $this->postJson('/api/anggota', [
            'nama' => 'Beni',
            'status' => 'unpaid',
        ])->assertCreated()
            ->assertJsonPath('data.nama', 'Beni')
            ->assertJsonPath('data.status', 'unpaid');

        $memberId = $createResponse->json('data.id');

        $this->putJson('/api/anggota/' . $memberId, [
            'nama' => 'Beni Setiawan',
            'status' => 'paid',
        ])->assertOk()
            ->assertJsonFragment(['nama' => 'Beni Setiawan'])
            ->assertJsonFragment(['status' => 'paid']);

        $this->deleteJson('/api/anggota/' . $memberId)
            ->assertOk();

        $this->assertDatabaseMissing('anggotas', ['id' => $memberId]);
    }

    public function test_home_redirects_to_beranda(): void
    {
        $user = User::factory()->create([
            'email' => 'home@kasify.test',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user)
            ->get('/home')
            ->assertRedirect('/beranda');
    }

    public function test_riwayat_and_transaksi_keep_all_page_navigation_links(): void
    {
        $user = User::factory()->create();

        foreach (['riwayat', 'transaksi'] as $page) {
            $response = $this->actingAs($user)->get(route($page));

            $response->assertOk()
                ->assertSee('href="' . route('anggota') . '"', false)
                ->assertSee('href="' . route('laporan') . '"', false);
        }
    }
}
