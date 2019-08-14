@extends("asset_layout")

@section('title',$title)

@section('content')
<?php 
$ct = (isset($category) && $category != null) ? " - ".$category : ""; 
$deals = (isset($store["deals"])) ? $store["deals"] : [];

$img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$store['img'];
 if($store['img'] == "none") $img = "https://via.placeholder.com/150";
?>
<div class="container-fluid">
            <h2 class="category-header">{{$title}}</h2>
			<div class="row">
			  <div class="col-md-6">
			     <center>
                  <img src="{{$img}}" alt="" width="300"><br>
				</center>
			  </div>
			  <div class="col-md-6">
			     <div class="card">                        	     
                   <div class="card-body">
                      <p class="text-center" style="color: #fbb710 !important; padding: 5px;">{!! $store['description'] !!}</p>                     
                    </div>
                 </div>
			  </div>
			</div>
               
                                


                <div class="row">
                	@if($mine == "yes")
					<div class="col-md-12">
                	<center><a href="{{url('manage-my-store')}}" class="amado-btn mb-3">Manage Store</a></center>
					</div>
                    @endif
                  @if(count($deals) > 0)
					   <h5 class="wow fadeInUp" style="color: #fbb710 !important; padding: 5px;">Deals</h5>   
                   @foreach($deals as $d)
                      <?php
                         $images = $d['images'];
                         shuffle($images);
                         
                         if(count($images) < 1) $imgg = "https://via.placeholder.com/150";
                         else $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$images[0]['url'];
                         $data = $d['data'];
                         $dealURL = url("deal")."?sku=".$d['sku'];
                         $cartURL = url("add-to-cart")."?sku=".$d['sku']."&qty=1";
                      ?>
                    <!-- Single Product Area -->
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6 wow fadeInUp">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                            	<center>
                                <img src="{{$imgg}}" class="cli" data-cli="{{$dealURL}}"alt="">
                                <!-- Hover Thumb --
                                <img src="images[1]['url']" alt=""> -->                                                                
                                </center>
                            </div>

                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">&#8358;{{$data['amount']}}</p>
                                    <a href="{{$dealURL}}">
                                        <h6>{{$d['name']}}</h6>
                                    </a>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right">
                                    <div class="ratings">
                                    	@for($s = 0; $s < $d['rating']; $s++)
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                    <div class="cart">
                                        <a href="{{$cartURL}}" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="img/core-img/cart.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>              
                    @endforeach
                  @else
                  <p class="text-primary">No deals at the moment. Check back later? </p>
                  @endif
                </div>

                @if(count($deals) > 10)
                <div class="row">
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                <li class="page-item active"><a class="page-link" href="#">1.</a></li>
                                <li class="page-item"><a class="page-link" href="#">2.</a></li>
                                <li class="page-item"><a class="page-link" href="#">3.</a></li>
                                <li class="page-item"><a class="page-link" href="#">4.</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                @endif
            </div>

@stop