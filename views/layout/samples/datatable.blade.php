@extends('layout.default')

@section('content')
    <div class="">

        <div class="row">
            <div class="col-lg-12">
            <div class="page-header">
                <h1 id="tables">Tables</h1>
            </div>

            <div class="bs-component">
                <table class="table">
                    <thead>
                        <tr>
                            <th>First</th>
                            <th>Last</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$row['fname']}}</td>
                                <td>{{$row['lname']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /example -->
            </div>
        </div>
        </div>
@stop

@section('scripts')
    <script>
        $("table").DataTable();
    </script>
@stop