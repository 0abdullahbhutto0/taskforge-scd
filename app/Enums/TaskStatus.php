<?php

namespace App\Enums;

enum TaskStatus: string
{
    case TODO = 'todo';
    case IN_PROGRESS = 'in_progress';
    case REVIEW = 'review';
    case COMPLETED = 'completed';
    case BLOCKED = 'blocked';

    public function label(): string
    {
        return match($this) {
            self::TODO => 'To Do',
            self::IN_PROGRESS => 'In Progress',
            self::REVIEW => 'Review',
            self::COMPLETED => 'Completed',
            self::BLOCKED => 'Blocked',
        };
    }
}
