<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- meta data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--font-family-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet">

    <!-- title of site -->
    <title>CarVilla</title>

    <!-- For favicon png -->
    <link rel="shortcut icon" type="image/icon" href="{{ asset('client/assets/logo/favicon.png') }}" />

    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="{{ asset('client/assets/css/font-awesome.min.css') }}">

    <!--linear icon css-->
    <link rel="stylesheet" href="{{ asset('client/assets/css/linearicons.css') }}">

    <!--flaticon.css-->
    <link rel="stylesheet" href="{{ asset('client/assets/css/flaticon.css') }}">

    <!--animate.css-->
    <link rel="stylesheet" href="{{ asset('client/assets/css/animate.css') }}">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="{{ asset('client/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/owl.theme.default.min.css') }}">

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="{{ asset('client/assets/css/bootstrap.min.css') }}">

    <!-- bootsnav -->
    <link rel="stylesheet" href="{{ asset('client/assets/css/bootsnav.css') }}">

    <!--style.css-->
    <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}">

    <!--responsive.css-->
    <link rel="stylesheet" href="{{ asset('client/assets/css/responsive.css') }}">

    <style>
        .model-search-content {
            padding: 20px;
        }

        .model-search-content {
            padding: 20px;
        }

        .single-featured-cars {
            margin-bottom: 20px;
        }

        .featured-cars-img img {
            width: 100%;
            height: auto;
        }

        .featured-model-info p {
            margin-bottom: 5px;
        }

        .featured-model-info span {
            margin-left: 5px;
        }

        .featured-cars-txt h2 a {
            color: #333;
            text-decoration: none;
        }

        .featured-cars-txt h2 a:hover {
            color: #007bff;
        }
    </style>
</head>

<body>
    <section id="home" class="welcome-hero">
        <!-- top-area Start -->
        <div class="top-area">
            <div class="header-area">
                <!-- Start Navigation -->
                <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"
                    data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

                    <div class="container">

                        <!-- Start Header Navigation -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="index.html">TechVannah Bet Space<span></span></a>

                        </div><!--/.navbar-header-->
                        <!-- End Header Navigation -->

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                            <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">

                                <li class=""><a href="{{ route('sign.in') }}">Sign In</a></li>
                            </ul><!--/.nav -->
                        </div><!-- /.navbar-collapse -->
                    </div><!--/.container-->
                </nav><!--/nav-->
                <!-- End Navigation -->
            </div><!--/.header-area-->
            <div class="clearfix"></div>

        </div><!-- /.top-area-->
        <!-- top-area End -->

        <div class="container">
            <div class="welcome-hero-txt">
                <h2>Bet with Us</h2>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="model-search-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Games</th>
                                </tr>
                            </thead>
                            <tbody id="matchDetails">
                                <!-- The fetched data will be dynamically inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section><!--/.welcome-hero-->
    <!--welcome-hero end -->




    <!-- Include this script in your Blade template -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchMatchesData();
        });

        function fetchMatchesData() {
            fetch('http://127.0.0.1:8000/api/fixtures/matches')
                .then(response => response.json())
                .then(data => {
                    console.log(data.data);
                    const matches = data.data.slice(0, 5);

                    const tbody = document.getElementById('matchDetails');

                    matches.forEach(match => {
                        const row = tbody.insertRow();

                        const cellTeams = row.insertCell(0);
                        const cellActions = row.insertCell(1); // New cell for buttons

                        // Home Team Flag and Name
                        const homeTeamContent =
                            `<img src="${match.league_flag}" alt="Home Team Flag" width="20" height="15"> ${match.home_team}`;

                        // Away Team Flag and Name
                        const awayTeamContent =
                            `<img src="${match.league_flag}" alt="Away Team Flag" width="20" height="15"> ${match.away_team}`;

                        // League Country and Season
                        const leagueInfo =
                            `<p>Country: ${match.league_country}</p><p>Season: ${match.league_season}</p>`;

                        // Add additional fields here
                        const additionalInfo =
                            `<p>League ID: ${match.league_id}</p><p>League Name: ${match.league_name}</p>`;

                        // Home vs Away with additional fields
                        cellTeams.innerHTML =
                            `${homeTeamContent} vs ${awayTeamContent} ${leagueInfo} ${additionalInfo}`;

                        // Buttons for actions
                        const placeBetButton =
                            `<button class="btn btn-info" onclick="placeBet('${match.id}')">Place Bet</button>`;
                        const viewDetailsButton =
                            `<button class="btn btn-success" onclick="viewDetails('${match.id}')">View Details</button>`;

                        cellActions.innerHTML = `${placeBetButton} ${viewDetailsButton}`;
                    });
                })
                .catch(error => {
                    console.error('Error fetching match data:', error);
                });
        }

        function placeBet(matchId) {
            console.log(`Placing a bet for match with ID ${matchId}`);
        }

        function viewDetails(matchId) {
            window.location.href = `/view-details/${matchId}`;
            console.log(`Viewing details for match with ID ${matchId}`);
        }
    </script>





    <script src="{{ asset('client/assets/js/jquery.js') }}"></script>

    <!--modernizr.min.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <!--bootstrap.min.js-->
    <script src="{{ asset('client/assets/js/bootstrap.min.js') }}"></script>

    <!-- bootsnav js -->
    <script src="{{ asset('client/assets/js/bootsnav.js') }}"></script>

    <!--owl.carousel.js-->
    <script src="{{ asset('client/assets/js/owl.carousel.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!--Custom JS-->
    <script src="{{ asset('client/assets/js/custom.js') }}"></script>

</body>

</html>
