@extends("layout")

@section('title',"Add Deal")

@section('content')
<script> let cdb = "deal";</script>
<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading mt-1">Add Auction</h2>
            <hr class="my-4">
             <div class="checkout_details_area mt-50 clearfix">
                            <div class="card">                        	     
                        	     <div class="card-body">
                        	       <h3 class="card-title" style="color: #fbb710 !important; padding: 5px;">Adds a new auction listing to the system</h3>                     
                                   <h5 class="card-title" style="color: #fbb710 !important; padding: 5px;">Only auctions that are approved will be displayed on our platform</h5>                     
                                   <form action="{{url('add-auction')}}" method="post">
                                   	{!! csrf_field() !!}
                                   <input type="hidden" name="xf" value="{{$deal['id']}}" required>
                                   <input type="hidden" name="irdc" id="irdc" value="" required>
                                <div class="row">
                                    <div class="col-md-4 col-xs-12 mb-3">
                                    	<p class="form-control-plaintext text-left"> Days</p><br>
                                        <input type="number" class="form-control" id="i-d" name="days" required>
                                    </div>
                                    <div class="col-md-4 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left">Hours</p><br>
                                        <input type="number" class="form-control" id="i-h" name="hours" required>
                                    </div>
                                    <div class="col-md-4 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left">Minutes</p><br>
                                        <input type="number" class="form-control" id="i-m" name="minutes" required>                                    
                                    </div>
                                    
                                    <div class="col-md-6 col-xs-12 mb-3">
                                         <p class="form-control-plaintext text-left">Auction Price (Leave blank if it's the same with deal price) </p><br>
                                        <input type="number" class="form-control" name="auction_price">                                    
                                    </div>
                                    <div class="col-md-6 col-xs-12 mb-3">
                                         <p class="form-control-plaintext text-left">Buy it Now Price (Leave blank if it's the same with deal price) </p><br>
                                        <input type="number" class="form-control" name="buy_price">                                    
                                    </div>
                            	
                                    <div class="col-12 col-xs-12">
                                        <button type="submit" class="amado-btn">Submit</button>                                                                           
                                    </div>
                                </div>
                            </form>
                        	     </div>
                        	   </div>                           
                       
                        </div>
          </div>
@stop