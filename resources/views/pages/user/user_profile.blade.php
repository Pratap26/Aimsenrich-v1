@extends('layouts.base')

@section('body')
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	    <div class="ad-profile section">	
			<div class="user-profile">
				<div class="user-images">
					<img src="" alt="User Images" class="img-responsive">
				</div>
				<div class="user">
					<h2>Hello, <a href="profile">{{ Auth::user()->username }}</a></h2>
				</div>
			</div>
				<ul class="user-menu">
					<li class="active"><a href="profile">Profile</a></li>
					<li><a href="">Profile picture</a></li>
					<li><a href="">Enrolled Courses</a></li>
				</ul>
		</div>
		<div class="profile section">
			<div class="row">
				<div class="col-sm-8">
					<div class="user-pro-section">
						<div class="profile-details section">
							<h2>Profile Details</h2>
							<div class="form-group">
								<label>Name</label>
								<label>{{ Auth::user()->username }}</label>
							</div>
							<div class="form-group">
								<label>Email ID</label>
								<label>{{ Auth::user()->email }}</label>
							</div>
							<div class="form-group">
								<label>Mobile</label>
								<label>{{ Auth::user()->mobile }}</label>
							</div>
							<div class="form-group">
								<label>This is</label>
								<label>Student</label>
							</div>
							<div class="container">
  							    <div class="pull-left">
  									<div class="col-sm-3">
  										<div class="footer-widget news-letter">
  											<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Edit Profile</button>
										</div>
									</div>
  								</div>
  							    <div class="modal fade" id="myModal" role="dialog">
    								<div class="modal-dialog">
    									<div class="modal-content">
       				 						<div class="modal-header">
          										<button type="button" class="close" data-dismiss="modal">&times;</button>
          										<h4 class="modal-title">Edit Profile</h4>
        									</div>
        									<div class="modal-body">
							   					<div class="col-sm-12">
													<form class="form-horizontal"  method="POST" action="{{ route('updateProfile') }}">
                                             		{{ csrf_field() }}
													<div class="form-group">
														<label>Email ID</label>
														<label>{{ Auth::user()->email }}</label>
													</div>
													<div class="form-group">
														<label for="name-three">Mobile</label>
														<input type="text" class="form-control" name="mobile" value="{{ Auth::user()->mobile }}">
													</div>
													<div class="form-group">
														<label>You are a</label>
														<label>Student</label>
													</div>
													<div class="pull-right">
														<div class="col-sm-6">
															<div class="footer-widget news-letter">
																<button type="submit" class="btn btn-primary">Update</button>
															</div>
														</div>
													</div>
													</form>
										  			<div class="pull-left">
														<div class="col-sm-6">
															<div class="footer-widget news-letter">
															<form class="form-horizontal" method="GET" action="{{ route('deleteAccount') }}">
                                             				{{ csrf_field() }}
															<button type="submit" class="btn btn-warning">Delete</button>
															</form>
															</div>
														</div>
										 			</div>
													<br>
													<br>
													<HR>
													<div class="change-password section">
													<form class="form-horizontal"  method="POST" action=""{{ route('updatePassword') }}"">
                                            		 	{{ csrf_field() }}
														<div class="form-group">
															<label>New password</label>
															<input type="password" name="new_password" class="form-control" requird>	
														</div>
														<div class="pull-right">
															<div class="col-sm-12">
																<div class="footer-widget news-letter">
																	<button type="submit" class="btn btn-primary">Update password</button>
																</div>
															</div>
														</div>
													</form>															
													</div>
        										</div>
        									</div>
       									    </br>
       									    </br>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>  
                </div>
            </div>
        </div>
	</div>
</section>
@endsection