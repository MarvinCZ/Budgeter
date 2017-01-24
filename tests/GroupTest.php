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
        $this->assertTrue($group->user->is($user));
    }

    /**
     * Test group-member relation
     */
    public function testGroupMemberRelation()
    {
        $group = $this->getValidGroup();
        $member1 = factory(\App\Models\Member::class)->make();
        $member2 = factory(\App\Models\Member::class)->make();
        $this->assertEquals(0, $group->members()->count());

        $group->members()->saveMany([$member1, $member2]);
        $this->assertEquals(2, $group->members()->count());
        $this->assertTrue($group->members->first()->is($member1));
    }

    /**
     * Test group-transaction relation
     */
    public function testGroupTransactionRelation()
    {
        $group = $this->getValidGroup();
        $transaction1 = factory(\App\Models\Transaction::class)->make();
        $transaction2 = factory(\App\Models\Transaction::class)->make();
        $this->assertEquals(0, $group->transactions()->count());

        $group->transactions()->saveMany([$transaction1, $transaction2]);
        $this->assertEquals(2, $group->transactions()->count());
        $this->assertTrue($group->transactions->first()->is($transaction1));
    }
}
