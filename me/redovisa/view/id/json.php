<h1>Validate IP address {JSON}</h1>
<form class="form-signin" method="get">
    <div >
            <input type="text" name="ip" placeholder="Your IP" required>
    </div>
    <button class="pl1"  type="submit">Validate</button>
</form>


            <?php
            if (isset($_GET["ip"])) {
                echo json_encode($json, JSON_PRETTY_PRINT);
            }
            ?>
