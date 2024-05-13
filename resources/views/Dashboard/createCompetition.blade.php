@extends('Dashboard.layout')

@section('title')
    Create Competition
@endsection

@section('content')
    <div class="form">
        @if (session('success'))
            <div class="alert alert-success" id="message">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" id="message">
                {{ session('error') }}
            </div>
        @endif
        <h2>Create New Competition</h2>
        <hr>
        <div class="fields">
            <form action="/add/competition/events" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label>Competition Name</label>
                    <input type="text" class="form-control" placeholder="Enter competition name" name="name"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group d-flex">
                    <div>
                        <label>Competition Image</label>
                        <input type="file" class="form-control-file" name="photo">
                        @error('photo')
                            <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-2" style="display: flex;flex-direction:column;font-size:3vh;color:#194185">
                        <div>
                            <input type="radio" name="competition_category" value="0" checked> Individual
                        </div>
                        <div>
                            <input type="radio" name="competition_category" value="1"> Team
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Competition Description</label>
                    <textarea type="text" placeholder="Enter competition description" name="description" cols="30" rows="5"
                        class="form-control">
                      {{ old('description') }}
                    </textarea>
                    @error('description')
                        <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                    @enderror
                </div>

                <div class="d-flex justify-content-end p-3">
                    <button type="submit" class="sign-btn text-white"
                        style="background-color: #4FACFC; border-radius:10px;font-size:23px;padding: 0.5% 2%">Next <i
                            class="bi bi-arrow-right"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
