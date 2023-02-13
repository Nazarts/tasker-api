<?php

namespace Database\Factories;

use App\Models\SpendIncomeRecord;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SpendIncomeRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpendIncomeRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rand_ints = [1, 2, 3];
        return [
            'record_time' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'task_name' => Str::random(10).'_task',
            'category_id' => array_rand($rand_ints) + 1,
            'sum' => random_int(1, 10000)
        ];
    }
}
