{{-- Start of Selection --}}
@extends('layouts.app')

@section('content')
    <!--Сообщение из сессии-->
    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <div class="container">
        <div class="row">
            <!-- фильтры -->
            <x-filter-card :route="route('cards.index')" :role="'user'" />

            <!-- карточки -->
            <div class="col-12 col-md-9">
                @if ($cards->isEmpty())
                    <div class="alert alert-warning">
                        <p>Карточек нет</p>
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        @foreach ($cards as $card)
                            <div class="col">
                                <x-card-table :card-table="$card" />
                            </div>
                        @endforeach
                    </div>
                    <!-- пагинация -->
                    <div class="row mt-4">
                        <div class="col">
                            {{ $cards->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
{{-- End of Selection --}}