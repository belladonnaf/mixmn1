<aside id="side-overlay">
    <!-- Side Header -->
    <div class="bg-image" style="background-image: url('/media/various/bg_side_overlay_header.jpg');">
        <div class="bg-primary-op">
            <div class="content-header">
                <!-- User Avatar -->
                <a class="img-link mr-1" href="be_pages_generic_profile.html">
                    <img class="img-avatar img-avatar48" src="/media/avatars/avatar10.jpg" alt="">
                </a>
                <!-- END User Avatar -->
<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

$sql = " select useremailid, service_enddate, favor_ui, favor_genre from members where  user_pk = ? ";
$row_user = DB::select($sql,[Request()->session()->get("login_id")])[0];

$sql = " call get_user_log(?) ";
$arr_log = DB::select($sql,[Request()->session()->get("login_id")]);
?>
				
                <!-- User Info -->
                <div class="ml-2">
                    <a class="text-white font-w600" href="be_pages_generic_profile.html">{{$row_user->useremailid}}</a>
                    <div class="text-white-75 font-size-sm font-italic">{{$row_user->service_enddate}}</div>
                </div>
                <!-- END User Info -->

                <!-- Close Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="ml-auto text-white" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                    <i class="fa fa-times-circle"></i>
                </a>
                <!-- END Close Side Overlay -->
            </div>
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Side Content -->
    <div class="content-side" id="right-sidebar">
        <!-- Side Overlay Tabs -->
        <div class="block block-transparent pull-x pull-t">
            <ul class="nav nav-tabs nav-tabs-block nav-justified" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#so-settings">
                        <i class="fa fa-fw fa-cog"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#so-people">
                        <i class="far fa-fw fa-user-circle"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#so-profile">
                        <i class="far fa-fw fa-edit"></i>
                    </a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <!-- Settings Tab -->
                <div class="tab-pane pull-x fade fade-up show active" id="so-settings" role="tabpanel">
                    <div class="block mb-0">
                        <!-- Color Themes -->
                        <!-- Toggle Themes functionality initialized in Template._uiHandleTheme() -->
                        <div class="block-content block-content-sm block-content-full bg-body">
                            <span class="text-uppercase font-size-sm font-w700">Choose Intro Page</span>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny text-center">

                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 text-white font-size-sm font-w600 bg-default sel-ui <?php if($row_user->favor_ui == 1){ echo 'active'; } ?>" href="#" data-value="1">
                                        Recommended
                                    </a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 text-white font-size-sm font-w600 bg-xeco sel-ui <?php if($row_user->favor_ui == 2){ echo 'active'; } ?>" href="#" data-value="2">
                                        Archives
                                    </a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 text-white font-size-sm font-w600 bg-xsmooth sel-ui <?php if($row_user->favor_ui == 3){ echo 'active'; } ?>" href="#" data-value="3">
                                        Search
                                    </a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 text-white font-size-sm font-w600 bg-xinspire sel-ui <?php if($row_user->favor_ui == 4){ echo 'active'; } ?>" href="#" data-value="4">
                                        Favorites
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- END Color Themes -->

                        <!-- Sidebar -->
                        <div class="block-content block-content-sm block-content-full bg-body">
                            <span class="text-uppercase font-size-sm font-w700">Choose Genre For Recommend</span>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny text-center">
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 bg-body-dark font-w600 text-dark sel-genre <?php if($row_user->favor_genre == 1){ echo 'active'; } ?>" href="#" data-value="1">EDM Music</a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 bg-body-dark font-w600 text-dark sel-genre <?php if($row_user->favor_genre == 2){ echo 'active'; } ?>" href="#" data-value="2">Hip Hop</a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 bg-body-dark font-w600 text-dark sel-genre <?php if($row_user->favor_genre == 3){ echo 'active'; } ?>" href="#" data-value="3">Easy Listening</a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 bg-body-dark font-w600 text-dark sel-genre <?php if($row_user->favor_genre == 4){ echo 'active'; } ?>" href="#" data-value="4">Classical</a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 bg-body-dark font-w600 text-dark sel-genre <?php if($row_user->favor_genre == 5){ echo 'active'; } ?>" href="#" data-value="5">Pop</a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 bg-body-dark font-w600 text-dark sel-genre <?php if($row_user->favor_genre == 6){ echo 'active'; } ?>" href="#" data-value="6">Kpop</a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 bg-body-dark font-w600 text-dark sel-genre <?php if($row_user->favor_genre == 7){ echo 'active'; } ?>" href="#" data-value="7">Chanson</a>
                                </div>
                                <div class="col-6 mb-1">
                                    <a class="d-block py-3 bg-body-dark font-w600 text-dark sel-genre <?php if($row_user->favor_genre == 8){ echo 'active'; } ?>" href="#" data-value="8">Hardcore</a>
                                </div>
                            </div>
                        </div>
                        <!-- END Header -->

                    </div>
                </div>
                <!-- END Settings Tab -->

                <!-- People -->
                <div class="tab-pane pull-x fade fade-up" id="so-people" role="tabpanel">
                    <div class="block mb-0">
                        <!-- Online -->
                        <div class="block-content block-content-sm block-content-full bg-body">
                            <span class="text-uppercase font-size-sm font-w700">Online</span>
                        </div>
                        <div class="block-content">
                            <ul class="nav-items">
@foreach($arr_log as $r)
                                <li>
                                    <a class="media py-2" href="/album/{{$r->album_id}}">
                                        <div class="media-body">
                                            <div class="font-w600">{{$r->album_path}}</div>
                                            <div class="font-size-sm text-muted"><b>{{$r->genre}}</b> / {{$r->release_date}} ({{$r->file_size}}M/{{$r->file_cnt}}F)</div>
                                        </div>
                                    </a>
                                </li>
@endforeach
                            </ul>
                        </div>
                        <!-- END Offline -->

                        <!-- Add People -->
                        <div class="block-content row justify-content-center border-top">
                            <div class="col-9">
                                <a class="btn btn-block btn-hero-primary" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-plus mr-1"></i> Add People
                                </a>
                            </div>
                        </div>
                        <!-- END Add People -->
                    </div>
                </div>
                <!-- END People -->

                <!-- Profile -->
                <div class="tab-pane pull-x fade fade-up" id="so-profile" role="tabpanel">
                    <form action="be_pages_dashboard.html" method="post" onsubmit="return false;">
                        <div class="block mb-0">
                            <!-- Personal -->
                            <div class="block-content block-content-sm block-content-full bg-body">
                                <span class="text-uppercase font-size-sm font-w700">Personal</span>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" readonly class="form-control" id="staticEmail" value="Admin">
                                </div>
                                <div class="form-group">
                                    <label for="so-profile-name">Name</label>
                                    <input type="text" class="form-control" id="so-profile-name" name="so-profile-name" value="George Taylor">
                                </div>
                                <div class="form-group">
                                    <label for="so-profile-email">Email</label>
                                    <input type="email" class="form-control" id="so-profile-email" name="so-profile-email" value="g.taylor@example.com">
                                </div>
                            </div>
                            <!-- END Personal -->

                            <!-- Password Update -->
                            <div class="block-content block-content-sm block-content-full bg-body">
                                <span class="text-uppercase font-size-sm font-w700">Password Update</span>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="form-group">
                                    <label for="so-profile-password">Current Password</label>
                                    <input type="password" class="form-control" id="so-profile-password" name="so-profile-password">
                                </div>
                                <div class="form-group">
                                    <label for="so-profile-new-password">New Password</label>
                                    <input type="password" class="form-control" id="so-profile-new-password" name="so-profile-new-password">
                                </div>
                                <div class="form-group">
                                    <label for="so-profile-new-password-confirm">Confirm New Password</label>
                                    <input type="password" class="form-control" id="so-profile-new-password-confirm" name="so-profile-new-password-confirm">
                                </div>
                            </div>
                            <!-- END Password Update -->

                            <!-- Options -->
                            <div class="block-content block-content-sm block-content-full bg-body">
                                <span class="text-uppercase font-size-sm font-w700">Options</span>
                            </div>
                            <div class="block-content">
                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                    <input type="checkbox" class="custom-control-input" id="so-settings-status" name="so-settings-status" value="1">
                                    <label class="custom-control-label" for="so-settings-status">Online Status</label>
                                </div>
                                <p class="text-muted font-size-sm">
                                    Make your online status visible to other users of your app
                                </p>
                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                    <input type="checkbox" class="custom-control-input" id="so-settings-notifications" name="so-settings-notifications" value="1" checked>
                                    <label class="custom-control-label" for="so-settings-notifications">Notifications</label>
                                </div>
                                <p class="text-muted font-size-sm">
                                    Receive desktop notifications regarding your projects and sales
                                </p>
                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                    <input type="checkbox" class="custom-control-input" id="so-settings-updates" name="so-settings-updates" value="1" checked>
                                    <label class="custom-control-label" for="so-settings-updates">Auto Updates</label>
                                </div>
                                <p class="text-muted font-size-sm">
                                    If enabled, we will keep all your applications and servers up to date with the most recent features automatically
                                </p>
                            </div>
                            <!-- END Options -->

                            <!-- Submit -->
                            <div class="block-content row justify-content-center border-top">
                                <div class="col-9">
                                    <button type="submit" class="btn btn-block btn-hero-primary">
                                        <i class="fa fa-fw fa-save mr-1"></i> Save
                                    </button>
                                </div>
                            </div>
                            <!-- END Submit -->
                        </div>
                    </form>
                </div>
                <!-- END Profile -->
            </div>
        </div>
        <!-- END Side Overlay Tabs -->
    </div>
    <!-- END Side Content -->
</aside>