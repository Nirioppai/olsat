@extends('components.bars') @section('title')
<title>OLSAT | Upload CSV</title>
@endsection @section('nav')
<!-- Navigation -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/home">
        <i class="ni ni-tv-2 text-primary"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="/students">
        <i class="ni ni-planet text-primary"></i> Students
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link active" href="/csv">
        <i class="fas fa-file-excel text-primary"></i> OLSAT References
        </a>
    </li>
</ul>
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-dark">Administrator actions</h6>
<!-- Navigation -->
<ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="/home/register">
        <i class="fas fa-user-circle"></i> Accounts
      </a>
    </li>
  </ul>
  
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="/home/history">
        <i class="fas fa-history"></i> Action Log
      </a>
    </li>
  </ul>
@endsection @section('breadcrumb')
<!-- Breadcrumb -->
<div>
    <!--
        <a class="custom-breadcrumb text-dark" href="/home">Dashboard</a>
        <a>/</a>
        <a class="custom-breadcrumb text-dark" href="/home">Dashboard</a>
        <a>/</a>
         -->
    <a class="current-breadcrumb text-dark">> Upload CSV</a>
</div>
@endsection
@section('content')
<div class="container">
    <!-- Vertical Steppers -->
    <div class="row mt-1">
        <div class="col-md-12">
            <!-- Stepers Wrapper -->
            <ul class="stepper stepper-vertical mt--5">
                <!-- Scaled Score Step 1 -->
                <li @if($step == 1.1) class="active" @endif>
                <a>
                <span class="circle">1.1</span>
                <span class="label">Raw Score to Scaled Score - Upload</span>
                </a>
                @if($uploader == 'scaled_scores_1')
                <div class="step-content grey lighten-3">
                    <p>First, choose a Raw Score to Scaled Score file and then upload it on the system by clicking on Submit.</p>
                </div>
                @if($warning == true)
                  <div class="step-content grey lighten-3">
                      <strong><p>THERE WAS AN ERROR AT RAW SCORE {{$get_raw}}</p></strong>
                  </div>
                @endif
                <div class="container">
                    <div class="row">
                        <!-- Form open here -->
                        <div class="input-group down ml-5 col-sm-7">
                            <div class="custom-file down">
                                <form method="POST" action="{{ route('uploadScaledScore2') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div hidden class="input-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                <input type="checkbox" name="header" checked> File contains header row?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" class="custom-file-input down" id="inputGroupFile04" name="csv_file" required>
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                    @if ($errors->has('csv_file'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="input-group-append">
                            <button class="btn btn-primary up" type="submit">Submit</button>
                            </div>
                        </div>
                        </form>
                        <div class="col-sm">
                            <form action="{{ route('uploadSAI1') }}" method="GET">
                                <button type="submit" class="btn btn-outline-primary">
                                Skip this step
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                </li>
                <!-- Scaled Score Step 2 -->
                <li @if($step == 1.2) class="active" @endif>
                <a>
                <span class="circle">1.2</span>
                <span class="label">Raw Score to Scaled Score - Preview</span>
                </a>
                @if($uploader == 'scaled_scores_2')
                <div class="step-content grey lighten-3">
                    <p>Next, you can look at a preview of what is the data inside the uploaded CSV.</p>
                </div>
                <form method="POST" action="{{ route('uploadScaledScore3') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                    <div class="ml-5">
                        <!-- Table here pliz, yung na aadjust na table ty -->
                        <div class="row-md-5">
                            <div class="container py-3">
                                <div class="row py-0">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card rounded shadow border-8">
                                            <div class="card-body p-4 bg-white rounded">
                                                <div class="table-responsive">
                                                    <table id="example" style="width:100%" class="table table-striped table-bordered">
                                                        <thead>
                                                            @if(isset($csv_header_fields))
                                                            <tr>
                                                                @foreach($csv_header_fields as $csv_header_field)
                                                                <th class="text-center"> {{ $csv_header_field }}</th>
                                                                @endforeach
                                                            </tr>
                                                            @endif
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($csv_data as $row)
                                                            <tr>
                                                                @foreach ($row as $key => $value)
                                                                <td align="center" >{{ $value }}</td>
                                                                @endforeach
                                                            </tr>
                                                            @endforeach
                                                            @foreach ($csv_data[0] as $key => $value)
                                                            <td align="center">
                                                                <select class="selectionToUpper" name="fields[{{ $key }}]">
                                                                @foreach (config('app.db_raw_to_scaleds') as $db_raw_to_scaled)
                                                                <option value="{{ (\Request::has('header')) ? $db_raw_to_scaled : $loop->index }}"
                                                                @if ($key === $db_raw_to_scaled) selected @endif>{{ $db_raw_to_scaled }}</option>
                                                                @endforeach
                                                                </select>
                                                            </td>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End table -->
                    </div>
                    <div class="step-content grey lighten-3">
                        <p>If the column data is not aligned with the column headers, feel free to rearrange using their dedicated dropdowns and assign them accordingly.</p>
                        <p>You may click on Continue if everything checks out.</p>
                    </div>
                    <div class="ml-6">
                        <button onclick="this.disabled=true; this.form.submit();" type="submit" class="btn btn-primary">
                        Continue
                        </button>
                    </div>
                </form>
                @endif
                </li>
                <!-- Scaled Score Step 3 -->
                <li @if($step == 1.3) class="active" @endif>
                <a>
                <span class="circle">1.3</span>
                <span class="label">Raw Score to Scaled Score - Confirmation</span>
                </a>
                @if($uploader == 'scaled_scores_3')
                <div class="step-content grey lighten-3">
                    <p>Proceed to <b>Scaled Score to School Ability Index (SAI)</b> uploading?</p>
                </div>
                <div class="container ml-5">
                    <div class="row">
                        <div class="col-sm">
                            <form method="GET" action="{{ route('uploadSAI1') }}">
                                <!-- {{ csrf_field() }} -->
                                <button type="submit" class="btn btn-primary">
                                Continue
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                </li>
                @endif
                <!-- SAI Step 1 -->
                <li @if($step == 2.1) class="active" @endif>
                <a>
                <span class="circle">2.1</span>
                <span class="label">Scaled Score to School Ability Index (SAI) - Upload</span>
                </a>
                @if($uploader == 'sai_1')
                <div class="step-content grey lighten-3">
                    <p>First, choose a Scaled Score to School Ability Index (SAI) file and then upload it on the system by clicking on Submit.</p>
                </div>
                @if($warning == true)
                  <div class="step-content grey lighten-3">
                      <strong><p>THERE WAS AN ERROR AT GRADE SCORE {{$get_gradescore}}</p></strong>
                  </div>
                @endif
                <div class="container">
                    <div class="row">
                        <!-- Form open here -->
                        <div class="input-group down ml-5 col-sm-7">
                            <div class="custom-file down">
                                <form method="POST" action="{{ route('uploadSAI2') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div hidden class="input-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                <input type="checkbox" name="header" checked> File contains header row?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" class="custom-file-input down" id="inputGroupFile04" name="csv_file" required>
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                    @if ($errors->has('csv_file'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="input-group-append">
                            <button class="btn btn-primary up" type="submit">Submit</button>
                            </div>
                        </div>
                        </form>
                        <div class="col-sm">
                            <form action="{{ route('uploadStanine1') }}" method="GET">
                                <button type="submit" class="btn btn-outline-primary">
                                Skip this step
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                </li>
                @endif
                <!-- SAI Step 2 -->
                <li @if($step == 2.2) class="active" @endif>
                <a>
                <span class="circle">2.2</span>
                <span class="label">Scaled Score to School Ability Index (SAI) - Preview</span>
                </a>
                @if($uploader == 'sai_2')
                <div class="step-content grey lighten-3">
                    <p>Next, you can look at a preview of what is the data inside the uploaded CSV.</p>
                </div>
                <form method="POST" action="{{ route('uploadSAI3') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                    <div class="ml-5">
                        <!-- Table here pliz, yung na aadjust na table ty -->
                        <div class="row-md-5">
                            <div class="container py-3">
                                <div class="row py-0">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card rounded shadow border-8">
                                            <div class="card-body p-4 bg-white rounded">
                                                <div class="table-responsive">
                                                    <table id="example" style="width:100%" class="table table-striped table-bordered">
                                                        <thead>
                                                            @if(isset($csv_header_fields))
                                                            <tr>
                                                                @foreach($csv_header_fields as $csv_header_field)
                                                                <th class="text-center">{{ $csv_header_field }}</th>
                                                                @endforeach
                                                            </tr>
                                                            @endif
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($csv_data as $row)
                                                            <tr>
                                                                @foreach ($row as $key => $value)
                                                                <td align="center" >{{ $value }}</td>
                                                                @endforeach
                                                            </tr>
                                                            @endforeach
                                                            @foreach ($csv_data[0] as $key => $value)
                                                            <td align="center">
                                                                <select class="selectionToUpper" name="fields[{{ $key }}]">
                                                                @foreach (config('app.db_scaled_to_sais') as $db_scaled_to_sai)
                                                                <option value="{{ (\Request::has('header')) ? $db_scaled_to_sai : $loop->index }}"
                                                                @if ($key === $db_scaled_to_sai) selected @endif>{{ $db_scaled_to_sai }}</option>
                                                                @endforeach
                                                                </select>
                                                            </td>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End table -->
                    </div>
                    <div class="step-content grey lighten-3">
                        <p>If the column data is not aligned with the column headers, feel free to rearrange using their dedicated dropdowns and assign them accordingly.</p>
                        <p>You may click on Continue if everything checks out.</p>
                    </div>
                    <div class="ml-6">
                        <button onclick="this.disabled=true; this.form.submit();" type="submit" class="btn btn-primary">
                        Continue
                        </button>
                    </div>
                </form>
                </li>
                @endif
                <!-- SAI Step 3 -->
                <li @if($step == 2.3) class="active" @endif>
                <a>
                <span class="circle">2.3</span>
                <span class="label">Scaled Score to School Ability Index (SAI) - Confirmation</span>
                </a>
                @if($uploader == 'sai_3')
                <div class="step-content grey lighten-3">
                    <p>Proceed to <b>School Ability Index (SAI) to Percentile Rank & Stanine</b> uploading?</p>
                </div>
                <div class="container ml-5">
                    <div class="row">
                        <div class="col-sm">
                            <form method="GET" action="{{ route('uploadStanine1') }}">
                                <!-- {{ csrf_field() }} -->
                                <button type="submit" class="btn btn-primary">
                                Continue
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                </li>
                @endif
                <!-- Percentile Rank & Stanine Step 1 -->
                <li @if($step == 3.1) class="active" @endif>
                <a>
                <span class="circle">3.1</span>
                <span class="label">School Ability Index (SAI) to Percentile Rank & Stanine - Upload</span>
                </a>
                @if($uploader == 'stanine_1')
                <div class="step-content grey lighten-3">
                    <p>First, choose a School Ability Index (SAI) to Percentile Rank & Stanine file and then upload it on the system by clicking on Submit.</p>
                </div>

                @if($warning == true)
                  <div class="step-content grey lighten-3">
                      <strong><p>THERE WAS AN ERROR AT SAI {{$get_sai}}</p></strong>
                  </div>
                @endif
                <!-- Form open here -->
                <div class="input-group down ml-5 col-sm-7">
                    <div class="custom-file down">
                        <form method="POST" action="{{ route('uploadStanine2') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" class="custom-file-input down" id="inputGroupFile04" name="csv_file" required>
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            @if ($errors->has('csv_file'))
                            <span class="help-block">
                            <strong>{{ $errors->first('csv_file') }}</strong>
                            </span>
                            @endif
                    </div>
                    <div class="input-group-append">
                    <button class="btn btn-outline-primary up" type="submit">Submit</button>
                    </div>
                </div>
                <div hidden class="input-group">
                <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                <label>
                <input type="checkbox" name="header" checked> File contains header row?
                </label>
                </div>
                </div>
                </div>
                <!-- Form Close here -->
                </form>
                @endif
                </li>
                <!-- Percentile Rank & Stanine Step 2 -->
                <li @if($step == 3.2) class="active" @endif>
                <a>
                <span class="circle">3.2</span>
                <span class="label">School Ability Index (SAI) to Percentile Rank & Stanine - Preview</span>
                </a>
                @if($uploader == 'stanine_2')
                <div class="step-content grey lighten-3">
                    <p>Next, you can look at a preview of what is the data inside the uploaded CSV.</p>
                </div>
                <form method="POST" action="{{ route('uploadStanine3') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                    <div class="ml-5">
                        <!-- Table here pliz, yung na aadjust na table ty -->
                        <div class="row-md-5">
                            <div class="container py-3">
                                <div class="row py-0">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="card rounded shadow border-8">
                                            <div class="card-body p-4 bg-white rounded">
                                                <div class="table-responsive">
                                                    <table id="example" style="width:100%" class="table table-striped table-bordered">
                                                        <thead>
                                                            @if(isset($csv_header_fields))
                                                            <tr>
                                                                @foreach($csv_header_fields as $csv_header_field)
                                                                <th class="text-center">{{ $csv_header_field }}</th>
                                                                @endforeach
                                                            </tr>
                                                            @endif
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($csv_data as $row)
                                                            <tr>
                                                                @foreach ($row as $key => $value)
                                                                <td align="center" >{{ $value }}</td>
                                                                @endforeach
                                                            </tr>
                                                            @endforeach
                                                            @foreach ($csv_data[0] as $key => $value)
                                                            <td align="center">
                                                                <select class="selectionToUpper" name="fields[{{ $key }}]">
                                                                @foreach (config('app.db_sai_to_percentile_ranks') as $db_sai_to_percentile_rank)
                                                                <option value="{{ (\Request::has('header')) ? $db_sai_to_percentile_rank : $loop->index }}"
                                                                @if ($key === $db_sai_to_percentile_rank) selected @endif>{{ $db_sai_to_percentile_rank }}</option>
                                                                @endforeach
                                                                </select>
                                                            </td>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End table -->
                    </div>
                    <div class="step-content grey lighten-3">
                        <p>If the column data is not aligned with the column headers, feel free to rearrange using their dedicated dropdowns and assign them accordingly.</p>
                        <p>You may click on Continue if everything checks out.</p>
                    </div>
                    <div class="ml-6">
                        <button onclick="this.disabled=true; this.form.submit();" type="submit" class="btn btn-primary">
                        Continue
                        </button>
                    </div>
                </form>
                @endif
                </li>
                <!-- Percentile Rank & Stanine Step 3 -->
                <li @if($step == 3.3) class="active" @endif>
                <a>
                <span class="circle">3.3</span>
                <span class="label">School Ability Index (SAI) to Percentile Rank & Stanine - Confirmation</span>
                </a>
                @if($uploader == 'stanine_3')
                <div class="step-content grey lighten-3">
                    <p>Finalize <b>Percentile Rank & Stanine</b> uploading?</p>
                </div>
                <div class="container ml-5">
                    <div class="row">
                        <div class="col-sm">
                          <form method="GET" action="{{ route('csv') }}">
                                <button type="submit" class="btn btn-primary">
                                Continue
                                </button>
                          </form>
                        </div>
                    </div>
                </div>
                </li>
                @endif
            </ul>
            <!-- /.Stepers Wrapper -->
        </div>
    </div>
    <!-- /.Vertical Steppers -->
</div>
@if(session('success'))
<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr["success"]("CSV Import successful.", "Success ")
    });
</script>
@endif
@endsection
