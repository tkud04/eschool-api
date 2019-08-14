@extends("layout")

@section('title',"Edit Store")

@section('content')
<?php 
#$ct = (isset($category) && $category != null) ? " - ".$category : ""; 
$deals = count($store["deals"]);
$status = $store["status"];
$sc = "text-warning";
if($status == "disabled") $sc = "text-danger";
else if($status == "success") $sc = "text-success";

$img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$store['img'];
 if($store['img'] == "none") $img = "https://via.placeholder.com/150";
?>
<script> let cdb = "store";</script>
<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading mt-1">View Store Information</h2>
            <hr class="my-4">
             <div class="checkout_details_area mt-50 clearfix">
                            <div class="card">                        	     
                        	     <div class="card-body">
                        	       <h3 class="card-title" style="color: #fbb710 !important; padding: 5px;">View/edit information about your store</h3>                     
                                   
                                   <form action="{{url('edit-store')}}" method="post">
                                   	{!! csrf_field() !!}
                                   <input type="hidden" name="ird" id="ird" value="{{$store['img']}}" required>
                                   <input type="hidden" name="irdc" id="irdc" value="" required>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 mb-3">
                                    	<p class="form-control-plaintext text-left mb-1">
                                          <img src="{{$img}}" class="img-fluid"alt=""><br>
                                          <?php
                                           if($store['img'] == "none"){                                       	
                                          ?>
                                          <button id="store-upload" class="cloudinary-button">Upload new logo</button>
                                          <span id="cloudinary-loading">It usually takes a few minutes to upload images so please be patient when you click Upload above :)</span>
                                          <?php
                                           }
                                           else{
                                           $dri = url('dri')."?loc=edit-store&ird=".$store['img'];
                                          ?>
                                          <a href="{{$dri}}" class="amado-btn mb-3">Delete image</a>
                                          <?php
                                           }
                                          ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6 col-xs-12 mb-3">
                                    	<p class="form-control-plaintext text-left"><i class="fa fa-suitcase"></i> Name</p><br>
                                        <input type="text" class="form-control" placeholder="e. g Tobi's Store" name="name" value="{{$store['name']}}" required><br>
                                    </div>
                                    <div class="col-md-6 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-user"></i> Managed by</p><br>
                                        <input type="text" class="form-control" value="{{$store['user']}}" disabled>
                                    </div>
                                    <div class="col-md-4 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-star"></i> Rating</p><br>
                                        @for($s = 0; $s < $store['rating']; $s++)
                                          <i class="fa fa-star fa-2x" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                    <div class="col-md-4 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-briefcase"></i> Total Deals</p><br>
                                        <h4 class="form-control-plaintext text-primary text-left">{{$deals}}</h4>
                                        <small class="form-control-plaintext text-left">Last updated: {{$store['last_updated']}}</h4>
                                    </div>
                                    <div class="col-md-4 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-star"></i> Friendly URL</p><br>
                                        <input type="text" class="form-control" placeholder="Friendly store url e.g for Tobi's Stores: tobi-stores" name="flink" value="{{$store['flink']}}">
                                    </div>
                                    <div class="col-md-7 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-pencil"></i> Description</p><br>
                                        <textarea class="form-control summernote" placeholder="Enter description" name="description" required>{{$store['description']}}</textarea>
                                    </div>
                                    <div class="col-md-5 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-briefcase"></i> Status</p><br>
                                        <p class="form-control-plaintext {{$sc}} text-left"><i class="fa fa-briefcase"></i> {{$status}}</p><br>
                                        <a href="{{url('delete-store').'?xf='.$store['id']}}" class="btn btn-primary">Delete store</a>
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