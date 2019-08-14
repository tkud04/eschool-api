@extends("layout")

@section('title',"Kloud Auctions")

@section('content')
<?php $ct = (isset($category) && $category != null) ? " - ".$category : ""; ?>
<div class="container-fluid">
	<script>let nq = "";</script>
            <h2 class="category-header">Kloud Auctions{{$ct}}</h2>             
                @include('deals-filter')

                <div class="row" id="auction-section">
                 @if(count($auctions)  > 0)
                  @foreach($auctions as $a)
                  <?php
                    $deal = $a['deal'];
                    $data = $deal['data'];
                    $images = $deal['images'];
                         shuffle($images);
                         $ird = $images[0]['url'];
                         $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird;
                    $du = url('deal')."?sku=".$deal['sku'];
                  ?>
                    <!-- Single Product Area -->
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6 wow fadeInUp">
                        <div class="single-product-wrapper">                         
                            <!-- Start #clockdiv-->
                            <div class="row">
                               <div class="col-6"><div id="cdc-{{$a['id']}}"></div></div>
				               <div class="col-3"></div>
				               <div class="col-3 d-inline">{{$a['total-bids']}} bids</div>
				           </div>
				</div>
				<!-- End #clockdiv-->
			                    <script>
	nq = new Date("{{$a['ed']}}");
    getcd(nq,"cdc-{{$a['id']}}");
</script>
                                
                            <!-- Product Image -->
                            <div class="product-img">
                            	<center>
                                <img src="{{$imgg}}" class="cli" data-cli="{{$du}}" alt="">
                                <!-- Hover Thumb --
                                <img class="hover-img" src="img/product-img/product2.jpg" alt=""> -->    
                                </center>
                            </div>

                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">&#8358;{{number_format($a['auction_price'], 2)}}</p>
                                    <a href="{{$du}}">
                                        <h6>{{$deal['name']}}</h6>
                                    </a>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right">
                                    <div class="ratings">
                                        @if($deal['rating'] < 1)
                                         @for($s = 0; $s < 5; $s++)
                                          <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                        @else
                                        @for($s = 0; $s < $deal['rating']; $s++)
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                        @endif
                                    </div>
                                    <div class="cart">
                                    	<?php
                                          $buyURL = url("buy")."?sku=".$deal['sku']."&qty=1";
                                          $bp = "&#8358;".number_format($a['buy_price'],2);
                                         ?>
                                        <a href="{{$buyURL}}" data-toggle="tooltip" data-placement="left" title="Buy now for {{$bp}}"><img src="img/core-img/cart.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                       </div>
                        @endforeach
                  @else
                  <p class="text-primary">No auctions at the moment. Check back later? </p>
                  @endif
                  
                  @if(count($auctions) > 0)
                <div class="row">
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                <li class="page-item"><a class="page-link" href="#" disabled>&lt;&lt;</a></li>  
                                <li class="page-item active"><a class="page-link" href="#">&gt;&gt;</a></li>  
                            </ul>
                        </nav>
                    </div>
                </div>
                @endif
                    </div>
                    
 
                
            </div>
@stop

@section('scripts')
<script src="lib/raf/requestAnimationFrame.js" ></script>
@stop