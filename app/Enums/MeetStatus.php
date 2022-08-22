<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MeetStatus extends Enum
{
    const DONE = "Done";
    const CANCLED = "Cancled";
    const REPORTED = 'Reported';
}