@extends('admin.layout.layout')

@section('pgname')
    Add Questions
@endsection

@section('containt')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Add Questions</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <form id="questionsForm" method="POST" action="{{ route('admin.questions.store') }}">
                @csrf
                <!-- Quiz Details Dropdown -->
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="helpInputTop">Quiz Details</label>
                                        <select class="form-select  @error('quiz_id') is-invalid @enderror"" id="quizSelect"
                                            name="quiz_id">
                                            <option value="" selected disabled>Select Quiz</option>
                                            @foreach ($quizzes as $quiz)
                                                <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('quiz_id')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Questions Container -->
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div id="questions-container">
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="button" id="addQuestionBtn" class="btn btn-success">Add New
                                        Question</button>
                                    <button type="submit" class="btn btn-primary">Submit Questions</button>
                                </div>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let questionCount = {{ old('questions') ? count(old('questions')) : 0 }};

            const addQuestion = (data = {}) => {
                const questionHtml = `
            <div class="question-item mb-3" id="question-${questionCount}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="questions[${questionCount}][question]">Question</label>
                            <input type="text" name="questions[${questionCount}][question]"
                                class="form-control @error('questions.${questionCount}.question') is-invalid @enderror"
                                value="${data.question || ''}" required>
                            @error('questions.${questionCount}.question')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="questions[${questionCount}][correct_option]">Correct Option</label>
                            <input type="text" name="questions[${questionCount}][correct_option]"
                                class="form-control @error('questions.${questionCount}.correct_option') is-invalid @enderror"
                                value="${data.correct_option || ''}" required>
                            @error('questions.${questionCount}.correct_option')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="questions[${questionCount}][options]">Options (Comma Separated)</label>
                            <input type="text" name="questions[${questionCount}][options]"
                                class="form-control @error('questions.${questionCount}.options') is-invalid @enderror"
                                value="${data.options || ''}" required>
                            @error('questions.${questionCount}.options')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger removeQuestionBtn" data-id="${questionCount}">
                            Remove Question
                        </button>
                    </div>
                </div>
                <hr>
            </div>`;
                document.getElementById('questions-container').insertAdjacentHTML('beforeend', questionHtml);
                questionCount++;
            };

            document.getElementById('addQuestionBtn').addEventListener('click', function() {
                addQuestion();
            });

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('removeQuestionBtn')) {
                    const questionId = event.target.getAttribute('data-id');
                    document.getElementById(`question-${questionId}`).remove();
                }
            });

            // Re-populate old questions on validation error
            @if (old('questions'))
                const oldQuestions = @json(old('questions'));
                oldQuestions.forEach(question => addQuestion(question));
            @endif
        });
    </script>
@endsection
