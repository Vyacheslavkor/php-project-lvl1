<?php

use function cli\line;
use function cli\prompt;

const MAX_ROUNDS = 3;

function run(string $gameName)
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);

    line(getGameDescription($gameName));

    for ($round = 1; $round <= MAX_ROUNDS; $round++) {
        $question = getQuestion($gameName);
        $answer = prompt("Question: {$question}", false, ' ');
        line("Your answer: %s", $answer);
        if (!isRightAnswer($gameName, $question, $answer)) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, getRightAnswer($gameName, $question));
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

function getRightAnswer($gameName, $question): string
{
    return call_user_func("\\BrainGames\\Games\\{$gameName}\\getRightAnswer", $question);
}

function isRightAnswer($gameName, $question, $answer): bool
{
    return call_user_func("\\BrainGames\\Games\\{$gameName}\\isRightAnswer", $question, $answer);
}

function getGameDescription($gameName): string
{
    return call_user_func("\\BrainGames\\Games\\{$gameName}\\getGameDescription");
}
