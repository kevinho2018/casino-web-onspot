<?php

namespace Tests;

use Artisan;
use DB;
use Hash;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class TestCase
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    protected $faker;

    /**
     * Set up the test
     */
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }


    /**
     * Reset the migrations
     */
    public function tearDown()
    {
        parent::tearDown();
    }

}
