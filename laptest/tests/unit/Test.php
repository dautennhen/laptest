<?php

namespace Tests\Unit;

use TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Foundation\Testing\DatabaseTransactions;

class Test extends TestCase {

    private $repository;
    private $faker;

    public function __construct() {
//        $user = new \App\Models\User;
//        $group = new \App\Models\Group;
//        $permission = new \App\Models\Permission;
//        $this->repository = new \App\Repositories\AclRepository($user, $group, $permission);
//        $this->faker = \Faker\Factory::create();
    }

    public function test_result() {
        $result = 1;
        $this->assertEquals($result, 2);
    }

}