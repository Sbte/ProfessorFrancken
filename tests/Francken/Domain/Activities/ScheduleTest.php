<?php

declare(strict_types=1);

namespace Tests\Francken\Activities;

use DateTimeImmutable;
use Francken\Domain\Activities\Schedule;
use InvalidArgumentException;

class ScheduleTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function a_schedule_has_a_start_time() : void
    {
        $startTime = new DateTimeImmutable('2015-03-10');
        $schedule = Schedule::withStartTime($startTime);

        $this->assertInstanceOf(Schedule::class, $schedule);
        $this->assertEquals($startTime, $schedule->startTime());
        $this->assertNull($schedule->endTime());
    }

    /** @test */
    public function a_schedule_can_have_an_end_date() : void
    {
        $startTime = new DateTimeImmutable('2015-03-10 10:00');
        $endTime = new DateTimeImmutable('2015-03-10 11:00');
        $schedule = Schedule::forPeriod($startTime, $endTime);

        $this->assertInstanceOf(Schedule::class, $schedule);
        $this->assertEquals($startTime, $schedule->startTime());
        $this->assertEquals($endTime, $schedule->endTime());
    }

    /**
     * @test
     */
    public function the_end_time_is_after_the_start_time() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $startTime = new DateTimeImmutable('2015-03-10 10:00');
        $endTime = new DateTimeImmutable('2015-03-10 9:00');
        $schedule = Schedule::forPeriod($startTime, $endTime);
    }

    /**
     * @test
     */
    public function the_end_time_and_the_start_time_cant_be_identical() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $time = new DateTimeImmutable('2015-03-10 10:00');
        $schedule = Schedule::forPeriod($time, $time);
    }
}
