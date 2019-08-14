@extends("layout")

@section('title',"My Auctions")

@section('styles')
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
@stop

@section('content')
<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading" style="color: #fbb710 !important; padding: 5px;">My Auctions</h2>
            <hr class="my-4">
          </div>
</div>      

<!-- Start Bids  section -->  
<div class="row">
          <div class="col-lg-12 mx-auto p-b-10">
            <div class="card border-0">
                <div class="card-title">
                   <h4>A list of all your auctions</h4>                  
                </div>
                <div class="card-body">
                	<div class="table-responsive m-t-40">
                	   <table id="transactions-table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                	     <thead>
                                            <tr>
                                                <th>Auction</th>
                                                <th>Amount</th>
                                                <th>Total bids</th>
                                                <th>Time left</th>
                                                <th>Status</th>
                                                <th>Highest bidder</th>
                                                <th>Date created</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@if($auctions != null && count($auctions) > 0)
                                              @foreach($auctions as $a)
                                              <?php
                    $deal = $a['deal'];
                    $images = $deal['images'];
                         shuffle($images);
                         $ird = $images[0]['url'];
                         $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird;
                    $du = url('deal')."?sku=".$deal['sku'];
                    $bp = "&#8358;".number_format($a['auction_price'],2);
                    $hb = "Unknown";
                    $hbb = (isset($a['hb'])) ? $a['hb'] : "no";
                    if($hbb != "no") $hb = $hbb->fname." ".$hbb->lname;
                    $eu = url('end-auction')."?xf=".$a['id'];
                    $deu = url('delete-auction')."?xf=".$a['id'];
                  ?>
                                                 <tr>
                                                  <td>
                                                  	<center>
                                <img src="{{$imgg}}" class="cli" data-cli="{{$du}}" alt="">
                                
                                </center><br>
                                <a href="{{$du}}">{{$deal['name']}}</a>
                                                  </td>
                                                  <td>{!! $bp !!}</td>
                                                  <td>{{$a['total-bids']}}</td>
                                                  <td>
                                                    <div id="cdc-{{$a['id']}}"></div>
                                                    <script>
	                                                    nq = new Date("{{$a['ed']}}");
                                                        getcd(nq,"cdc-{{$a['id']}}");
                                                    </script>
                                                  </td>
                                                  <td>
                                                  	@if($a['status'] == "live")
                                                  	<span class="text-primary text-bold">Live</span>
                                                      @elseif($a['status'] == "ended")
                                                      <span class="text-danger text-bold">Ended</span>
                                                      @endif
                                                  </td>	
                                                  <td>{{$hb}}</td>
                                                  <td>{{$a['date']}}</td>
                                                  <td>
                                                  	@if($a['status'] == "live")
                                                  	<a href="{{$eu}}" class="btn btn-primary btn-lg">End now</a>
                                                      @endif
                                                      <a href="{{$deu}}" class="btn btn-danger btn-lg">Delete</a>
                                                  </td>	
                                                 </tr>
                                              @endforeach
                                            @endif
                                        </tbody>
                       </table>
                    </div>
                </div>
          </div><br>
          
</div>     
<!-- End Deals  section -->  
@include('ad-space')      
       
@stop

@section('scripts')
    <!-- DataTables js -->
       <script src="lib/datatables/js/datatables.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="lib/datatables/js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="lib/datatables/js/datatables-init.js"></script>
@stop