<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/style_sufee.css')}}">
    
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body >
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
<div class="content mt-3" style="margin-top: 3rem !important;
    margin-left: 23rem !important;">
            <div class="animated">
 <div class="row">
                    
    <div class="col-lg-6">
    <div class="card">
    <form action="{{route('login.post')}}" method="post" class="form-horizontal">
        <div class="card-header">
            <strong>Login</strong> Form
        </div>
        <div class="card-body card-block">
            
                <div class="row form-group">
                    <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Email</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="email" name="email"  class="form-control">
                    <span class="help-block">Please enter your email</span> @error('email')
                        <div style="color:red">{{$message}}</div>

                        @enderror
                </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Password</label></div>
                    <div class="col-12 col-md-9"><input type="password" id="password" name="password" class="form-control">
                    <span class="help-block">Please enter your password</span>@error('password')
                        <div style="color:red">{{$message}}</div>

                        @enderror
                </div>
                </div>
           
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
            <button type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Reset
            </button>
        </div>
        @csrf
        </form>
    </div>
                                                
    </div>
</div>
</div>
</div>
<!-- .animated -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
   
    
   