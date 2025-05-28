@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('success_login'))
                    <x-alert type="success" :message="session('success_login')" />
                @endif

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ __('Профиль пользователя') }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <div class="avatar-circle mb-3">
                                    <!-- <span class="initials">{{ substr(auth()->user()->name, 0, 1) }}</span> -->
                                </div>
                                <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                <p class="text-muted">{{ auth()->user()->role }}</p>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="user-info">
                                    <div class="info-item mb-3">
                                        <label class="text-muted mb-1">Логин</label>
                                        <p class="mb-0">{{ auth()->user()->login }}</p>
                                    </div>
                                    
                                    <div class="info-item mb-3">
                                        <label class="text-muted mb-1">Email</label>
                                        <p class="mb-0">{{ auth()->user()->email }}</p>
                                    </div>
                                    
                                    <div class="info-item mb-3">
                                        <label class="text-muted mb-1">Телефон</label>
                                        <p class="mb-0">{{ auth()->user()->phone }}</p>
                                    </div>
                                    
                                    <div class="info-item mb-3">
                                        <label class="text-muted mb-1">Статус</label>
                                        <p class="mb-0">
                                            <span class="badge bg-{{ auth()->user()->status === 'active' ? 'success' : 'warning' }}">
                                                {{ auth()->user()->status === 'active' ? 'Активен' : 'Неактивен' }}
                                            </span>
                                        </p>
                                    </div>
                                    
                                    <div class="info-item">
                                        <label class="text-muted mb-1">Дата регистрации</label>
                                        <p class="mb-0">{{ auth()->user()->created_at->format('d.m.Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection