<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="js/social/social.js{{ config('app.link_version') }}" type="text/javascript"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        
        @yield('head')
    </head>
    <body>
        @yield('content')

    <div id="fb-root"></div>
        <div class="container" >
            <button id="fb-login">Login Here</button>
            <button id="fb-logout">Logout Here</button>
            <span id="status"/>
            <span id="message"/>
            <button id="log">Log</button>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label>Choose which page to be link</label>
                    <select class="form-control form-control-sm"" id="page-id" >
                        <option disabled selected>select a page</option>
                    </select>
        
                    <label>Whitelist current domain name</label>
                    <button id="link-page" disabled>Add</button>
                    <button id="unlink-page" disabled>Remove</button>
                    <span id="domian-list"></span>
                </div>
            </div>
        </div>
        


    </body>
</html>