@extends("layout")

@section('title',"User Guide")
@section('content')
<div class="row">
          <div class="col-lg-12 mx-auto">
            <h2 class="section-heading">User Guide</h2>
            <hr class="my-4">
<?php
$g = [
        'dashboard' => "Your Dashboard",
        'deals' => "Deals",
        'auctions' => "Kloud Auctions",
        'kloud-pay' => "KloudPay",
        'transactions' => "Notifications",
        'orders' => "Orders & Invoices",
        'checkout' => "Carts & Checkout",
        'Coupons' => "KloudTransact Coupons",
        
      ];
      
$gc = [
        'dashboard' => "<h3 class='text-primary'>Dashboard</h3>",
        'deals' => "<h3 class='text-primary'>Deals</h3>",
        'auctions' => "<h3 class='text-primary'>Kloud Auctions</h3>",
        'kloud-pay' => "<h3 class='text-primary'>KloudPay</h3>",
        'transactions' => "<h3 class='text-primary'>Transactions</h3>",
        'orders' => "<h3 class='text-primary'>Orders & Invoices</h3>",
        'checkout' => "<h3 class='text-primary'>Carts & Checkout</h3>",
        'Coupons' => "<h3 class='text-primary'>Coupons on KloudTransact</h3>",
        
      ];
?>

<!--Start User Guide menu -->
       <ul class="nav nav-tabs" id="myTab" role="tablist">
       <li class="nav-item">
    <a class="nav-link active" id="introduction-tab" data-toggle="tab" href="#introduction" role="tab" aria-controls="introduction" aria-selected="true">Introduction</a>
  </li>
       <?php
  foreach($g as $key => $value){
  ?>
   
  <li class="nav-item">
    <a class="nav-link" id="{{$key}}-tab" data-toggle="tab" href="#{{$key}}" role="tab" aria-controls="{{$key}}" aria-selected="false">{{$value}}</a>
  </li>
  <?php
  }
  ?>  
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="introduction" role="tabpanel" aria-labelledby="introduction-tab">
  	<h3>Introduction</h3>
  </div>
  <?php
  foreach($gc as $key => $value){
  ?>   
  <div class="tab-pane fade show" id="{{$key}}" role="tabpanel" aria-labelledby="{{$key}}-tab">
  	{!! $value !!}
  </div>
  <?php
  }
  ?>
</div>
     <!--End User Guide menu -->
</div>
</div><br><br>
@include('ad-space')   
@stop