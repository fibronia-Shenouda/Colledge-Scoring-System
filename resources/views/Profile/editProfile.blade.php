@extends('Pages.layout')


@section('title')
    Profile Setting
@endsection


@section('content')
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
    <div class="form">
        <p>Edite Profile</p>
        <form action="/setting/{{ auth()->user()->id }}/edit" method="POST" class="container form-container"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if (auth()->user()->priviledge == 'admin')
                <label>Phone Number</label>
                <input value="{{ auth()->user()->phone_number }}" type="text" name="phone_number"
                    class="form-control mb-3">
                @error('phone_number')
                    <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
                @enderror
                <label>Brief Description</label>
                <textarea placeholder="Add a brief description about you" rows="5" name="description" class="form-control mb-3">{{ old('description') ? old('description') : auth()->user()->description }}</textarea>
                @error('description')
                    <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
                @enderror
                <label>Photo</label>
                <input type="file" name="photo" class="form-control mb-3">
                <img class="card-img-top w-25"
                    src="{{ auth()->user()->photo ? asset('./storage/' . auth()->user()->photo) : asset('./assets/images/profile.png') }}"
                    alt="competition photo" style="height: 200px">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="join-btn"><i class="bi bi-pencil-square"></i> Edite</button>
                </div>
            @else
                <label>Name</label>
                <input value="{{ old('name') ? old('name') : auth()->user()->name }}" type="text" name="name"
                    class="form-control mb-3">
                @error('name')
                    <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
                @enderror
                <label>Phone Number</label>
                <input value="{{ auth()->user()->phone_number }}" type="text" name="phone_number"
                    class="form-control mb-3">
                @error('phone_number')
                    <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
                @enderror
                <label>Brief Description</label>
                <textarea placeholder="Add a brief description about you" rows="5" name="description" class="form-control mb-3">{{ old('description') ? old('description') : auth()->user()->description }}</textarea>
                @error('description')
                    <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
                @enderror
                <label>Photo</label>
                <input type="file" name="photo" class="form-control mb-3">
                <img class="card-img-top w-25"
                    src="{{ auth()->user()->photo ? asset('./storage/' . auth()->user()->photo) : asset('./assets/images/profile.png') }}"
                    alt="competition photo" style="height: 200px">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="join-btn"><i class="bi bi-pencil-square"></i> Edite</button>
                </div>
            @endif
        </form>
    </div>
@endsection
