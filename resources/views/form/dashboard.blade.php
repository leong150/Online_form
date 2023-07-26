@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">Responses Dashboard</h1>
                    </div>
                    <table>
                        <tr>
                            <th>Question</th>
                            <th>Choice</th>
                            <th>Score</th>
                            <th>User</th>
                            <th>Response Time</th>
                        </tr>
                        @foreach ($userResponses as $response)
                            <tr>
                                <td>{{ $response->question->question }}</td>
                                <td>{{ $response->choice->choice }}</td>
                                <td>{{ $response->score }}</td>
                                <td>{{ substr($response->session_id, 0, 8) }}...{{ substr($response->session_id, -8) }}</td>
                                <td>{{ $response->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
            </div>
        </div>
    </div>
@endsection