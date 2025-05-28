@props(['route', 'role', 'filters' => []])

<div class="col-12 col-md-3 mb-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Фильтры и сортировка</h5>
        </div>
        <div class="card-body">
            <form action="{{ $route }}" method="get">
                @foreach($filters as $filter)
                    @php
                        $type = $filter['type'] ?? 'text';
                        $name = $filter['name'];
                        $label = $filter['label'];
                        $value = request($name);
                        $options = $filter['options'] ?? [];
                        $placeholder = $filter['placeholder'] ?? '';
                    @endphp

                    <div class="mb-3">
                        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                        
                        @switch($type)
                            @case('select')
                                <select class="form-select" id="{{ $name }}" name="{{ $name }}">
                                    @if(isset($filter['empty_option']))
                                        <option value="">{{ $filter['empty_option'] }}</option>
                                    @endif
                                    
                                    @foreach($options as $optionValue => $optionLabel)
                                        <option value="{{ $optionValue }}" {{ $value == $optionValue ? 'selected' : '' }}>
                                            {{ $optionLabel }}
                                        </option>
                                    @endforeach
                                </select>
                                @break
                                
                            @case('date')
                                <input type="date" 
                                       class="form-control" 
                                       id="{{ $name }}" 
                                       name="{{ $name }}" 
                                       value="{{ $value }}">
                                @break
                                
                            @default
                                <input type="{{ $type }}" 
                                       class="form-control" 
                                       id="{{ $name }}" 
                                       name="{{ $name }}" 
                                       value="{{ $value }}"
                                       placeholder="{{ $placeholder }}">
                        @endswitch
                    </div>
                @endforeach

                <!-- Сортировка -->
                <div class="mb-3">
                    <label for="sort" class="form-label">Сортировать по</label>
                    <select class="form-select" id="sort" name="sort">
                        @foreach($filters as $filter)
                            @if(isset($filter['sortable']) && $filter['sortable'])
                                <option value="{{ $filter['name'] }}" {{ request('sort') == $filter['name'] ? 'selected' : '' }}>
                                    {{ $filter['label'] }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="direction" class="form-label">Направление сортировки</label>
                    <select class="form-select" id="direction" name="direction">
                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>По убыванию</option>
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>По возрастанию</option>
                    </select>
                </div>

                <!-- кнопки -->
                <div class="mb-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i>Применить
                    </button>
                    <a href="{{ $route }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Сбросить
                    </a>
                </div>
            </form>
        </div>
    </div>
</div> 