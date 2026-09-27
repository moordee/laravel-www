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
        $member = Anggota::create([
            'nama' => 'Beni',
            'status' => 'unpaid',
        ]);

        $this->putJson('/api/anggota/' . $member->id, [
            'nama' => 'Beni Setiawan',
            'status' => 'paid',
        ])->assertOk()
            ->assertJsonFragment(['nama' => 'Beni Setiawan'])
            ->assertJsonFragment(['status' => 'paid']);

        $this->deleteJson('/api/anggota/' . $member->id)
            ->assertOk();

        $this->assertDatabaseMissing('anggotas', ['id' => $member->id]);
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
}
