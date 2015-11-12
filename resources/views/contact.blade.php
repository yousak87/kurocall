<html>
    <head>
        <title>Contact Page</title>

        <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

        
    </head>
    <body>
        <div class="container">
            <div class="content">
                  @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
    @endforeach
                <form method="post">
                    <table>
                        <tr><td>First Name</td><td><input type="text" name="f_name" ></td></tr>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <tr><td>Last Name</td><td><input type="text" name="l_name" ></td></tr>
                        <tr><td>Email</td><td><input type="text" name="email" ></td></tr>
                        <tr><td>Password</td><td><input type="password" name="pass" ></td></tr>
                        <tr><td>Retype Password</td><td><input type="password" name="rpass" ></td></tr>
                        <tr><td>Sex</td><td><ul>
                                    <li><input type="radio" value="1" name="sex" id="sex" />
                                        <label>Male</label>
                                    </li>
                                    <li><input type="radio" value="0" name="sex" id="sex" />
                                        <label>Female</label>
                                    </li>
                                </ul></td></tr>
                        <tr><td colspan="2"><input type="submit" value="submit"></td></tr>


                    </table>

                </form>
    <a href="{{ action('PagesController@tes')}}">Home</a>
            </div>
        </div>
    </body>
</html>