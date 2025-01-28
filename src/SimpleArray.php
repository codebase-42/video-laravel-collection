<?php

namespace App;

use Illuminate\Support\Collection;

final readonly class SimpleArray
{
    public static function run(): void
    {
        echo PHP_EOL . __METHOD__ . PHP_EOL . '------------------------------' . PHP_EOL;

        $names = self::makeArray();

        $names[] = 'mateus';
        $names[] = 'maria';

        sort($names);

        $names = array_map(fn ($name) => ucfirst($name), $names);

        foreach ($names as $name) {
            echo $name . PHP_EOL;
        }
    }

    public static function runCollections(): void
    {
        echo PHP_EOL . __METHOD__ . PHP_EOL . '------------------------------' . PHP_EOL;

        collect(self::makeArray())
            ->push('mateus', 'maria')
            ->sort()
            ->map(fn ($name) => ucfirst($name))
            ->each(function ($name) {
                echo $name . PHP_EOL;
            });
    }

    public static function makeArray(): array
    {
        return [
            'joão', // 0
            'paulo', // 1
            'andré', // 2
        ];
    }
}
