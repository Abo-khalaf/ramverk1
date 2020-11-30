
<br>
<br>
<h1 class="ip">Validate IP address</h1>

<a style="float: right;" href="http://localhost:8080/dbwebb/ramverk1/me/redovisa/htdocs/"><button class="pl1">Back</button></a>
<br>

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
                </tr> -->
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
               <tr>
                    <th  scope="row">Type: </th>
                    <td id="ip"><?=$address["type"]?></td>
                </tr>               <tr>
                    <th  scope="row">Continent: </th>
                    <td id="ip"><?=$address["continent_name"]?></td>
                </tr>                <tr>
                    <th  scope="row">Country Code: </th>
                    <td id="ip"><?=$address["country_code"]?></td>
                </tr>                <tr>
                    <th  scope="row">Country Name: </th>
                    <td id="ip"><?=$address["country_name"]?></td>
                </tr>
                </tr>                <tr>
                    <th  scope="row">City: </th>
                    <td id="ip"><?=$address["city"]?></td>
                </tr>
                </tr>                <tr>
                    <th  scope="row">zip: </th>
                    <td id="ip"><?=$address["zip"]?></td>
                </tr>
                </tr>                <tr>
                    <th  scope="row">country Flag: </th>
                    <td id="ip"><img src="<?= $address['location']['country_flag']?>"  width="50" height="30"></td>
                </tr>



                </tbody>
            </thead>
        </table>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <?php elseif (isset($_GET["ip"]) && ($Domain == "Not valid")) :   ?>
            <h2 style="color:red;">This Ip is Not Found</h2> 
            <?php endif; ?> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>