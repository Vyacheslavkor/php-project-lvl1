<?php

namespace BrainGames\Games\Prime;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';
const ANSWER_YES = 'yes';
const ANSWER_NO = 'no';

function isRightAnswer(string $question, string $answer): bool
{
    return $answer === getRightAnswer($question);
}

function getRightAnswer(string $question): string
{
    return isPrime((int) $question)
        ? ANSWER_YES
        : ANSWER_NO;
}

function isPrime(int $question): bool
{
    if ($question === 1) {
        return false;
    }

    if (in_array($question, [2, 3], true)) {
        return true;
    }

    return checkDividers($question);
}

function checkDividers(int $question): bool
{
    $result = true;
    $dividers = range(3, $question - 1);

    foreach ($dividers as $divider) {
        if ($question % $divider !== 0) {
            continue;
        }

        $result = false;
        break;
    }

    return $result;
}

function getQuestion(): string
{
    return random_int(1, 500);
}

function getGameDescription(): string
{
    return GAME_DESCRIPTION;
}
