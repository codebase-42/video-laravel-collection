<?php

namespace App;

final readonly class AssocArray
{
    public static function run(): void
    {
        echo PHP_EOL . __METHOD__ . PHP_EOL . '------------------------------' . PHP_EOL;

        $person = self::makeArray();

        $person['email'] = 'joao.silva@test.com';

        foreach ($person as $key => $value) {
            echo ucfirst($key) . ': ' . $value . PHP_EOL;
        }
    }

    public static function runCollections(): void
    {
        echo PHP_EOL . __METHOD__ . PHP_EOL . '------------------------------' . PHP_EOL;

        collect(self::makeArray())
            ->put('email', 'joao.silva@test.com')
            ->each(function ($value, $key) {
                echo ucfirst($key) . ': ' . $value . PHP_EOL;
            });
    }

    public static function makeArray(): array
    {
        return [
            'name' => 'João',
            'surname' => 'Silva',
            'birthday' => '03/08/2021',
        ];
    }
}
