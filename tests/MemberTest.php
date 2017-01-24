<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MemberTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test member object creation
     */
    public function testCreate()
    {
        $member = new \App\Models\Member();
        $this->assertFalse($member->save());

        $member = $this->getValidMember();
        $this->assertTrue($member->save());
    }

    /**
     * Test validators on name attribute
     */
    public function testNameValidators()
    {
        $member = $this->getValidMember();
        $member->name = '';
        $this->assertFalse($member->save());

        $member->name = str_random(51);
        $this->assertFalse($member->save());

        $member->name = str_random(50);
        $this->assertTrue($member->save());
    }

    /**
     * Test if cachedBudget attribute is not directly writable
     * @expectedException App\Exceptions\ReadOnlyAttributeException
     */
    public function testCachedBudgetReadOnly()
    {
        $member = factory(App\Models\Member::class)->make();
        $member->cachedBudget = 420;
    }

    /**
     * Test member-group relation
     */
    public function testMemberGroupRelation()
    {
        $member = factory(\App\Models\Member::class)->make();
        $group = $this->getValidGroup();
        $this->assertEquals(0, $member->group()->count());

        $member->group()->associate($group);
        $this->assertEquals(1, $member->group()->count());
        $this->assertTrue($member->group->is($group));
    }

    /**
     * Test member-user relation
     */
    public function testMemberUserRelation()
    {
        $member = $this->getValidMember();
        $user = factory(\App\Models\User::class)->create();
        $this->assertEquals(0, $member->user()->count());

        $member->user()->associate($user);
        $this->assertEquals(1, $member->user()->count());
        $this->assertTrue($member->user->is($user));
    }
}
