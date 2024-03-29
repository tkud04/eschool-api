@extends("layout")

@section('title',"Top Deals")

@section('content')
<?php $ct = (isset($category) && $category != null) ? " - ".$category : ""; ?>
<div class="container-fluid">
            <h2 class="category-header">Top Deals{{$ct}}</h2>
                @include('deals-filter')

                <div class="row">
                  @if(count($topDeals) > 0)
                   @foreach($topDeals as $d)
                      <?php
                         $images = $d['images'];
                         shuffle($images);
                         $ird = $images[0]['url'];
                         $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird;
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
                                <img src="{{$imgg}}" class="cli" data-cli="{{$dealURL}}" alt="">
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
                                    	@if($d['rating'] < 1)
                                         @for($s = 0; $s < 5; $s++)
                                          <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                        @else
                                        @for($s = 0; $s < $d['rating']; $s++)
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                        @endif
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

                @if(count($topDeals) > 0)
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