@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">Form</h1>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    <div class="col-4">
                        <a href="/form/create/post" class="btn btn-primary btn-sm">Add Question</a>
                    </div>
                </div>
                <ol>                
                    @foreach ($questions as $question)
                        <li><a href="/form/{{$question->id}}" >{{ $question->question }}</a></li>
                        <ul>
                            @foreach ($question->choices as $choice)
                                <li>
                                    {{ $choice->choice }} (Score: {{ $choice->score }})
                                </li>
                            @endforeach
                        </ul>
                        <form method="POST" action="{{ route('delete_question', ['id' => $question->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete Question</button>
                        </form>
                        <br>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
@endsection