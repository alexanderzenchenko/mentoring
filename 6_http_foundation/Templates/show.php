<?php

function showArray($array) {
    foreach ($array as $key => $value) {
        echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
    }
}

ob_start()
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>User information</h4>
            <h5>From server:</h5>
            <ul>
                <li>IP: <?= $userIp ?></li>
                <li>User agent: <?= $userAgent ?></li>
            </ul>
            <h4>Session</h4>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Key</th>
                    <th scope="col">Value</th>
                </tr>
                </thead>
                <?php
                    showArray($session);
                ?>
            </table>
            <h4>Cookies</h4>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Key</th>
                    <th scope="col">Value</th>
                </tr>
                </thead>
                <?php
                    showArray($cookies);
                ?>
            </table>
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>
