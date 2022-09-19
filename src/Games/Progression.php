<?php

namespace BrainGames\Games\Progression;

const GAME_DESCRIPTION = 'What number is missing in the progression?';

function isRightAnswer($question, $answer): bool
{
    return (int) $answer === getRightAnswer($question);
}

function getRightAnswer($question): int
{
    $numbers = explode(' ', $question);

    $position = false;
    $increment = false;

    foreach ($numbers as $key => $number) {
        if ($number === '..' || (isset($numbers[$key + 1]) && $numbers[$key + 1] === '..')) {
            $position = $number === '..' ? $key : $key + 1;
            continue;
        }

        $increment = $increment ?: $numbers[$key + 1] - $number;
        if ($position !== false) {
            break;
        }
    }

    return $position === 0 ? $numbers[$position + 1] - $increment : $numbers[$position - 1] + $increment;
}

function getQuestion(): string
{
    $progressionLength = random_int(6, 10);
    $missingNumberPosition = random_int(1, $progressionLength);
    $incrementValue = random_int(2, 10);
    $startValue = random_int(1, 500);

    $result = [];
    $value = false;

    for ($i = 1; $i <= $progressionLength; $i++) {
        if (!$result) {
            $value = $startValue;
        }

        if ($i === $missingNumberPosition) {
            $result[] = '..';
            $value += $incrementValue;
            continue;
        }

        $result[] = $value;
        $value += $incrementValue;
    }

    return implode(' ', $result);
}

function getGameDescription(): string
{
    return GAME_DESCRIPTION;
}
