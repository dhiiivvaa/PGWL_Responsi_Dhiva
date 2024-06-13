@extends('template')

@section('content')
    <div class="container mt-2">
        <div class="card">
            <div class="card-header">
                <h3>Data Polyline</h3>
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $no = 1 @endphp
                    @foreach ($polylines as $p)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->description }}</td>
                            <td><img src="{{ asset('storage/images/') . '/' . $p->image }}" alt="Preview" width="200"></td>
                            <td>{{ date_format($p->created_at, 'D, d M Y, H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('script')

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
new DataTable('#example');

</script>

@endsection