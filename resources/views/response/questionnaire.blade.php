@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="row">
                <h1>Please answer all the questions:</h1>

                <form action="{{ route('questionnaire.submit') }}" method="post">
                    @csrf
                    <ol>
                        @foreach ($questions as $question)
                            <li><h2>{{ $question->question }}</h2></li>
                                <ul>
                                    @foreach ($question->choices as $choice)
                                        <li>
                                            <label>
                                                <input type="radio" name="responses[{{ $question->id }}]" value="{{ $choice->id }}">
                                                {{ $choice->choice }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                        @endforeach
                    </ol>
                    <br>
                    <button type="submit">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
