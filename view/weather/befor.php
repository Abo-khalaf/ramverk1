
<br>
<br>
<h1 class="ip">Validate IP address</h1>

<a style="float: right;" href="http://localhost:8080/dbwebb/ramverk1/me/redovisa/htdocs/weather"><button class="pl1">Back</button></a>
<br>
    <!-- <?php         var_dump($getDataArray); ?> -->
    <?php if(!isset($_GET["ip"])) : ?>
        <form method="get" action="" >
            <div>
                  <input id="ip" type="text" name="ip" value="<?=$ip?>" required>
            </div>
            <div  role="onchange">
              The default IP address
            </div>
            <button class="pl1" type="submit">Validate</button>
    <?php endif; ?>
    </form>
    <?php if(isset($_GET["ip"]) && $Domain != "Not valid") : ?>
        <table>
            <thead>
            <br>
                </tr>
                <tbody>
                <tr>
                    <th scope="row">Validation</th>
                    <td><?=$protocol?></td>
                </tr>
                <tr>
                    <th scope="row">Host</th>
                    <td><?=$host?></td>
                </tr>
                <tr>
                    <th  scope="row">IP: </th>
                    <td id="ip"><?=$address["ip"]?></td>
                </tr>
                </tbody>
            </thead>
        </table>


        <table>
            <thead>
            <br>

                <tr>
                    <th>
                        <?php foreach($getDataArray as $key=>$value): ?>
                            <td style="padding: 30px;"> <h4><?=$value['current']['temp']?></h4> </td>
                        <?php endforeach; ?>
                    </th>
                </tr>
                </tbody>
            </thead>
        </table>

        <div class="weather-icon-previous">
            <?php foreach ($arrIconPrevious as $key1 => $value1) : ?>
                <img style="width:75px;" src="https://openweathermap.org/img/wn/<?= $value1 ?>@2x.png"</img>
            <?php endforeach; ?>
        </div>

        <table>
            <thead>

                <tr>
                    <th>
                            <td> <h4><?= implode("  ,   ", $dateArrayPrevious) ?></h4> </td>
                    </th>
                </tr>
                </tbody>
            </thead>
        </table>


        <br>
        <br>

        <br>


                        <div hidden><?= include 'map.php'; ?></div>
        <h3 scope="row" ">Position On Map</h3>
        <div id="map" style="width: 800px; height: 450px;margin-bottom:10px;"></div>



    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <?php elseif (isset($_GET["ip"]) && ($Domain == "Not valid")) :   ?>

            <h2 style="color:red;">This Ip is Not Found</h2> 
            <?php endif; ?> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<br>
<br>

<br>

        <?php if(isset($_GET["ip"]) && $Domain != "Not valid") : ?>
            <?php
            // if (isset($_GET["ip"])) {
                echo json_encode($json, JSON_PRETTY_PRINT);
            // }
            ?>
            <?php elseif (isset($_GET["ip"]) && ($Domain == "Not valid")) :   ?>
            <h2 style="color:red;">This ِAddress is Not Found</h2> 
            <?php endif; ?> 
