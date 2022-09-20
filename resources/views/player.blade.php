<x-layout>
    <main>
        <h1>All Blacks Rugby</h1>
        <div class="grid">
            <div class="card">
                <img src="/images/teams/allblacks.png" alt="All blacks logo" class="logo" />
                <div class="name">
                    <em class="number">#{{ $number }}</em>
                    <h2 class="player-name">{{ $first_name }} <strong>{{ $last_name }}</strong></h2>
                </div>
                <div class="profile">
                    <img src="/images/players/allblacks/{{ $image }}" alt="{{ $first_name }} {{ $last_name }}" class="headshot player-image" />
                    <div class="features">
                        <div class="feature">
                            <h3>{{ $featured[0]['label'] }}</h3>
                            <span class="points">{{ $featured[0]['value'] }}</span>
                        </div>
                        <div class="feature">
                            <h3>{{ $featured[1]['label']  }}</h3>
                            <span class="games">{{ $featured[1]['value'] }}</span>
                        </div>
                        <div class="feature">
                            <h3>{{ $featured[2]['label']  }}</h3>
                            <span class="tries">{{ $featured[2]['value'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="bio">
                    <div class="data">
                        <strong>Position</strong>
                        <span class="position">{{ $position }}</span>
                    </div>
                    <div class="data">
                        <strong>Weight</strong>
                        <span class="weight">{{ $weight }}</span>KG
                    </div>
                    <div class="data">
                        <strong>Height</strong>
                        <span class="height">{{ $height }}</span>CM
                    </div>
                    <div class="data">
                        <strong>Age</strong>
                        <span class="age">{{ $age }}</span> years
                    </div>
                </div>
            </div>
            <nav class="grid-item">
                <ul>
                    <li class="vertical-text"><a href="#" id="prev">Player Name</a></li>
                    <li class="vertical-text active"><a href="#" id="current">{{ $first_name }} {{ $last_name }}</li>
                    <li class="vertical-text"><a href="#" id="next">Player Name</a></li>
                </ul>
            </nav>
        </div>  
    </main>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        let playersInformation = [];
        $.get('https://www.zeald.com/developer-tests-api/x_endpoint/allblacks?API_KEY=few823mv__570sdd0342', function(data, status) {

            let players = JSON.parse(data);
            playersInformation = players;
            let playerIndex = Number(window.location.href.substring(window.location.href.lastIndexOf('/')+1) -1);
            playerIndex = isNaN(playerIndex) ? 0 : playerIndex;

            let numberOfPlayers = players.length;

            if(playerIndex != 0) {
                document.getElementById('prev').innerHTML = players[playerIndex-1].name;
                $('#prev').attr('data-player-id', `${playerIndex}`);
            } else {
                document.getElementById('prev').innerHTML = players[numberOfPlayers-1].name;
                $('#prev').attr('data-player-id', `${numberOfPlayers}`);
            }

            if(playerIndex + 1 == numberOfPlayers) {
                document.getElementById('next').innerHTML = players[0].name;
                $('#next').attr('data-player-id', `1`);
            } else {
                document.getElementById('next').innerHTML = players[playerIndex+1].name;
                $('#next').attr('data-player-id', `${playerIndex + 2}`);
            }
        })

        $('#prev').click(function(e) {
            e.preventDefault();
            let playerIndex = $(this).attr('data-player-id')-1;
            let playerID = $(this).attr('data-player-id');
            $.get(`https://www.zeald.com/developer-tests-api/x_endpoint/allblacks/id/${playerID}?API_KEY=few823mv__570sdd0342`, function(data, status) {
                let playerInformation = JSON.parse(data)[0];
                let playerName = playerInformation.name.split(" ");
                let firstName = playerName[0];
                let lastName = playerName[1];
                let playerImage = firstName.toLowerCase() + '-' + lastName.toLowerCase() + '.png';

                $('.age').text(playerInformation.age);
                $('.weight').text(playerInformation.weight);
                $('.height').text(playerInformation.height);
                $('.position').text(playerInformation.position);
                $('.number').text(`#${playerInformation.number}`);
                $('.points').text(playerInformation.points);
                $('.games').text(playerInformation.games);
                $('.tries').text(playerInformation.tries);
                $('#current').text(playerInformation.name);
                $('#current').attr('data-player-id', `/images/players/allblacks/${playerImage}`);

                $('.player-name').html(`${firstName} <strong>${lastName}</strong>`);
                $('.player-image').attr('src', `/images/players/allblacks/${playerImage}`);

                if(playerIndex == playersInformation.length - 1 ) {
                    $('#prev').text(playersInformation[playerIndex - 1].name);
                    $('#prev').attr('data-player-id', playerIndex);

                    $('#next').text(playersInformation[0].name);
                    $('#next').attr('data-player-id', 1);
                } else if (playerIndex == 0) {
                    $('#prev').text(playersInformation[playersInformation.length - 1].name);
                    $('#prev').attr('data-player-id', playersInformation.length);

                    $('#next').text(playersInformation[playerIndex + 1].name);
                    $('#next').attr('data-player-id', playerIndex + 2);
                } else {
                    $('#prev').text(playersInformation[playerIndex - 1].name);
                    $('#prev').attr('data-player-id', playerIndex);

                    $('#next').text(playersInformation[playerIndex + 1].name);
                    $('#next').attr('data-player-id', playerIndex + 2);
                }
            });
        });

        $('#next').click(function(e) {
            e.preventDefault();
            let playerIndex = $(this).attr('data-player-id')-1;
            let playerID = $(this).attr('data-player-id');
            $.get(`https://www.zeald.com/developer-tests-api/x_endpoint/allblacks/id/${playerID}?API_KEY=few823mv__570sdd0342`, function(data, status) {
                let playerInformation = JSON.parse(data)[0];
                let playerName = playerInformation.name.split(" ");
                let firstName = playerName[0];
                let lastName = playerName[1];
                let playerImage = firstName.toLowerCase() + '-' + lastName.toLowerCase() + '.png';

                $('.age').text(playerInformation.age);
                $('.weight').text(playerInformation.weight);
                $('.height').text(playerInformation.height);
                $('.position').text(playerInformation.position);
                $('.number').text(`#${playerInformation.number}`);
                $('.points').text(playerInformation.points);
                $('.games').text(playerInformation.games);
                $('.tries').text(playerInformation.tries);
                $('#current').text(playerInformation.name);

                $('.player-name').html(`${firstName} <strong>${lastName}</strong>`);
                $('.player-image').attr('src', `/images/players/allblacks/${playerImage}`);
                if(playerIndex == playersInformation.length - 1 ) {
                    $('#prev').text(playersInformation[playerIndex - 1].name);
                    $('#prev').attr('data-player-id', playerIndex);

                    $('#next').text(playersInformation[0].name);
                    $('#next').attr('data-player-id', 1);
                } else if (playerIndex == 0) {
                    $('#prev').text(playersInformation[playersInformation.length - 1].name);
                    $('#prev').attr('data-player-id', playersInformation.length);

                    $('#next').text(playersInformation[playerIndex + 1].name);
                    $('#next').attr('data-player-id', playerIndex + 2);
                } else {
                    $('#prev').text(playersInformation[playerIndex - 1].name);
                    $('#prev').attr('data-player-id', playerIndex);

                    $('#next').text(playersInformation[playerIndex + 1].name);
                    $('#next').attr('data-player-id', playerIndex + 2);
                }
            });
        });
    </script>

</x-layout>
