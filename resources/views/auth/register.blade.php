@extends('layouts.base')

@section('body')

    <section id="main" class="clearfix user-page">
        <div class="container">
            <div class="row text-center">
               <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <!-- user-login -->         
               
                    <div class="user-account">
                        <h2>Create an Account</h2>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input name="firstName" type="text" class="form-control" placeholder="First name" required>
                            </div>
                            <div class="form-group">
                                <input name="lastName" type="text" class="form-control" placeholder="Last name" required>
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control" placeholder="Email Id" required>
                            </div>
                            <div class="form-group">
                                <input name="mobile"  type="text" class="form-control" placeholder="Mobile Number" required>
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required>
                            </div>                 
                            <button type="submit" class="btn">Sign up</button>    
                        </form>
                        <!-- checkbox -->
                        </div>                
                    </div>
                </div><!-- user-login -->           
            </div><!-- row -->  
        </div><!-- container -->
    </section><!-- signup-page -->
                

@endsection
