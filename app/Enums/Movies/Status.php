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

    public static function valueOf( $status ) : int
    {
        $status = strtoupper( $status );

        return match ($status) {
            Status::DRAFT->name => Status::DRAFT->value,
            Status::PUBLISHED->name => Status::PUBLISHED->value,
            Status::BANNED->name => Status::BANNED->value,
            default => throw new \Exception( 'some error with status' ),
        };
    }
}
