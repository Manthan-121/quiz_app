@extends('users.layouts.user_layout')
@section('title')
    Details
@endsection
@section('content')
    <div class="container mt-5 w-50">
        <div class="page-heading text-center">
            <h3>Quiz App</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{ route('user.details.store') }}" method="POST">
                                {{ route('routeName', ) }}
                                @csrf
                                <input type="hidden" name="quiz_slug" value="{{ request()->get('quiz_slug') }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Full Name</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                name="name" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Gender</label>
                                                <select name="gender" class="form-select" id="inputGroupSelect01">
                                                    <option selected>Choose...</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Email</label>
                                                <input type="email" id="email-id-vertical" class="form-control"
                                                name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Mobile</label>
                                                <input type="number" id="contact-info-vertical" class="form-control"
                                                name="mobile" placeholder="Mobile">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Start Quiz</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
