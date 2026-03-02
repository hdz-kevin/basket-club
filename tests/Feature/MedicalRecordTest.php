<?php

namespace Tests\Feature;

use App\Models\MedicalRecord;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicalRecordTest extends TestCase
{
    use RefreshDatabase;

    protected string $version;

    public function setUp(): void
    {
        parent::setUp();
        $this->version = env('APP_VER');
    }

    /**
     * Test MedicalRecordController index return status code 200 and all records
     */
    public function test_index_return_all_medical_records(): void
    {
        // Using sequence or separate players if needed, but one player for all is fine
        $player = Player::factory()->create();
        $medicalRecords = MedicalRecord::factory()->count(3)->create(['player_id' => $player->id]);

        $response = $this->get("/{$this->version}/medicalrecords");
        
        $response->assertStatus(200)
                 ->assertJson($medicalRecords->toArray());
    }

    /**
     * Test MedicalRecordController show return medical record by id
     */
    public function test_show_return_medical_record_by_id(): void
    {
        $player = Player::factory()->create();
        $medicalRecord = MedicalRecord::factory()->create(['player_id' => $player->id]);

        $response = $this->get("/{$this->version}/medicalrecords/{$medicalRecord->id}");
        
        $response->assertStatus(200)
                 ->assertJson($medicalRecord->toArray());
    }

    /**
     * Test MedicalRecordController show return 404 if not found
     */
    public function test_show_return_404_if_not_found(): void
    {
        $response = $this->get("/{$this->version}/medicalrecords/999");
        
        $response->assertStatus(404)
                 ->assertJson(['message' => 'Medical record not found']);
    }

    /**
     * Test MedicalRecordController showPlayer return player by medical record id
     */
    public function test_showPlayer_return_player(): void
    {
        $player = Player::factory()->create();
        $medicalRecord = MedicalRecord::factory()->create(['player_id' => $player->id]);

        $response = $this->get("/{$this->version}/medicalrecords/{$medicalRecord->id}/player");
        
        $response->assertStatus(200)
                 ->assertJson($player->toArray());
    }

    /**
     * Test MedicalRecordController showPlayer return 404 if medical record not found
     */
    public function test_showPlayer_return_404_if_not_found(): void
    {
        $response = $this->get("/{$this->version}/medicalrecords/999/player");
        
        $response->assertStatus(404)
                 ->assertJson(['message' => 'Medical record not found']);
    }
}
