@extends('components.bars') @section('title')
<title>OLSAT | Total Score Info</title>
@endsection @section('nav')
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
     -->
  <a class="custom-breadcrumb text-dark" href="/students">Students</a>
  <a>/</a>

  <a class="custom-breadcrumb text-dark" href="/students/monitoring">Student Batch List</a>
  <a>/</a>

  <a class="custom-breadcrumb text-dark" href="/students/monitoring/{{$total_score_details->batch}}">Student Batch Results</a>
  <a>/</a>

  <a class="current-breadcrumb text-dark"><b>Individual Result</b></a>



</div>
@endsection @section('content')

<!-- Modal -->
<div class="modal fade" id="RemarksModal" tabindex="-1" role="dialog" aria-labelledby="RemarksModalLabel" aria-hidden="true">
  <form action="/students/monitoring/totalinfo/remark-update" method="POST">
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="editModalLabel">Edit Student Remark</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
              <div class="input-group mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-comment"></i></span>
                  </div>
                  <input class="form-control" name="student_remark" placeholder="Update student Remark" type="text" required>

              </div>
              <input type="hidden" name="student_id" value="{{$total_score_details->student_id}}">
          </div>
      </div>
      <div class="modal-footer mt--5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</form>
</div>

<form action="/students/monitoring/totalinfo/{{$total_score_details->id}}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="editModalLabel">Edit Student Raw Scores</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mt--3">

          <!-- <div class="form-group">
            Total
              <div class="input-group mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                  </div>
                  <input class="form-control" name="overall_total_score" value="{{$total_score_details->total_raw}}" type="number" required>
              </div>
          </div> -->
          <div class="form-group">
            <h1>Total Score: {{$total_score_details->total_raw}}</h1>
            <br>
            <h2>Verbal Total Score: {{$total_score_details->verbal_raw}}</h2>
          </div>
          <div class="form-group">
            Verbal Comprehension
              <div class="input-group mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                  </div>
                  <input class="form-control" name="verbal_comprehension" value="{{$total_score_details->verbal_comprehension}}" type="number" required>
              </div>
          </div>
          <div class="form-group">
            Verbal Reasoning
              <div class="input-group mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                  </div>
                  <input class="form-control" name="verbal_reasoning" value="{{$total_score_details->verbal_reasoning}}" type="number" required>
              </div>
          </div>

          <div class="form-group">
            <h2>Non-verbal Total Score: {{$total_score_details->nonverbal_raw}}</h2>
          </div>
          <div class="form-group">
            Quantitative Reasoning
              <div class="input-group mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                  </div>
                  <input class="form-control" name="quantitative_reasoning" value="{{$total_score_details->quantitative_reasoning}}" type="number" required>
              </div>
          </div>
          <div class="form-group">
            Figural Reasoning
              <div class="input-group mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                  </div>
                  <input class="form-control" name="figural_reasoning" value="{{$total_score_details->figural_reasoning}}" type="number" required>
              </div>
          </div>

        </div>
        <div class="modal-footer mt--5">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

</form>

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
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                    <a href="/students/monitoring/totalinfo/{{$total_score_details->id}}/edit" class="btn btn-sm btn-default float-right ml--3" data-toggle="modal" data-target="#editModal">Edit Scores</a>
                </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
                <div class="text-center mt-5">
                    <h1>
                        {{$total_score_details->student_name}}
                    </h1>
                    <hr class="my-3">
                    <div class="text-left">
                        <h2>
                            Personal Details
                        </h2>
                        <span class="font-weight-bold">Student No:</span> <span class="ml-1">{{$total_score_details->student_id}}</span>
                        <br>
                        <span class="font-weight-bold">Grade Level:</span> <span class="ml-1">{{$total_score_details->grade}}</span>
                        <br>
                        <span class="font-weight-bold">Grade Level:</span> <span class="ml-1">{{$total_score_details->section}}</span>
                        <br>
                        <br>
                        <span class="font-weight-bold">Birthdate:</span> <span class="ml-1">{{$total_score_details->birthday}}</span>
                        <br>
                        <span class="font-weight-bold">Age in Years:</span> <span class="ml-1">{{$total_score_details->rounded_current_age_in_years}}</span>
                        <br>
                        <span class="font-weight-bold">Age in Months:</span> <span class="ml-1">{{$total_score_details->rounded_current_age_in_months}}</span>
                        <br>
                        <span class="font-weight-bold">Exam Date:</span> <span class="ml-1">{{$total_score_details->exam_date}}</span>

                    </div>
                    <hr class="my-4">

                    <div class="text-left">

                        <span class="font-weight-bold">Overall Total Score:</span> <span class="ml-4">{{$total_score_details->total_raw}}</span>
                        <br>
                        <span class="font-weight-bold">Verbal Raw Score:</span> <span class="ml-5">{{$total_score_details->verbal_raw}}</span>
                        <br>
                        <span class="font-weight-bold">Non-Verbal Raw Score:</span> <span class="ml-2">{{$total_score_details->nonverbal_raw}}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="row-sm">
            <div class="card shadow">
                <div class="card-body pt-0 pt-md-4">
                    <h2>
                        Remarks
                    </h2>
                    @if($student_remark)
                    {{$student_remark}}
                    @endif


                    @if(!$student_remark)
                    No remarks available. Click on edit to add one now.
                    @endif


                    <div class="col text-right">



                    <a href=""  class="btn btn-primary btn-rounded "data-toggle="modal" data-target="#RemarksModal">Edit</a>


                    </div>

                </div>


            </div>
        </div>
        <div class="row-sm mt-4">
            <div class="card shadow">
                <div class="card-body pt-0 pt-md-4">
                    <h2>
                        <form id="savePDF" action="{{ route('savePDF') }}" method="post">
                        @csrf
                        Student Result Report
                        <input type="hidden" name="student_no" value="{{$total_score_details->student_id}}"></input>
                        <a data-toggle="tooltip" data-placement="top" data-html="true" title="<b>Save</b> a PDF copy." href="javascript:$('#savePDF').submit()"  class=" float-right"><i class="fas fa-file-pdf text-red"></i> PDF</a>
                        </form>
                    </h2>
                    Below is a preview for the Student Result Report. You can export it using the icons on the upper right. For a preview, click on the document below to expand.
                </div>


            </div>
        </div>
        <form id="viewPDF" action="{{ route('viewPDF') }}" method="post">
        @csrf
        <input  type="hidden" name="student_no" value="{{$total_score_details->student_id}}"></input>
        <a href="javascript:$('#viewPDF').submit()">
        <div data-toggle="tooltip" data-placement="top" data-html="true" title="<b>Generate</b> a PDF preview." class="row-sm mt-4 picture-anchor" target="_blank">
            <img  style="width: 100%; height: 100%;" src="{{asset('./img/pdf/PDF.png')}}">
            </a>
            <div class="text-2">{{$total_score_details->student_name}}</div>
            <div class="text-3">{{$total_score_details->grade}}-{{$total_score_details->section}}</div>
            <div class="text-4">Xavier School San Juan</div>
            <div class="text-5"></div>
            <div class="text-6">{{$total_score_details->exam_date}}</div>
            <div class="text-7">{{$total_score_details->birthday}}</div>
            <div class="text-8">{{$total_score_details->rounded_current_age_in_years}}.{{$total_score_details->rounded_current_age_in_months}}</div>
            <div class="text-9">{{$total_score_details->verbal_raw}}</div>
            <div class="text-10">{{$total_score_details->nonverbal_raw}}</div>
            <div class="text-11">{{$total_score_details->total_raw}}</div>
            <div class="text-12">{{$total_score_details->verbal_scaled}}</div>
            <div class="text-13">{{$total_score_details->nonverbal_scaled}}</div>
            <div class="text-14">{{$total_score_details->total_scaled}}</div>
            <div class="text-15">{{$total_score_details->verbal_sai}}</div>
            <div class="text-16">{{$total_score_details->nonverbal_sai}}</div>
            <div class="text-17">{{$total_score_details->total_sai}}</div>
            <div class="text-18">{{$total_score_details->verbal_percentile}}</div>
            <div class="text-19">{{$total_score_details->nonverbal_percentile}}</div>
            <div class="text-20">{{$total_score_details->total_percentile}}</div>
            <div class="text-21">{{$total_score_details->verbal_stanine}}</div>
            <div class="text-22">{{$total_score_details->nonverbal_stanine}}</div>
            <div class="text-23">{{$total_score_details->total_stanine}}</div>
            <div class="text-24">{{$total_score_details->verbal_classification}}</div>
            <div class="text-25">{{$total_score_details->nonverbal_classification}}</div>
            <div class="text-26">{{$total_score_details->total_classification}}</div>

            <div class="text-27">{{$total_score_details->verbal_comprehension}}</div>
            <div class="text-28">{{$total_score_details->verbal_reasoning}}</div>
            <div class="text-29">{{$total_score_details->figural_reasoning}}</div>
            <div class="text-30">{{$total_score_details->quantitative_reasoning}}</div>
        </div>

        </form>

    </div>
</div>

@endsection
