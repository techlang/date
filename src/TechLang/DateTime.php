<?php
namespace TechLang;

/**
 * Class DateTime
 *
 * @package TechLang
 * @author Ionut DINU <idinu@techlang.ro>
 * @version GIT: $Id:$
 */
class DateTime extends \DateTime
{
    /** @var integer */
    protected $realDay;

    /**
     * Method __construct
     *
     * @param string $time
     * @param \DateTimeZone $timezone
     *
     * @throws \Exception
     * @return DateTime
     * @link http://php.net/manual/en/datetime.construct.php
     */
    public function __construct($time = 'now', $timezone = null)
    {
        if (!is_null($timezone) && !$timezone instanceof \DateTimeZone) {
            throw new \Exception('DateTime::__construct() expects parameter 2 to be DateTimeZone, ' . gettype($timezone) . ' given');
        }

        parent::__construct($time, $timezone);
        $this->realDay = $this->format('j');
    }

    /**
     * Parse a string into a new DateTime object according to the specified format
     *
     * @param string $format Format accepted by date().
     * @param string $time String representing the time.
     * @param \DateTimeZone $timezone A DateTimeZone object representing the desired time zone.
     *
     * @throws \Exception
     * @return DateTime
     * @link http://php.net/manual/en/datetime.createfromformat.php
     */
    public static function createFromFormat($format, $time, $timezone = null)
    {
        if (is_null($timezone)) {
            $object = parent::createFromFormat($format, $time);
        }
        else {
            if (!$timezone instanceof \DateTimeZone) {
                $errorMessage = "DateTime::createFromFormat() expects parameter 3 to be DateTimeZone, " . gettype($timezone) . " given";
                trigger_error($errorMessage, E_USER_WARNING);
                return false;
            }
            $object = parent::createFromFormat($format, $time, $timezone);
        }

        return new self($object->format('Y-m-d H:i:s'), $timezone);
    }

    /**
     * Adds an amount of days, months, years, hours, minutes and seconds to a DateTime object
     *
     * @param \DateInterval $interval
     * @return DateTime
     * @link http://php.net/manual/en/datetime.add.php
     */
    public function add($interval)
    {
        if (!$interval instanceof \DateInterval) {
            $errorMessage = "DateTime::add() expects parameter 1 to be DateInterval, " . gettype($interval) . " given";
            trigger_error($errorMessage, E_USER_WARNING);
            return false;
        }

        if (0 == $interval->m) {
            // shortcut if we don't have months to add (these are the tricky ones)
            return parent::add($interval);
        }
        else {
            // add the years
            if (0 != $interval->y) {
                $yearInterval = new \DateInterval('P'.$interval->y.'Y');
                parent::add($yearInterval);
            }

            // now comes the tricky part
            $monthInterval = new \DateInterval('P'.$interval->m.'M');
            $this->modify('first day of this month');
            parent::add($monthInterval);
            $lastDayOfTheMonth = $this->format('t');
            $payDay = min($this->realDay, $lastDayOfTheMonth);
            $this->modify("" . ($payDay - 1) . " days");

            // and now the rest of the interval (if any)
            $rest = 'P';
            if (0 != $interval->d) {
                $rest .= $interval->d . 'D';
            }
            $rest .= 'T';
            if (0 != $interval->h) {
                $rest .= $interval->h . 'H';
            }
            if (0 != $interval->i) {
                $rest .= $interval->i . 'M';
            }
            if (0 != $interval->s) {
                $rest .= $interval->s . 'S';
            }

            $rest = trim($rest, 'T');
            if ('P' != $rest) {
                $restInterval = new \DateInterval($rest);
                parent::add($restInterval);

                // since we added days or time to our DateTime object the initial day is no longer relevant
                $this->forgetReferenceDay();
            }
        }

        return $this;
    }

    /**
     * Cause it to reset the reference day.
     * This object no longer remembers the initial date from construction.
     *
     * @return $this
     */
    public function forgetReferenceDay()
    {
        $this->realDay = $this->format('j');
        return $this;
    }
}
