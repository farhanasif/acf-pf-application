<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>ACF | Login</title>

<style>

body{
	background: #e3e3e3;
	padding-top: 10%;
}

.wdi-red{
	color: #DD3247;
}

.login-box{
	background: #fff;
	padding: 50px;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.flat-input{
	margin-bottom: 50px;
	border: none;
	border-radius: 0;
	border-bottom: 1px solid #52ae32;
	-webkit-transition: all 0.5s;
	transition: all 0.5s;
	background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 96%, #52ae32 4%);
	background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, #52ae32 4%);
	background-position: -500px 0;
	background-size: 100% 100%;
	background-repeat: no-repeat;
}
.flat-input:focus{
	box-shadow: none;
	outline: none;
	background-position: 0 0;
	border-bottom: 0px;
}

.btn-login{
	border-radius: 0;
	background: #52ae32;
	color: #fff;
	-webkit-transition: all 0.8s;
	transition: all 0.8s;
}
.btn-login:hover{
	background: transparent;
	border: 1px solid #52ae32;
	color: #52ae32;
}
</style>

  </head>
  <body>

        <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-4 col-md-auto login-box">
                {{-- <h1 class="text-center wdi-red">Login</h1> --}}
                <div class="text-center">
                  <img src="{{asset('images/logo/acf.png')}}" style="width:100px;" alt="">
                </div>
                <hr>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="form-row">
                    <div class="col-md-12">
                      <input id="email" type="email" class="form-control form-control-lg flat-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email"required autocomplete="email" autofocus>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                      <input id="password" type="password" class="form-control form-control-lg flat-input @error('password') is-invalid @enderror" name="password" placeholder="password" required autocomplete="current-password">
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                       @enderror
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-login">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>