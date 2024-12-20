@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Template')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Template')

{{-- Content body: main page content --}}

@section('content_body')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with minimal features & hover style</h3>
                        <br>
                        <a href="{{ route('template') }}" target="_blank">template</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Direccion Ip</th>
                                    <th>Sistema Operativo</th>
                                    <th>Navegador</th>
                                    <th>Pais</th>
                                    <th>Ciudad</th>
                                    <th>Provedor Isp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userlog as $log)
                                <tr>
                                    <td>{{ $log->created_at }}</td>
                                    <td>{{ $log->ip }}</td>
                                    <td>{{ $log->os }}</td>
                                    <td>{{ $log->browser }}</td>
                                    <td>{{ $log->country }}</td>
                                    <td>{{ $log->city }}</td>
                                    <td>{{ $log->isp }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                                    
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false, 
        "searching": true,
        "order": [[0, "desc"]] // This line adds descending order on the first column
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    </script>

@endpush