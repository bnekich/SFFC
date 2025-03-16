<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - SFFC Case Management</title>
    <link rel="stylesheet" href="//fonts.bunny.net/css?family=Nunito">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <header style="background-color: cornflowerblue; padding: 1rem;">
            <img src="images/sffc_logo.jpg" alt="Hero Image" class="img-fluid">
        </header>
        <main>
            <div>
                <section>
                    <h2>Welcome to the Case Management System</h2>
                    <p>This system is designed to help you manage your cases more efficiently.</p>
                    <p>Please <a href="login">log in</a> to continue.</p>
                </section>
            </div>
        </main>
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-muted">&copy;{{ date_format(now(), 'Y') }} Safe Families for Children
                    Wisconsin</span>
            </div>

        </footer>
    </div>
</body>

</html>
