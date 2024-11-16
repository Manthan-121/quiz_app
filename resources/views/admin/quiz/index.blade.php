@extends('admin.layout.layout')
@section('pgname')
    Show Quiz
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
                        <h3>Show Quiz</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">

                    {{-- alert start-------------------- --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('del-success'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session('del-success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('edt-success'))
                        <div class="alert alert-info alert-dismissible" role="alert">
                            {{ session('edt-success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- alert end--------------------- --}}

                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Duration</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sqn = 1;
                                @endphp
                                @foreach ($quizzes as $quizze)
                                    <tr>
                                        <td>{{ $sqn }}</td>
                                        <td>{{ $quizze->title }}</td>
                                        <td>{{ $quizze->duration }} Munites</td>
                                        <td>{{ $quizze->date }}</td>
                                        <td>{{ $quizze->time }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="statusCheckbox"
                                                    {{ $quizze->active == 'enable' ? 'checked' : '' }}
                                                    data-id="{{ $quizze->id }}">
                                                <label class="form-check-label" for="statusCheckbox">
                                                    {{ $quizze->active == 'enable' ? 'enable' : 'disable' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary"><span
                                                    class="fa-fw select-all fas"></span></button>
                                            <a href="{{ route('admin.quiz.edit', $quizze->id) }}" class="btn btn-success"><span
                                                    class="fa-fw select-all fas"></span></a>
                                            <button class="btn btn-light"><span
                                                    class="fa-fw select-all fas"></span></button>
                                        </td>
                                    </tr>
                                    @php
                                        $sqn++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#statusCheckbox').change(function() {
                var quizId = $(this).data('id');
                var status = $(this).is(':checked') ? 'enable' : 'disable';
                let checkbox = $(this);

                // Update the label dynamically
                let label = checkbox.siblings('.form-check-label');
                label.text(status);
                $.ajax({
                    url: "{{ route('admin.quiz.toggleStatus') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: quizId,
                        status: status
                    },
                    error: function() {
                        alert('Failed to update the status.'); // Optional error handling

                        // Revert the label and checkbox state on error
                    let revertStatus = !checkbox.is(':checked') ? 'enable' : 'disable';
                    checkbox.prop('checked', !checkbox.is(':checked'));
                    label.text(revertStatus);
                    }
                });
            });
        });
    </script>
@endsection
