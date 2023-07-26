@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/dashboard" class="btn btn-outline-primary btn-sm">Go back</a>
                <h1 class="display-one">Breakdown</h1>
                <p>Session ID: {{ $session_id }}</p>
                <table>
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Choice</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($responses as $response)
                        <tr>
                            <td>{{ $response->question->question_text }}</td>
                            <td>{{ $response->choice->choice_text }}</td>
                            <td>{{ $response->score }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection