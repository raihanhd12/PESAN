@extends('layouts.admin')

@section('title', 'Halaman Activity Log')

@section('header', 'Activity Log')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Activity Log
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @forelse ($logs as $key => $log)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $key != 0 ? 'collapsed' : '' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $key }}"
                                            aria-expanded="true" aria-controls="collapse-{{ $key }}">
                                            <span>{{ $log->description }}</span> <small
                                                class="text-muted ms-2 pb-1">({{ $log->created_at->diffForHumans() }})</small>
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $key }}"
                                        class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-group">
                                                <li class="list-group-item bg-success text-white">Old Data</li>
                                                @if (isset($log['properties']['old']))
                                                    <li class="list-group-item"><strong>Status:</strong>
                                                        {{ $log['properties']['old']['status'] }}</li>
                                                    {{-- <li class="list-group-item"><strong>Note:</strong> {{ $log['properties']['old']['note'] }}</li> --}}
                                                @else
                                                    <li class="list-group-item">No old data available</li>
                                                @endif

                                                <li class="list-group-item bg-success text-white">New Data</li>
                                                @if (isset($log['properties']['attributes']))
                                                    <li class="list-group-item"><strong>Status:</strong>
                                                        {{ $log['properties']['attributes']['status'] }}</li>
                                                    {{-- <li class="list-group-item"><strong>Note:</strong> {{ $log['properties']['attributes']['note'] }}</li> --}}
                                                @else
                                                    <li class="list-group-item">No new data available</li>
                                                @endif
                                            </ul>



                                            {{ $log->description }}

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $key }}" aria-expanded="true"
                                            aria-controls="collapse-{{ $key }}">
                                            No activity found.
                                        </button>
                                    </h2>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
