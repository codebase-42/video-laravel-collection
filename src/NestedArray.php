<?php

namespace App;

use DateTime;

final readonly class NestedArray
{
    public static function run(): void
    {
        echo PHP_EOL . __METHOD__ . PHP_EOL . '------------------------------' . PHP_EOL;

        $people = self::makeArray();

        usort($people, function ($a, $b) {
            return $a['name'] . $a['surname'] <=> $b['name'] . $b['surname'];
        });

        foreach ($people as $person) {
            echo $person['name'] . ' ' . $person['surname']
                . ' - ' . $person['birthday']->format('d/m/Y')
                . PHP_EOL;
        }

        $older = array_reduce($people, function ($carry, $person) {
            return is_null($carry) || $person['birthday'] < $carry['birthday']
                ? $person
                : $carry;
        });

        echo PHP_EOL . 'Older person is: ' . $older['name'] . ' ' . $older['surname']
            . ' - ' . $older['birthday']->format('d/m/Y')
            . PHP_EOL;
    }

    public static function runCollections(): void
    {
        echo PHP_EOL . __METHOD__ . PHP_EOL . '------------------------------' . PHP_EOL;

        $people = collect(self::makeArray())
            ->sort(function ($a, $b) {
                return $a['name'] . $a['surname'] <=> $b['name'] . $b['surname'];
            })
            ->each(function ($person) {
                echo $person['name'] . ' ' . $person['surname']
                    . ' - ' . $person['birthday']->format('d/m/Y')
                    . PHP_EOL;
            });

        $older = $people->reduce(function ($carry, $person) {
            return is_null($carry) || $person['birthday'] < $carry['birthday']
                ? $person
                : $carry;
        });

        echo PHP_EOL . 'Older person is: ' . $older['name'] . ' ' . $older['surname']
            . ' - ' . $older['birthday']->format('d/m/Y')
            . PHP_EOL;
    }

    public static function makeArray(): array
    {
        return [
            [
                'name' => 'João',
                'surname' => 'Silva',
                'birthday' => self::makeDate('03/08/1980'),
            ], // 0
            [
                'name' => 'Paulo',
                'surname' => 'Souza',
                'birthday' => self::makeDate('21/10/1992'),
            ], // 1
            [
                'name' => 'André',
                'surname' => 'Oliveira',
                'birthday' => self::makeDate('17/02/1999'),
            ], // 2
            [
                'name' => 'André',
                'surname' => 'Braga',
                'birthday' => self::makeDate('09/04/1989'),
            ], // 3
        ];
    }

    public static function makeDate(string $date): DateTime
    {
        return DateTime::createFromFormat('d/m/Y', $date);
    }
}
