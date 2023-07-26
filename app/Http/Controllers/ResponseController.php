<?php

namespace App\Http\Controllers;

use App\Models\UserResponse;
use App\Models\Question;
use App\Models\Choice;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function showQuestionnaire()
    {
        $questions = Question::with('choices')->get();
        return view('response.questionnaire', compact('questions'));
    }

    public function submitQuestionnaire(Request $request)
    {
        // Validate the user's responses
        $request->validate([
            'responses' => 'required|array',
        ]);

        // Process the quiz responses and calculate the score
        $totalScore = 0;
        foreach ($request->input('responses') as $questionId => $choiceId) {
            $choice = Choice::find($choiceId);
            if ($choice) {
                $totalScore += $choice->score;

                // Save the user response to the database
                UserResponse::create([
                    'session_id' => Session::getId(),
                    'question_id' => $questionId,
                    'choice_id' => $choiceId,
                    'score' => $choice->score,
                ]);
            }
        }
        return redirect()->route('questionnaire.show');
    }
}
