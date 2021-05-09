<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Http\Requests\CreateTask;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed('FoldersTableSeeder');
    }

    /**
     * @test
     */
    public function due_date_should_be_date()
    {
        $response = $this->post('folders/1/task', [
            'title' => 'SampleTask',
            'due_date' => 123,
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には日付を入力してください。'
        ]);
    }

    /**
     * @test
     */
    public function due_date_should_not_be_past()
    {
        $response = $this->post('folders/1/task', [
            'title' => 'SampleTask',
            'due_date' => Carbon::yesterday()->format('Y/m/d'),
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力してください。',
        ]);
    }

    /**
     * @test
     */
    public function folder_title_should_not_empty()
    {
        $response = $this->post('/folders', [
            'title' => '',
        ]);

        $response->assertSessionHasErrors([
            'title' => 'フォルダ名 は必須入力です。',
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
