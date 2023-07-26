@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/form" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Add new question</h1>
                    <p>Fill and submit this form to create a question</p>

                    <hr>

                    <form action="" method="POST">
                        @csrf
                        <label for="question">Enter the question:</label>
                        <input type="text" name="question" id="question" required>
                        <br>
                        <label for="numChoices">Enter the number of choices:</label>
                        <input type="number" name="num_choices" id="numChoices" min="2" max="10" required>
                        <br>
                        <div id="choicesContainer">
                            <!-- Choice input fields will be dynamically added here -->
                        </div>
                        <br>
                        <button type="submit">Submit</button>
                    </form>

                    <script>
                        const choicesContainer = document.getElementById('choicesContainer');

                        document.getElementById('numChoices').addEventListener('input', function() {
                            const numChoices = parseInt(this.value);

                            // Clear previous choice input fields
                            choicesContainer.innerHTML = '';

                            for (let i = 1; i <= numChoices; i++) {
                                const choiceContainer = document.createElement('div'); // Container div for each choice
                                choiceContainer.style.marginBottom = '10px'; // Add some space between choices

                                const choiceInput = document.createElement('input');
                                choiceInput.type = 'text';
                                choiceInput.name = `choices[${i - 1}][choice]`; // Array-based input name
                                choiceInput.placeholder = `Choice ${i}`; // Add a placeholder for better user experience
                                choiceInput.required = true;

                                const scoreInput = document.createElement('input');
                                scoreInput.type = 'number';
                                scoreInput.name = `choices[${i - 1}][score]`;
                                scoreInput.min = '0';
                                scoreInput.required = true;

                                choiceContainer.appendChild(choiceInput); // Add the choice input to the container
                                choiceContainer.appendChild(scoreInput); // Add the score input to the container

                                // Add a line break after each choice input field
                                choiceContainer.appendChild(document.createElement('br'));

                                choicesContainer.appendChild(choiceContainer); // Add the container div to the main container
                            }
                        });
                    </script>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection