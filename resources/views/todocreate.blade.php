@extends('layouts.base')
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>create new Todo</h4>
                        </div>
                        <div class="card-header">
                            <form action="" method="post" class="needs-validation">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Todo name</label>
                                    <input id="" type="text" class="form-control" name="name" tabindex="1" required autofocus placeholder="name">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
