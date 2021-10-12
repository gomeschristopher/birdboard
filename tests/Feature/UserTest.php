<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_has_projects()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    function a_user_has_accessible_projects()
    {
        $jonh = $this->signIn();

        ProjectFactory::ownedBy($jonh)->create();

        $this->assertCount(1, $jonh->accessibleProjects());

        $sally = User::factory()->create();

        $nick = User::factory()->create();

        $project = tap(ProjectFactory::ownedBy($sally)->create())->invite($nick);

        $this->assertCount(1, $jonh->accessibleProjects());

        $project->invite($jonh);

        $this->assertCount(2, $jonh->accessibleProjects());
    }
}
