<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test group object creation
     */
    public function testCreate()
    {
        $group = new \App\Models\Group();
        $this->assertFalse($group->save());

        $group = $this->getValidGroup();
        $this->assertTrue($group->save());
    }

    /**
     * Test validators on name attribute
     */
    public function testNameValidators()
    {
        $group = $this->getValidGroup();
        $group->name = '';
        $this->assertFalse($group->save());

        $group->name = str_random(51);
        $this->assertFalse($group->save());

        $group->name = str_random(50);
        $this->assertTrue($group->save());
    }

    /**
     * Test validators on cachedBudget attribute
     */
    public function testCachedBudgetValidators()
    {
        $group = $this->getValidGroup();
        $group->cachedBudget = '';
        $this->assertFalse($group->save());

        $group->cachedBudget = 'aaaa';
        $this->assertFalse($group->save());

        $group->cachedBudget = 1000;
        $this->assertTrue($group->save());
    }

    /**
     * Test group-user relation
     */
    public function testGroupUserRelation()
    {
        $group = factory(\App\Models\Group::class)->make();
        $user = factory(\App\Models\User::class)->create();
        $this->assertEquals(0, $group->user()->count());

        $group->user()->associate($user);
        $this->assertEquals(1, $group->user()->count());
        $this->assertEquals($user, $group->user);
    }
}
