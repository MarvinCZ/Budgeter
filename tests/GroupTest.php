<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $group = new \App\Models\Group();
        $this->assertFalse($group->save());

        $group = $this->getValidGroup();
        $this->assertTrue($group->save());
    }
}
