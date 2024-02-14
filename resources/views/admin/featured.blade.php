@extends('layouts.main')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Today's Matches</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item active">Featured</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">


                                <table id="matchesDataTable" class="table dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Teams</th>
                                            <th>League</th>
                                            <th>Country</th>
                                            <th>Season</th>
                                            <th>Round</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body will be populated dynamically -->
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->


            </div> <!-- container-fluid -->
        </div>
    </div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchMatchesData();
    });

    function fetchMatchesData() {
        fetch('http://127.0.0.1:8000/api/fixtures/matches')
            .then(response => response.json())
            .then(data => {
                console.log(data); 

                if (data.status === 'success') {
                    $('#matchesDataTable').DataTable().clear().destroy();

                    $('#matchesDataTable').DataTable({
                        data: data.data,
                        columns: [
                            {
                                data: 'league_logo',
                                render: function (data, type, row) {
                                    return '<img src="' + data + '" alt="League Logo" width="30" height="30">';
                                }
                            },
                            {
                                data: null,
                                render: function (data, type, row) {
                                    return '<strong>Home:</strong> ' + row.home_team +
                                        '<br><strong>Away:</strong> ' + row.away_team;
                                }
                            },
                            { data: 'league_name' },
                            { data: 'league_country' },
                            { data: 'league_season' },
                            { data: 'league_round' },
                        ]
                    });
                } else {
                    console.error('Error fetching matches:', data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching matches:', error);
            });
    }
</script>
@endsection
