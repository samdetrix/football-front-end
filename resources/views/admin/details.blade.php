@extends('layouts.main')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bet Details </h4>
                                <div class="card">
                                    <div class="card-body">
                                        <ul>
                                            <li>Home Team: {{$match->home_team}} 🏠</li>
                                            <li>Away Team: {{$match->away_team}}  visitante</li>
                                            <li>League: {{$match->league_name}} 🏆</li>
                                            <li>Country: {{$match->league_country}}🇬🇷</li>
                                            <li>Season: {{$match->league_season}} 📅</li>
                                            <li>Round: {{$match->league_round}} 🔁</li>
                                        </ul>
                                        <div class="card-footer">
                                            <img src="{{$match->league_logo}}" alt="{league_name} logo" width="50" height="30">
                                            <img src="{{$match->league_flag}}" alt="{league_country} flag" width="30" height="20">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Action</h4>
                                <a href="{{ route('change-password') }}" class="btn btn-info">make bet </a>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                       
                </div>
            </div>
        </div>
    </div>
    <!-- end row-->
@endsection
@section('scripts')
 
@endsection
