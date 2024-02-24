<?php

namespace App\Enums\Movies;

enum Status : int
{
    case DRAFT = 0;
    case PUBLISHED = 5;
    case BANNED = 10;

    public function text()
    {
        return match( $this )
        {
            self::DRAFT => 'Черновик',
            self::PUBLISHED => 'Опубликовано',
            self::BANNED => 'Забанен',
        };

    }
}
