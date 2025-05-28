@extends('layouts.app')
@section('content')

    
            <div class="col-md-6">
                <form class="form-card" method="POST" action="{{ route('cards.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Автор</label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror" name="author"
                            required>
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Название</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input @error('type') is-invalid @enderror" type="radio" name="type"
                                value="share" id="typeShare" checked>
                            <label class="form-check-label" for="typeShare">Готов поделиться</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('type') is-invalid @enderror  " type="radio" name="type"
                                value="wish" id="typeWish">
                            <label class="form-check-label" for="typeWish">Хочу в свою библиотеку</label>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        

@endsection