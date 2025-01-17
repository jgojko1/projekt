@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('devices.index') }}" method="GET">
            </form>
        </div>

        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Device name</th>
                        <th>Serial number</th>
                        <th>Device type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($devices as $device)
                    <tr>
                        <td>{{ $device->id }}</td>
                        <td>{{ $device->name }}</td>
                        <td>{{ $device->serial_number }}</td>
                        <td>{{ $device->device_type }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($devices->hasPages())
        <nav>
            <ul class="pagination justify-content-center">
                {{-- Prethodna stranica --}}
                @if ($devices->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $devices->previousPageUrl() }}" rel="prev">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                @endif
                {{-- Brojevi stranica --}}
                @foreach ($devices->links()->elements[0] as $page => $url)
                    @if ($page == $devices->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
                {{-- Sljedeća stranica --}}
                @if ($devices->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $devices->nextPageUrl() }}" rel="next">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
    </div>
</div>

@endsection
