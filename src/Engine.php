<?php

use function cli\line;
use function cli\prompt;

const MAX_ROUNDS = 3;

function run(string $gameName)
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);

    line('Answer "yes" if the number is even, otherwise answer "no".');

    for ($round = 1; $round <= MAX_ROUNDS; $round++) {
        $num = getQuestion($gameName);
        $answer = prompt("Question: {$num}", false, ' ', true);
        line("Your answer: %s", $answer);
        if (!isRightAnswer($gameName, $num, $answer)) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, getRightAnswer($gameName, $num));
            line('Let\'s try again, %s!', $userName);
            exit();
        }

        line('Correct!');
    }

    line("Congratulations, %s!", $userName);
}

function getQuestion(string $gameName): string
{
    return call_user_func("\\BrainGames\\Games\\{$gameName}\\getQuestion");
}

function getRightAnswer(string $gameName, int $num): string
{
    return call_user_func("\\BrainGames\\Games\\{$gameName}\\getRightAnswer", $num);
}

function isRightAnswer(string $gameName, int $num, string $answer): bool
{
    return call_user_func("\\BrainGames\\Games\\{$gameName}\\isRightAnswer", $num, $answer);
}
