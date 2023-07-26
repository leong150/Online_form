<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Choice;
use App\Models\Question;

class ChoiceFactory extends Factory
{
    protected $model = Choice::class;

    public function definition()
    {
        return [
            'question_id' => $this->factoryForModel(Question::class), // Use the factory method for the related model
            'choice' => $this->faker->word(),
            'score' => $this->faker->randomNumber(2), 
        ];
    }
}