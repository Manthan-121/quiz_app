@extends('admin.layout.layout')

@section('pgname')
    Show Questions
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
                                    <th>Total Questions</th>
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
                                            <a href="#" class="btn btn-success"><span
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
