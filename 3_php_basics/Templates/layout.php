<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Text analyzer</title>
</head>
<body>
<div class="container">
    <h1>Text analyzer</h1>
    <div class="row">
        <div class="col">
            <form method="post">
                <div class="mb-3">
                    <label for="text" class="form-label">Enter text</label>
                    <textarea name="text" id="text" class="form-control" rows="5"></textarea>
                </div>
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
    <div class="row">
        <?= $content ?>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
