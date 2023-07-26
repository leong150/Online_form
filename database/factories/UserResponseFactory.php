<?php

namespace Database\Factories;

use App\Models\UserResponse;
use App\Models\User;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserResponse>
 */
class UserResponseFactory extends Factory
{
    protected $model = UserResponse::class;

    public function definition()
    {
        // Generate a random question ID
        $questionIds = Question::pluck('id')->toArray();
        $questionId = $this->faker->randomElement($questionIds);

        // Get the choices for the selected question
        $question = Question::findOrFail($questionId);
        $choices = $question->choices;

        // Generate a random choice ID and corresponding score
        $choice = $this->faker->randomElement($choices);
        $choiceId = $choice->id;
        $score = $choice->score;

        return [
            'session_id' => $this->faker->unique()->uuid,
            'question_id' => $questionId,
            'choice_id' => $choiceId,
            'score' => $score,
        ];
    }
}
