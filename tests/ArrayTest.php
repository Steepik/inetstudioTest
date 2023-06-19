<?php

namespace Steepik\Tests;

use PHPUnit\Framework\TestCase;

final class ArrayTest extends TestCase
{
    private array $array;

    public function setUp(): void
    {
        $this->array = [
            ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
            ['id' => 2, 'date' => "12.02.2020", 'name' => "test2"],
            ['id' => 4, 'date' => "12.03.2020", 'name' => "test4"],
            ['id' => 1, 'date' => "12.04.2020", 'name' => "test1"],
            ['id' => 2, 'date' => "12.05.2020", 'name' => "test4"],
            ['id' => 3, 'date' => "12.06.2020", 'name' => "test3"],
        ];
    }

    /**
     * Выделить уникальные записи (убрать дубли) в отдельный массив. в конечном массиве не должно быть элементов с одинаковым id.
     */
    public function testItArrayHasUniqueIds(): void
    {
        $uniques = [];
        $arrayUniques = array_filter(array: $this->array, callback: function ($item) use (&$uniques) {
            if (!in_array($item['id'], $uniques)) {
                $uniques[] = $item['id'];
                return $item;
            }
        });

        $this->assertEquals(
            expected: [
                ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
                ['id' => 2, 'date' => "12.02.2020", 'name' => "test2"],
                ['id' => 4, 'date' => "12.03.2020", 'name' => "test4"],
                ['id' => 3, 'date' => "12.06.2020", 'name' => "test3"],
            ],
            actual: array_values($arrayUniques)
        );
    }

    /**
     * Отсортировать многомерный массив по ключу (любому)
     */
    public function testItSortArrayByKey(): void
    {
        uasort(array: $this->array, callback: fn ($a, $b) => $a['name'] <=> $b['name']);

        $this->assertEquals(
            expected: [
                ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
                ['id' => 1, 'date' => "12.04.2020", 'name' => "test1"],
                ['id' => 2, 'date' => "12.02.2020", 'name' => "test2"],
                ['id' => 3, 'date' => "12.06.2020", 'name' => "test3"],
                ['id' => 4, 'date' => "12.03.2020", 'name' => "test4"],
                ['id' => 2, 'date' => "12.05.2020", 'name' => "test4"],
            ],
            actual: array_values($this->array)
        );
    }

    /**
     * Вернуть из массива только элементы, удовлетворяющие внешним условиям (например элементы с определенным id)
     */
    public function testItFilteringArrayById(): void
    {
        $filteredArray = array_filter(array: $this->array, callback: function ($item) {
            return $item['id'] === 2;
        });

        $this->assertEquals(
            expected: [
                ['id' => 2, 'date' => "12.02.2020", 'name' => "test2"],
                ['id' => 2, 'date' => "12.05.2020", 'name' => "test4"],
            ],
            actual: array_values($filteredArray)
        );
    }

    /**
     * Изменить в массиве значения и ключи (использовать name => id в качестве пары ключ => значение)
     */
    public function testItSwapKeyValue(): void
    {
        $flippedArray = array_combine(keys: array_column($this->array, 'name'), values: array_column($this->array, 'id'));

        $this->assertEquals(
            expected: [
                'test1' => 1,
                'test2' => 2,
                'test4' => 2,
                'test3' => 3,
            ],
            actual: $flippedArray
        );
    }
}