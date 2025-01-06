<?php

namespace Perfocard\Flog\Tests;

use Orchestra\Testbench\TestCase;
use Perfocard\Flog\Generator;
use PHPUnit\Framework\Attributes\Test;

class GeneratorTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Perfocard\Flog\FlogServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        //
    }

    #[Test]
    public function it_can_generate_a_single_log()
    {
        $log = Generator::generateOne();

        $this->assertNotEmpty($log);
        $this->assertIsString($log);
    }

    #[Test]
    public function it_can_generate_multiple_logs()
    {
        $logs = Generator::generate(5);

        $this->assertCount(5, $logs);
        foreach ($logs as $log) {
            $this->assertIsString($log);
            $this->assertNotEmpty($log);
        }
    }
}
