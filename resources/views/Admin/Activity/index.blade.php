@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('title', 'Halaman Activity Log')

@section('header', 'Activity Log')

@section('content')
    <table id="tracker" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Report</th>
                <th>Status</th>
                <th>Note</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tracker as $key => $value)
            <tr>
                <td>{{ $key += 1 }}</td>
                <td>{{ $value->user_id }}</td>
                <td>{{ $value->report_id }}</td>
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
                <td class="col-6">{{ Illuminate\Support\Str::limit($value->note, $limit = 200, $end = '...') }}</td>
                <td><a href="{{ route('tracker.show', $value->id) }}" style="text-decoration: underline">Show</a></td>
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