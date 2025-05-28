@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Создание карточки</h5>
                    </div>
                    <div class="card-body">
                        <x-forms.card 
                            :action="route('cards.store')"
                            method="POST"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection