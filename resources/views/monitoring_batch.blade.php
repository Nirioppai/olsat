@extends('components.bars')

@section('title')
<title>OLSAT | Monitoring</title>
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
    <a class="nav-link " href="/csv">
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
     -->
  <a class="custom-breadcrumb text-dark" href="/students">Students</a>
  <a>/</a>

  <a class="current-breadcrumb text-dark"><b>Result Monitoring</b></a>
</div>
@endsection

@section('content')
<table class="table align-items-center table-bordered table-striped table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th class="text-left text-dark">Batch</th>
                          <th class="text-left text-dark">Date of Examination</th>
                          <th class="text-left text-dark">Batch Upload Date</th>
                          <th class="text-left text-dark">Action</th>
                        </tr>
                      </thead>

                    @foreach($batchList as $batch)

                      <tr>
                        <td class="text-left"><a href='monitoring/{{$batch->batch}}'><b>Student Result Batch {{$batch->batch}}</b></a></td>
                        <td class="text-left">{{$batch->exam_date}}</td>
                        <td class="text-left">{{$batch->created_at}}</td>
                        <td class="text-left">

                          
                         
                          <a  type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="icon icon-shape bg-primary
                                     text-white rounded-circle shadow">
                            <i class="fas fa-cogs"></i>
                          </div>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-trash-alt"></i> Delete Batch</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-file-excel"></i> Export batch as CSV</a>
                          </div>
                        

                        </td>

                      </tr>
                        @endforeach

                  </table>
@endsection