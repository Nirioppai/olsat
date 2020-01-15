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
  <li class="nav-item">
    <a class="nav-link " href="/students">
      <i class="ni ni-planet text-primary"></i> Students
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="/csv">
      <i class="fas fa-file-excel text-primary"></i> Upload CSV
    </a>
  </li>
  <li class="nav-item active">
    <a class="nav-link active" href="/monitoring">
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
  <a class="current-breadcrumb text-dark">> Monitoring</a>
</div>
@endsection

@section('content')

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="/monitoring">Total Score</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="/monitoring/verbal">Verbal Score</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/monitoring/nonverbal">Non-Verbal Score</a>
  </li>
</ul>

<div class="col">

    <div class="row-md-8">


      </div>
      <div class="input-group">

           <input type="search" name="search" id="search" placeholder="Search Here" aria-describedby="button-addon8" class="form-control">
           <div class="input-group-append">
             <button id="button-addon8" type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
           </div>

         </div>


    </div>

    <div class="row-md-5">


      <div class="container py-3">

<div class="row py-0">
  <div class="col-lg-12 mx-auto">
    <div class="card rounded shadow border-8">
      <div class="card-body p-4 bg-white rounded">
        <div class="table-responsive">

          <table id="example" style="width:100%" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="th-lg"><a href="">Student Number<i class="fas fa-sort ml-1"></a></i></th>
                <th class="th-lg"><a href="">Name<i class="fas fa-sort ml-1"></a></i></th>
                <th class="th-lg"><a href="">Verbal Raw Score<i class="fas fa-sort ml-1"></a></i></th>
                <th class="th-lg"><a href="">Verbal Scaled Score<i class="fas fa-sort ml-1"></a></i></th>
                <th class="th-lg"><a href="">Verbal SAI<i class="fas fa-sort ml-1"></a></i></th>
                <th class="th-lg"><a href="">Verbal Percentile Rank<i class="fas fa-sort ml-1"></a></i></th>
                <th class="th-lg"><a href="">Verbal Stanine<i class="fas fa-sort ml-1"></a></i></th>

                <th class="th-lg"><a href="">Action</a></th>
              </tr>
            </thead>
            <tbody class="search_row">
              @include('pagination_data')

              <!-- <tr>

                <td><a href="">2018-02454</a></td>
                <td><a href="">Recierdo</a></td>
                <td><a href="">Rafael John</a></td>
                <td><a href="">12-08-1999</a></td>
                <td><a href="">Grade 9</a></td>

              </tr>
              <tr>
                <td>2018-45353</td>
                <td>Del Rosario</td>
                <td>Nico</td>
                <td>12-05-2000</td>
                <td>Grade 7</td>

              </tr>
              <tr>
                <td>2018-65492</td>
                <td>Pinggoy</td>
                <td>Dennise</td>
                <td>07-02-2003</td>
                <td>Grade 8</td>

              </tr>
              <tr>
                <td>2018-78210</td>
                <td>Velarde</td>
                <td>Prince</td>
                <td>08-23-2001</td>
                <td>Grade 9</td>
              </tr> -->

            </tbody>
          </table>
          <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

        </div>
      </div>
    </div>
  </div>
</div>
</div>


      </div>



</div>


@endsection


@section('monitoring_verbal')

  <script>

    $(document).ready(function(){

     function fetch_data(page, query)
     {
      $.ajax({
       url:"/monitoring/verbal/fetch_data?page="+page+"&query="+query,
       success:function(data)
       {
        $('.search_row').html('');
        $('.search_row').html(data);
       }
      })
     }

     $(document).on('keyup', '#search', function(){
      var query = $('#search').val();
      var page = $('#hidden_page').val();
      fetch_data(page, query);
     });

     $(document).on('click', '.pagination a', function(event){
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      $('#hidden_page').val(page);

      var query = $('#search').val();

      $('li').removeClass('active');
            $(this).parent().addClass('active');
      fetch_data(page, query);
     });

    });
  </script>


@endsection