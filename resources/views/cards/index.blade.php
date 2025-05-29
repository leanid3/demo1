{{-- Start of Selection --}}
@extends('layouts.app')

@section('content')
    <!--Сообщение из сессии-->
    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @elseif (session('error'))
        <x-alert type="danger" :message="session('error')" />
    @endif

    <div class="container">
        <div class="row">
            <!-- фильтры -->
            <x-filters.cards :route="isset($page) && $page == 'archive' ? route('cards.archive') : route('cards.index')" :role="'user'"  />

            <!-- карточки -->
            <div class="col-12 col-md-9">
                @if (empty($cards))
                    <div class="alert alert-warning">
                        <p>Карточек нет</p>
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        @foreach ($cards as $card)
                            <div class="col">
                                <x-card :card="$card" />
                            </div>
                        @endforeach
                    </div>
                    <!-- пагинация -->
                    <div class="row mt-4">
                        <div class="col">
                            {{ $cards->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
{{-- End of Selection --}}