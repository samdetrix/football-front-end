@extends('layouts.main')
@section('content')
    
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Active games</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-layer float-right m-0 h2 text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Active Games</h6>
                            <h3 class="mb-3" data-plugin="counterup">0</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-dollar-circle float-right m-0 h2 text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">My Games</h6>
                            <h3 class="mb-3"><span data-plugin="counterup">0</span></h3>
                        </div>
                    </div>
                </div>

               
            </div>
            <!-- end row -->



            <div class="row">
                

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="dropdown float-right position-relative">
                                <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                               
                            </div>

                            <h4 class="card-title overflow-hidden">Today's Featured Games</h4>
                            <p class="card-subtitle mb-4 font-size-13 overflow-hidden">Transaction period from 21 July to 25 Aug
                            </p>

                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-centered table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Flag</th>
                                            <th>League</th>
                                            <th>Teams</th>
                                            <th>Country</th>
                                            <th>Season</th>
                                            <th>Round</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fixturesTableBody">
                                        <!-- Table rows will be dynamically inserted here -->
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    

</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchFixturesData();
    });

    function fetchFixturesData() {
        fetch('http://127.0.0.1:8000/api/fixtures/matches')
            .then(response => response.json())
            .then(data => {
                console.log(data); 

                if (data.status === 'success') {
                    const fixtures = data.data.slice(0, 5);

                    const tbody = document.getElementById('fixturesTableBody');

                    fixtures.forEach(fixture => {
                        const row = tbody.insertRow();
                        const cellLeagueLogo = row.insertCell(0);
                        const cellTeams = row.insertCell(1);
                        const cellLeagueName = row.insertCell(2);
                        const cellLeagueCountry = row.insertCell(3);
                        const cellSeason = row.insertCell(4);
                        const cellRound = row.insertCell(5);

                        // Set cell values
                        cellLeagueLogo.innerHTML = `<img src="${fixture.league_logo}" alt="League Logo" width="30" height="30">`;
                        cellTeams.innerHTML = `<strong>${fixture.home_team}</strong><br>${fixture.away_team}`;
                        cellLeagueName.textContent = fixture.league_name;
                        cellLeagueCountry.textContent = fixture.league_country;
                        cellSeason.textContent = fixture.league_season;
                        cellRound.textContent = fixture.league_round;
                    });
                } else {
                    console.error('Error fetching fixtures:', data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching fixtures:', error);
            });
    }
</script>
@endsection
