
<br>
<br>
<h1>Validate IP address {JSON}</h1>
<br>


<a style="float: right;" href="http://localhost:8080/dbwebb/ramverk1/me/redovisa/htdocs/"><button class="pl1">Back</button></a>
       
<br>
    <?php if(!isset($_GET["ip"])) : ?>
    <form action="json-ip" method="GET">
                <input name="ip" type="hidden" value="194.47.150.9">
                <input type="submit" value="Test IP 2">
            </form>
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
            <?php
            // if (isset($_GET["ip"])) {
                echo json_encode($json, JSON_PRETTY_PRINT);
            // }
            ?>
            <?php elseif (isset($_GET["ip"]) && ($Domain == "Not valid")) :   ?>
            <h2 style="color:red;">This Ip is Not Found</h2> 
            <?php endif; ?> 
