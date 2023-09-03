@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('title', 'Halaman Report')

@section('header', 'Report Tracker')

@section('content')
    <div>
        <table id="tracker" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Reporter Name</th>
                    <th>Category</th>
                    <th>Ticket </th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $key => $value)
                    <tr>
                        <td>{{ $key += 1 }}</td>
                        <td>{{ $value->reporter->name }}</td>
                        <td>{{ $value->category?->name }}</td>
                        <td>{{ $value->ticket_id }}</td>
                        <td>{{ $value->title }}</td>
                        <td class="col-4">
                            {{ Illuminate\Support\Str::limit($value->description, $limit = 40, $end = '...') }}</td>
                        <td>
                            @if ($value->status == 'Pending')
                                <a href="#" class="badge badge-secondary">Pending</a>
                            @elseif ($value->status == 'Proses Administratif')
                                <a href="#" class="badge badge-info">Proses Administratif</a>
                            @elseif ($value->status == 'Proses Penanganan')
                                <a href="#" class="badge badge-warning">Proses Penanganan</a>
                            @elseif ($value->status == 'Selesai Ditangani')
                                <a href="#" class="badge badge-success">Selesai Ditangani</a>
                            @else
                                <a href="#" class="badge badge-danger">Laporan Ditolak</a>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group dropstart">
                                <button type="button" class="btn btn-sm btn-outline-success dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('report.show', $value->id) }}">Show & Update</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('report.edit', $value->id) }}">Activity Log</a></li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection

    @section('js')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tracker').DataTable();
            });
        </script>
    @endsection
