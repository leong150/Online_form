@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/form" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Edit question</h1>
                    <p>Edit and submit this form to update a question</p>

                    <hr>

                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="question">Question</label>
                                <textarea cols="80" rows="1" id="question" class="form-control" name="question" value="{{ $question->question }}" required>{{ $question->question}}</textarea>
                            </div>
                            <br>
                            <div class="control-group col-12 mt-2">
                            <label for="numChoices">Edit the number of choices:</label>
                            <input type="number" name="num_choices" id="numChoices" min="2" max="10" value="{{ count($question->choices) }}" required>
                            <br>
                            <div id="choicesContainer">
                                @foreach ($question->choices as $index => $choice)
                                    <div>
                                        <input type="text" name="choices[{{ $index }}][choice]" value="{{ $choice->choice }}" required>
                                        <input type="number" name="choices[{{ $index }}][score]" value="{{ $choice->score }}" required>
                                        <button type="button" onclick="removeChoice(this)">Remove Choice</button>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <button type="submit">Update</button>
                        </form>

                        <script>
                            function removeChoice(button) {
                                button.parentNode.remove();
                            }

                            document.getElementById('numChoices').addEventListener('input', function() {
                                const numChoices = parseInt(this.value);
                                const choicesContainer = document.getElementById('choicesContainer');
                                const currentChoices = choicesContainer.getElementsByTagName('div').length;

                                if (numChoices > currentChoices) {
                                    for (let i = currentChoices + 1; i <= numChoices; i++) {
                                        const choiceContainer = document.createElement('div');
                                        const choiceInput = document.createElement('input');
                                        const scoreInput = document.createElement('input');
                                        const removeButton = document.createElement('button');

                                        choiceInput.type = 'text';
                                        choiceInput.name = `choices[${i - 1}][choice]`;
                                        choiceInput.placeholder = `Choice ${i}`;
                                        choiceInput.required = true;

                                        scoreInput.type = 'number';
                                        scoreInput.name = `choices[${i - 1}][score]`;
                                        scoreInput.required = true;

                                        removeButton.type = 'button';
                                        removeButton.textContent = 'Remove Choice';
                                        removeButton.addEventListener('click', function() {
                                            removeChoice(this);
                                        });

                                        choiceContainer.appendChild(choiceInput);
                                        choiceContainer.appendChild(scoreInput);
                                        choiceContainer.appendChild(removeButton);
                                        choicesContainer.appendChild(choiceContainer);
                                    }
                                } else if (numChoices < currentChoices) {
                                    const excessChoices = currentChoices - numChoices;
                                    for (let i = 1; i <= excessChoices; i++) {
                                        choicesContainer.removeChild(choicesContainer.lastChild);
                                    }
                                }
                            });
                        </script>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection