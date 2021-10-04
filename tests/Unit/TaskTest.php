<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_belongs_to_a_project()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }

    /** @test */
    public function it_has_a_patch()
    {
        $task = Task::factory()->create();

        $this->assertEquals('/tasks/' . $task->id, $task->path());
    }

    /** @test */
    function it_can_be_completed()
    {
        $task = Task::factory()->create();

        $this->assertFalse($task->completed);

        $task->complete();

        $this->assertTrue($task->fresh()->completed);
    }

    /** @test */
    function it_can_market_as_incompleted()
    {
        $task = Task::factory()->create(['completed' => true]);

        $task->incomplete();

        $this->assertFalse($task->fresh()->completed);
    }
}
