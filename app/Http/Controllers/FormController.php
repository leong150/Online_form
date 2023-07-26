<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Question;
use App\Models\Choice;
use App\Models\UserResponse;
use Illuminate\Http\Request;


class FormController extends Controller
{
    public function dashboard()
    {
        $userResponses = UserResponse::with('user', 'question', 'choice')->get();
        return view('form.dashboard', compact('userResponses'));
    }
    
    public function breakdown($session_id)
    {
        // Fetch the user responses with the given session_id
        $responses = UserResponse::where('session_id', $session_id)->get();

        return view('form.breakdown', compact('responses', 'session_id'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('choices')->get();

        return view('form.index', compact('questions'));
    }

    /**
     * Show the Question for creating a new resource.
     */
    public function create()
    {
        return view('form.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'num_choices' => 'required|integer|min:2|max:10',
            'choices.*.choice' => 'required|string|max:255',
            'choices.*.score' => 'required|integer|min:0',
        ]);

        // Create the question
        $question = Question::create([
            'question' => $request->input('question'),
        ]);

        // Create the choices and associate them with the question
        foreach ($request->input('choices') as $choiceData) {
            Choice::create([
                'question_id' => $question->id,
                'choice' => $choiceData['choice'],
                'score' => $choiceData['score'],
            ]);
        }

        return redirect('form');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $question = Question::with('choices')->findOrFail($id);
        return view('form.show', compact('question'));
    }

    /**
     * Show the Question for editing the specified resource.
     */
    public function edit($id)
    {
        $question = Question::with('choices')->findOrFail($id);
        return view('form.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'num_choices' => 'required|integer|min:2|max:10',
            'choices.*.choice' => 'required|string|max:255',
            'choices.*.score' => 'required|integer|min:0',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'question' => $request->input('question'),
        ]);

        $choicesData = $request->input('choices');
        foreach ($choicesData as $index => $choiceData) {
            if ($index < count($question->choices)) {
                $choice = $question->choices[$index];
                $choice->update([
                    'choice' => $choiceData['choice'],
                    'score' => $choiceData['score'],
                ]);
            } else {
                Choice::create([
                    'question_id' => $question->id,
                    'choice' => $choiceData['choice'],
                    'score' => $choiceData['score'],
                ]);
            }
        }

        // Remove any excess choices
        if (count($question->choices) > count($choicesData)) {
            foreach ($question->choices->slice(count($choicesData)) as $choice) {
                $choice->delete();
            }
        }

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteQuestion(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->choices()->delete(); // Delete choices associated with the question
        $question->delete(); // Delete the question

        return redirect('/form');
    }

    public function deleteChoice(Request $request, $id)
    {
        $choice = Choice::findOrFail($id);
        $choice->delete(); // Delete the choice

        return redirect('/form');
    }

    public function showQuestionnaire()
    {
        $questions = Question::with('choices')->get();
        return view('form.questionnaire', compact('questions'));
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