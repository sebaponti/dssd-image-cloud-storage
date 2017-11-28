<!doctype html>
<html>
<head>
    <title>Dropbox JavaScript SDK</title>
    <link rel="stylesheet" href="/styles.css">
    <script src="/Dropbox-sdk.min.js"></script>
</head>
<body>
<header class="page-header">
    <div class="container">
        <nav>
            <a href="/">
                <h1>
                    <img src="https://cfl.dropboxstatic.com/static/images/brand/logotype_white-vflRG5Zd8.svg"
                         class="logo"/>
                </h1>
            </a>
        </nav>

        <div class="container main">
            <h2 id="results"></h2>

            <form onSubmit="return uploadFile()">
                <input type="file" id="file-upload"/>
                <button id="btn-submit" class="button" type="submit">Guardar</button>
            </form>
        </div>
    </div>
</header>
<script>
    function uploadFile() {
        var results = document.getElementById('results');
        var btn_submit = document.getElementById('btn-submit');
        btn_submit.innerText = 'Enviando';
        results.innerHTML = '';
        btn_submit.disabled = true;
        var dbx = new Dropbox({accessToken: "<?php echo getenv('ACCESS_TOKEN'); ?>"});
        var fileInput = document.getElementById('file-upload');
        var file = fileInput.files[0];
        dbx.filesUpload({path: '/' + file.name, contents: file})
            .then(function (response) {
                results.innerHTML = '';
                results.appendChild(document.createTextNode('Archivo subido! 👍'));
                console.log(response);
                btn_submit.disabled = false;
                btn_submit.innerText = 'Guardar';
                fileInput.value = "";
            })
            .catch(function (error) {
                results.appendChild(document.createTextNode('mmmm problemas 🤤'));
                console.error(error);
            });
        return false;
    }
</script>
</body>
</html>
