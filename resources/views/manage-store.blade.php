@extends("layout")

@section('title',"Manage Store")

@section('content')
<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading">Manage Store</h2>
            <hr class="my-4">
            <h3><em>Store Management Portal</em></h3>
            <p>Manage your store information, import your products and track your sales history</p>
            <br>
            <div class="row">
            	<div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="text-primary">
            <h5 class="card-title"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">Edit/update store info</p>
            <a href="{{url('edit-store')}}" class="btn btn-primary">Manage store info</a>
            </div>
         </div>
       </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="text-warning">
            <h5 class="card-title"><i class="fa fa-money fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">Manage deals</p>
            <a href="{{url('my-deals')}}" class="btn btn-primary">Go to deals</a>
            </div>
         </div>
       </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="text-primary">
            <h5 class="card-title"><i class="fa fa-hourglass fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">View store auctions</p>
            <?php $ssurl = url('my-auctions'); ?>
            <a href="{{$ssurl}}" class="btn btn-primary">Go to auctions</a>
            </div>
         </div>
       </div>
            </div>
            </div>
            <br>
            	<?php $vurl = url('stores')."/".$store["flink"]; ?>
            	<center><a href="{{$vurl}}" target="_blank" class="amado-btn">View store as a visitor</a></center>
          </div>
        </div>
@stop