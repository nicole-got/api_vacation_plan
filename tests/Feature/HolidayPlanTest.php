<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\HolidayPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidayPlanTest extends TestCase
{
    private $idHolidayPlanTest;

    public function test_get_all_holiday_plan()
    {
        $response = $this->get('/api/holiday-plan');

        $response->assertStatus(200);
    }

    public function test_post_holiday_plan()
    {
        $response = $this->post('/api/holiday-plan',[
            'title'         => 'title test',
            'description'   => 'description test',
            'date'          => '2024-01-01'
        ]);

        $response->assertStatus(200);
    }

    public function test_get_specific_holiday_plan()
    {
        $id = HolidayPlan::where('title','title test')->first()->id;
        $response = $this->get('/api/holiday-plan/'.$id);

        $response->assertStatus(200);
    }

    public function test_put_holiday_plan()
    {
        $id = HolidayPlan::where('title','title test')->first()->id;
        $response = $this->put('/api/holiday-plan/'.$id,[
            'title'         => 'title test 2',
            'description'   => 'description test 2',
            'date'          => '2024-01-02'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_holiday_plan()
    {
        $id = HolidayPlan::where('title','title test 2')->first()->id;
        $response = $this->delete('/api/holiday-plan/'.$id);

        $response->assertStatus(200);
    }
}
