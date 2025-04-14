<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>php-hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="d-flex justify-content-center p-4">Hotels</h1>

    <?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];
    

    // Save the filter state in the URL
    $parkingFilter = isset($_GET['parking']);
    $voteFilter = isset($_GET['vote']);

    // Check if the form is submitted and filter the hotels accordingly
    $filteredHotels = $hotels;

    // Check if the filters are set in the URL
    if ($parkingFilter || $voteFilter) {
        $filteredHotels = array_filter($hotels, function($hotel) use ($parkingFilter, $voteFilter) {
            $passParking = !$parkingFilter || $hotel['parking'];
            $passVote = !$voteFilter || $hotel['vote'] > 3;
            return $passParking && $passVote;
        });
    }

    echo "<h2 class='text-center mb-4'>Filtra</h2>";
    echo "<div class='d-flex justify-content-center gap-5 mb-4'>
    <form class='d-flex flex-column gap-2'>
      <div class='d-flex flex-column'>
          <div class='form-check'>
           <input class='form-check-input' type='checkbox' name='parking' id='checkParking' " . ($parkingFilter ? 'checked' : '') . ">
           <label class='form-check-label' for='checkDefault'>
             Parcheggio
           </label>
          </div>
          <div class='form-check'>
           <input class='form-check-input' type='checkbox' name='vote' id='checkVote' " . ($voteFilter ? 'checked' : '') . ">
           <label class='form-check-label' for='checkDefault2'>
             Voto maggiore di 3
           </label>
          </div>
          </div>
          <div class='d-flex justify-content-center gap-2'>
          <button class='btn btn-primary' type='submit'>Filtra</button>
          </div>
          </form>
    </div>";

    
    echo "<div class='d-flex justify-content-center m-2'>
    <table class='table table-striped table-hover table-bordered border-secondary shadow-lg'>
      <thead>
          <tr>
              <th scope='col'>Nome</th>
              <th scope='col'>Descrizione</th>
              <th scope='col'>Parcheggio</th>
              <th scope='col'>Voto</th>
              <th scope='col'>Distanza dal centro</th>
          </tr>
      </thead>
      <tbody>";

    foreach ($filteredHotels as $hotel) {
      
        echo "<tr>
        <td>" . $hotel['name'] . "</td>
        <td>" . $hotel['description'] . "</td>
        <td>" . ($hotel['parking'] ? 'si' : 'no') . "</td>
        <td>" . $hotel['vote'] . "</td>
        <td>" . $hotel['distance_to_center'] . " km</td>
      </tr>";
   
    }
    echo "</tbody>
    </table>          
    </div>";

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>