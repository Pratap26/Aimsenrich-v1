@extends('layouts.base')

@section('body')
    <section id="main" class="clearfix user-page">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <!-- user-login -->       
                <div class="user-account">
                    <h2>User Login</h2>
                    <!-- form -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Username" >
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Password" >
                        </div>
                        <button type="submit" class="btn">Login</button>
                    </form><!-- form -->
                
                    <!-- forgot-password -->
                    
                        <div class="pull-right forgot-password">
                            <a href="#">Forgot password</a>
                        </div>
                </div>
                <a href="register" class="btn-primary">Create a New Account</a>
            </div><!-- user-login -->           
        </div><!-- row -->  
    </div><!-- container -->
</section><!-- signin-page -->
@endsection
