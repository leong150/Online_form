@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/form" class="btn btn-outline-primary btn-sm">Go back</a>
                <h1 class="display-one">Question: {{ $question->question }}</h1>
                <ul>
                    @foreach ($question->choices as $choice)
                        <li>
                            {{ $choice->choice }} (Score: {{ $choice->score }})
                        </li>
                    @endforeach
                </ul>
                <hr>
                <a href="/form/{{ $question->id }}/edit" class="btn btn-outline-primary">Edit question</a>
                <br><br>
                <form id="delete-frm" class="" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Delete question</button>
                </form>
            </div>
        </div>
    </div>
@endsection