<?php ob_start() ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>Fill the form:</h4>
            <p>Stores your data in session or cookies.</p>
            <form action="/" method="POST">
                <div class="form-group">
                    <label for="postName">Name:</label>
                    <input id="postName" name="name" type="text" value="<?= $name ?>"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="postEmail">Email:</label>
                    <input id="postEmail" name="email" type="email" value="<?= $email ?>"  class="form-control">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="useSessionOrCookies" id="useSession" value="session"
                            <?= $useSessionOrCookies === 'session' || !$useSessionOrCookies ? 'checked' : '' ?>
                        >
                        <label class="form-check-label" for="useSession">
                            Use session
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="useSessionOrCookies" id="useCookies" value="cookies"
                            <?= $useSessionOrCookies === 'cookies' ? 'checked' : '' ?>
                        >
                        <label class="form-check-label" for="useCookies">
                            Use cookies
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>
