@extends('template')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Data Point</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dini</td>
                            <td>A</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Weni</td>
                            <td>A</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Imin</td>
                            <td>A</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection