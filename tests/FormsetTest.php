<?php

namespace khyrie\Formset\Tests;

use khyrie\Formset\Facades\Formset;
use khyrie\Formset\ServiceProvider;
use Orchestra\Testbench\TestCase;

class FormsetTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'formset' => Formset::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
