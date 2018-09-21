@extends('layouts.backend')

<link rel="stylesheet" href="{{ mix('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ mix('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Settings _ UI</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">UI</li>
                    </ol>
                </nav>
            </div>
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            <i class="si si-briefcase mr-1"></i> Choose Your First Page
        </h2>

        <div class="row justify-content-center">

           <div class="col-md-6 col-xl-3">
              <div class="block block-rounded text-center">
                  <div class="block-content block-content-full bg-info">
                      <div class="my-3">
                          <i class="fa fa-2x fa-thumbs-up text-white-75"></i>
                      </div>
                  </div>
                  <div class="block-content block-content-full block-content-sm bg-body-light">
                      <div class="font-w600">Recommended</div>
                      <div class="font-size-sm text-muted">Good to Listener</div>
                  </div>
                  <div class="block-content block-content-full">
                      <a class="btn btn-sm btn-light" href="{{route('settings.set-ui')}}?fav=1">
                          <i class="fa fa-briefcase text-muted mr-1"></i> Choose This
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="block block-rounded text-center">
                  <div class="block-content block-content-full bg-danger">
                      <div class="my-3">
                          <i class="fa fa-2x fa-server text-white-75"></i>
                      </div>
                  </div>
                  <div class="block-content block-content-full block-content-sm bg-body-light">
                      <div class="font-w600">Archive</div>
                      <div class="font-size-sm text-muted">Good to Mania</div>
                  </div>
                  <div class="block-content block-content-full">
                      <a class="btn btn-sm btn-light" href="{{route('settings.set-ui')}}?fav=2">
                          <i class="fa fa-briefcase text-muted mr-1"></i> Choose This
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="block block-rounded text-center">
                  <div class="block-content block-content-full bg-warning">
                      <div class="my-3">
                          <i class="fa fa-2x fa-search text-white-75"></i>
                      </div>
                  </div>
                  <div class="block-content block-content-full block-content-sm bg-body-light">
                      <div class="font-w600">Searching</div>
                      <div class="font-size-sm text-muted">Good to Expert</div>
                  </div>
                  <div class="block-content block-content-full">
                      <a class="btn btn-sm btn-light" href="{{route('settings.set-ui')}}?fav=3">
                          <i class="fa fa-briefcase text-muted mr-1"></i> Choose This
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="block block-rounded text-center">
                  <div class="block-content block-content-full bg-success">
                      <div class="my-3">
                          <i class="fa fa-2x fa-star text-white-75"></i>
                      </div>
                  </div>
                  <div class="block-content block-content-full block-content-sm bg-body-light">
                      <div class="font-w600">Favorites</div>
                      <div class="font-size-sm text-muted">Good to General</div>
                  </div>
                  <div class="block-content block-content-full">
                      <a class="btn btn-sm btn-light" href="{{route('settings.set-ui')}}?fav=4">
                          <i class="fa fa-briefcase text-muted mr-1"></i> Choose This
                      </a>
                  </div>
              </div>
          </div>

        </div>
    </div>
    <!-- END Page Content -->
@endsection
<!-- Page JS Plugins -->
<script src="{{ mix('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ mix('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ mix('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ mix('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ mix('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ mix('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ mix('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ mix('js/pages/be_tables_datatables.min.js') }}"></script>

