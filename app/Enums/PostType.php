<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PostType extends Enum
{
    public const BY_FAVORITE_GAME = 0;
    public const BY_FOLLOWING_USER = 1;
    public const BY_MY_POST = 2;
}
