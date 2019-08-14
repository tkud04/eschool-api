@extends("layout")

@section('title',"Deal Details")

@section('content')
<div class="container-fluid">
@if($deal['status'] == "approved")
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-50">
                                <li class="breadcrumb-item"><a href="{{url('deals')}}">Deals</a></li>
                                <li class="breadcrumb-item"><a href="{{url('deals').'?q='.$deal['category']}}">{{$category}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$deal['name']}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                                     <?php
                                      $images = $deal['images'];
                                      $imggs = [];
                                      shuffle($images);
                         
                                      if(count($images) < 1) { $imggs = ["https://via.placeholder.com/150"]; }
                                      else{
                                      	$ird = $images[0]['url'];
                                      	for($x = 0; $x < $images[0]['irdc']; $x++){
                                      	 $jara = "";
                                            if($x > 0) $jara = "-".($x + 1);
                                      	  $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird.$jara;
                                            array_push($imggs,$imgg); 
                                          }
                                      } 
                                      
                                      $data = $deal['data'];
                                     
                                    ?>
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                	@if(count($imggs) > 0)
                                      @for($a = 0; $a < count($imggs); $a++)
                                       <?php
                                         $imgg = $imggs[$a];
                                         $active = ($a == 0) ? "class='active'" : "";
                                       ?>
                                       <li {{$active}} data-target="#product_details_slider" data-slide-to="{{$a}}" style="background-image: url({{$imgg}});">
                                       </li>                                    
                                      @endfor
                                    @else
                                    <li data-target="#product_details_slider" data-slide-to="0" style="background-image: url(img/product-img/no-img.jpg);">
                                    </li>
                                    @endif
                                </ol>
                                <div class="carousel-inner">
                                	@if(count($imggs) > 0)
                                      @for($a = 0; $a < count($imggs); $a++)
                                       <?php
                                         $imgg = $imggs[$a];
                                         $active = ($a == 0) ? "active" : "";
                                       ?>
                                    <div class="carousel-item {{$active}}">
                                        <a class="gallery_img" href="{{$imgg}}">
                                            <img class="d-block w-100" src="{{$imgg}}" alt="Slide {{$a + 1}}">
                                        </a>
                                    </div>
                                    @endfor
                                    @else
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="img/product-img/pro-big-2.jpg">
                                            <img class="d-block w-100" src="img/product-img/pro-big-2.jpg" alt="Second slide">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="img/product-img/pro-big-3.jpg">
                                            <img class="d-block w-100" src="img/product-img/pro-big-3.jpg" alt="Third slide">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="img/product-img/pro-big-4.jpg">
                                            <img class="d-block w-100" src="img/product-img/pro-big-4.jpg" alt="Fourth slide">
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <?php
                                 $kp = $data['amount']; $op = "";
                                 $auction = $deal['auction'];
                                 if(count($auction) > 0 && $auction['status'] == "live"){$kp = $auction['auction_price']; $op = "<p class='avaibility'><i class='fa fa-times-circle'></i> <s>&#8358;".number_format($data['amount'],2)."</s></p>";
                                ?>
                                <p class="product-price">&#8358;{{number_format($kp,2)}} {!! $op !!}</p>
                                <a href="{{url('deal').'?sku='.$deal['sku']}}">
                                    <h6>{{$deal['name']}}</h6>
                                </a>
                                <!-- Start #clockdiv-->
                            <div class="row">
                               <div class="col-6"><div id="cdc-{{$auction['id']}}"></div></div>
				               <div class="col-3"></div>
				               <div class="col-3 d-inline">{{$auction['total-bids']}} bids</div>
				           </div>
				           <script>
	                        nq = new Date("{{$auction['ed']}}");
                           getcd(nq,"cdc-{{$auction['id']}}");
                           </script>
                           <!-- End #clockdiv-->
                           <?php
                                 }
                                ?>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                    	@if($deal['rating'] < 1)
                                         @for($s = 0; $s < 5; $s++)
                                          <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                        @else
                                        @for($s = 0; $s < $overallRating; $s++)
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                        @endif
										@if($user != null && $rating < 1)
                                        <br>
                                        <h6>Rate this product:</h6>
                                        <form action="{{url('rate-deal')}}" method="post">
                                        	{!! csrf_field() !!}
                                           <input type="hidden" name="xf" value="{{$deal['id']}}">
                                        <select name="rating">
                                        	<option value="none">Select rating</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select><br>
                                        <button type="submit" class="mt-4 btn btn-primary">Submit</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <!-- Avaiable -->
                                <?php
                                  $cl = "In Stock"; $ico = "fa-circle";
                                  if($data['in_stock'] == "almost"){ $cl = "Almost Gone"; $ico = "fa-hourglass-half";}
                                  else if($data['in_stock'] == "no"){ $cl = "Out of Stock"; $ico = "fa-times-circle";}
                                 ?>
                                <p class="avaibility"><i class="fa {{$ico}}"></i> {{$cl}}</p>
                            </div>

                            <div class="short_overview my-5">
                                {!! $data['description']!!}
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart clearfix">
                                <div class="cart-btn d-flex mb-50">
                                    <p>Qty</p>
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="qty" value="1">
                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <?php
                                  $bidURL = url("add-to-cart")."?sku=".$deal['sku']."&qty=";
                                  $bidText = "Add to cart";
                                  $auction = $deal['auction'];
                                  
                                 # $watchURL = url("watch")."?sku=".$deal['sku'];                                                                    
                                  $aurl = "";
                                  
                                  if(isset($mine) && $mine == "yes"){
                                  	$aurl = url('add-auction')."?xf=".$deal['id'];
                                  }
                                  if($deal['type'] == "deal"){
                                 ?>
                                <button id="" name="addtocart" value="5" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) window.location = '{{$bidURL}}' + qty;return false;" class="btn amado-btn">{{$bidText}}</button>                             
                                <?php
                                }
                                else if($deal['type'] == "auction")
                                  {
                                    $burl= url("bid")."?sku=".$deal['sku'];
                                    $btext = "Place bid";
                                    $buyURL = url("buy")."?sku=".$deal['sku']."&qty=1";
                                    $bp = "&#8358;".number_format($auction['buy_price'],2);
                                 ?>
                                 <button id="" name="addtocart" value="5" onclick="window.location = '{{$burl}}';return false;" class="btn amado-btn">{{$btext}}</button>
                                 <button id="" name="addtocart" value="5" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) window.location = '{{$buyURL}}' + qty;return false;" class="btn amado-btn active">Buy it now for {!! $bp !!}</button>
                                 <?php
                                 }
                                 ?>
                                @if(isset($mine) && $mine == "yes" && count($auction) < 1)
                                 <button id="" name="addtocart" value="5" onclick="window.location = '{{$aurl}}';return false;" class="btn amado-btn">Auction this now</button>
                                @endif
                            </form>

                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                     <form action="{{url('comment')}}" method="post">
                       {!! csrf_field() !!}
                       <input type="hidden" name="xf" value="{{$deal['id']}}">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Add comment:</label>
                          <textarea name="comment" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>   
                     <button type="submit" class="btn btn-primary">Submit</button>  
                   </form>
                    
                    <div class="clearfix"></div>                  
                    </div>
                    
                    <div class="row mt-5">
                      <div class="col-md-12 comments-area">
					    <h3 class="bmd-label-floating text-primary mb-3">Comments</h3>
						@if($comments != null && count($comments) > 0)
                         <div class="comment-list">
					    @foreach($comments as $c)
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="img/comment/comment_1.png" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                 {{$c['comment']}}
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">{{$c['user']}}</a>
                                    </h5>
                                    <p class="date"> {{$c['date']}}</p>
                                 </div>
                                 <div class="reply-btn">
                                    <a href="#" class="btn-reply text-uppercase">reply</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
					 @endforeach
                  </div>
				  @endif
                      </div>
                    </div>    
                    
                  
                </div>
            </div>
@else
 <div class="row">
                    <div class="col-12">
                        <p class="text-primary">This deal is awaiting approval and will be uploaded once approved by KloudTransact. <br><br>Why not check out our top deals for the day</p>
                        <a href="{{url('top-deals')}}" class="btn amado-btn">Go to top deals</a>
                    </div>
                </div>
@endif
@stop