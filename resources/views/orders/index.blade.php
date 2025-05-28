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
            <x-filters.orders :route="isset($page) && $page == 'archive' ? route('orders.archive') : route('orders.index')" :role="'user'"  />

            <!-- карточки -->
            <div class="col-12 col-md-9">
                @if (empty($orders))
                    <div class="alert alert-warning">
                        <p>Заявок нет</p>
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        @foreach ($orders as $order)
                            <div class="col">
                                <x-card :card="$order" />
                            </div>
                        @endforeach
                    </div>
                    <!-- пагинация -->
                    <div class="row mt-4">
                        <div class="col">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
{{-- End of Selection --}}