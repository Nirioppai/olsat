@extends('components.bars')

@section('title')
<title>OLSAT | Student Info</title>
@endsection

@section('nav')
<!-- Navigation -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="/home">
      <i class="ni ni-tv-2 text-primary"></i> Dashboard
    </a>
  </li>
  <li class="nav-item active">
    <a class="nav-link active" href="/students">
      <i class="ni ni-planet text-primary"></i> Students
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/csv">
      <i class="fas fa-file-excel text-primary"></i> Upload CSV
    </a>
  </li>
  <li class="nav-item ">
    <a class="nav-link " href="/monitoring">
      <i class="ni ni-key-25 text-primary"></i> Monitoring
    </a>
  </li>
</ul>
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-dark">Administrator actions</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
  <li class="nav-item">
    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
      <i class="fas fa-user-circle"></i> Accounts
    </a>
  </li>
</ul>
@endsection

@section('breadcrumb')
<!-- Breadcrumb -->
<div>
  <!--
  <a class="custom-breadcrumb text-dark" href="/home">Dashboard</a>
  <a>/</a>
  <a class="custom-breadcrumb text-dark" href="/home">Dashboard</a>
  <a>/</a>
   -->
  <a class="current-breadcrumb text-dark">> Students</a>
</div>
@endsection

@section('content')

<div class="row mt-4">
    <div class="col-xl-4  mb-5 mb-xl-0">
        <div class="card card-profile shadow">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">

                        <img src="{{asset('./img/brand/student-img.png')}}" class="rounded-circle">

                    </div>
                </div>
            </div>

            <!-- Trigger Modal -->
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                    <a href="/studentinfo/{{$student_details->id}}/edit" class="btn btn-sm btn-default float-right ml--3" data-toggle="modal" data-target="#editProfile">Edit Profile</a>
                </div>
            </div>

            <!-- Modal   -->
              <form action="/studentinfo/{{$student_details->id}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title" id="exampleModalLabel">Edit Raw Scores</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h3>Overall Total Score:</h3>
                        <input type="number" name="overall_total_score" value="{{$student_details->overall_total_score}}" required>
                        <h3>Verbal Raw Score:</h3>
                        <input type="number" name="verbal_number_correct" value="{{$student_details->verbal_number_correct}}" required>
                        <h3>Non Verbal Raw Score:</h3>
                        <input type="number" name="non_verbal_number_correct" value="{{$student_details->non_verbal_number_correct}}" required>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>

            <div class="card-body pt-0 pt-md-4">
                <div class="text-center mt-5">
                    <h1>
                        {{$student_details->name}}
                    </h1>
                    <hr class="my-3">
                    <div class="text-left">
                        <h2>
                            Personal Details
                        </h2>
                        <span class="font-weight-bold">Student No:</span> <span class="ml-1">{{$student_details->student_id}}</span>
                        <br>
                        <span class="font-weight-bold">Birthdate:</span> <span class="ml-3">{{$student_details->date_of_birth}}</span>
                        <br>
                        <span class="font-weight-bold">Year Level:</span> <span class="ml-2">{{$student_details->grade_level}}</span>
                    </div>
                    <hr class="my-4">

                    <div class="text-left">

                        <span class="font-weight-bold">Overall Total Score:</span> <span class="ml-4">{{$student_details->overall_total_score}}</span>
                        <br>
                        <span class="font-weight-bold">Verbal Raw Score:</span> <span class="ml-5">{{$student_details->verbal_number_correct}}</span>
                        <br>
                        <span class="font-weight-bold">Non-Verbal Raw Score:</span> <span class="ml-2">{{$student_details->non_verbal_number_correct}}</span>
                    </div>



                </div>
            </div>
        </div>
    </div>

        <div class="row-sm mt-1 picture-anchor">
            <img style="width: 100%; height: 100%;" src="{{asset('./img/pdf/PDF.png')}}">
            <div class="text-1">Nirio</div>
        </div>
    </div>
</div>




@endsection
