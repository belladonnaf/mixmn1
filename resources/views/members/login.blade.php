@extends('layouts.simple')

@section('content')
<!-- Page Content -->
<div class="row no-gutters justify-content-center bg-body-dark">
    <div class="hero-static col-sm-10 col-md-8 col-xl-6 d-flex align-items-center p-2 px-sm-0">
        <!-- Sign In Block -->
        <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-image" style="background-image: url('assets/media/photos/photo20@2x.jpg');">
            <div class="row no-gutters">
                <div class="col-md-6 order-md-1 bg-white">
                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                        <!-- Header -->
                        <div class="mb-2 text-center">
                            <a class="link-fx font-w700 font-size-h1" href="index.html">
                                <span class="text-dark">MIX</span><span class="text-primary">mn1</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">Sign In</p>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-signin" action="be_pages_auth_all.html" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-alt" id="login-username" name="login-username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-alt" id="login-password" name="login-password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-hero-primary">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                </button>
                            </div>
                        </form>
                        <!-- END Sign In Form -->
                    </div>
                </div>
                <div class="col-md-6 order-md-0 bg-primary-dark-op d-flex align-items-center">
                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                        <div class="media">
                            <a class="img-link mr-3" href="javascript:void(0)">
                                <img class="img-avatar img-avatar-thumb" src="assets/media/avatars/avatar13.jpg" alt="">
                            </a>
                            <div class="media-body">
                                <p class="text-white font-w600 mb-1">
                                    Total running date {{ var_dump($site_status) }}
                                </p>
                                <a class="text-white-75 font-w600" href="javascript:void(0)">Jose Wagner, Web Developer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sign In Block -->
    </div>
</div>
<!-- END Page Content -->
@endsection
