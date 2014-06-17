<?php
namespace Unit;

use TechLang\DateTime;

/**
 * Class DateTimeTest
 *
 * @category Unit
 * @package TechLang
 * @author Ionut DINU <idinu@techlang.ro>
 * @version GIT: $Id:$
 */
class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldAddOneMonth()
    {
        // Given
        $date = DateTime::createFromFormat('Y-m-d', '2000-01-31');

        // When
        $date->add(new \DateInterval('P1M'));

        // Then
        $this->assertEquals('2000-02-29', $date->format('Y-m-d'));
    }

    public function testShouldAddThreeMonths()
    {
        // Given
        $date = DateTime::createFromFormat('Y-m-d', '1998-11-30');

        // When
        $date->add(new \DateInterval('P3M'));

        // Then
        $this->assertEquals('1999-02-28', $date->format('Y-m-d'));
    }

    public function testShouldAddThreeTimesOneMonth()
    {
        // Given
        $date = DateTime::createFromFormat('Y-m-d', '1998-11-30');

        // When
        $date->add(new \DateInterval('P1M'));
        $date->add(new \DateInterval('P1M'));
        $date->add(new \DateInterval('P1M'));

        // Then
        $this->assertEquals('1999-02-28', $date->format('Y-m-d'));
    }

    public function testShouldAddFourTimesOneMonth()
    {
        // Given
        $date = DateTime::createFromFormat('Y-m-d', '1998-10-31');

        // When
        $date->add(new \DateInterval('P1M'));
        // Then
        $this->assertEquals('1998-11-30', $date->format('Y-m-d'));

        // When
        $date->add(new \DateInterval('P1M'));
        // Then
        $this->assertEquals('1998-12-31', $date->format('Y-m-d'));

        // When
        $date->add(new \DateInterval('P1M'));
        // Then
        $this->assertEquals('1999-01-31', $date->format('Y-m-d'));

        // When
        $date->add(new \DateInterval('P1M'));
        // Then
        $this->assertEquals('1999-02-28', $date->format('Y-m-d'));
    }

    public function testShouldAddCustomInterval_1()
    {
        // Given
        $date = DateTime::createFromFormat('Y-m-d H:i:s', '2000-01-31 12:01:02');

        // When
        $date->add(new \DateInterval('P1Y2M3DT1H2M3S'));

        // Then
        $this->assertEquals('2001-04-03 13:03:05', $date->format('Y-m-d H:i:s'));
    }

    public function testShouldAddCustomInterval_2()
    {
        // Given
        $date = DateTime::createFromFormat('Y-m-d H:i:s', '2000-01-15 00:00:00');

        // When
        $date->add(new \DateInterval('P2M1W'));

        // Then
        $this->assertEquals('2000-03-22 00:00:00', $date->format('Y-m-d H:i:s'));
    }

    public function testShouldAddCustomInterval_3()
    {
        // Given
        $date = DateTime::createFromFormat('Y-m-d H:i:s', '2000-01-30 00:00:00');

        // When
        $date->add(new \DateInterval('P1M1D'));

        // Then
        $this->assertEquals('2000-03-01 00:00:00', $date->format('Y-m-d H:i:s'));
    }

}
