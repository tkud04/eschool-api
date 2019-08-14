@extends("layout")

@section('title',"Edit Deal")

@section('content')
<?php 
#$ct = (isset($category) && $category != null) ? " - ".$category : ""; 
$imgg = $deal['images'];
 if($imgg[0]['url'] == "none") $img = "https://via.placeholder.com/150";
 else $img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$imgg[0]['url'];
?>
<script> let cdb = "deal";</script>
<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading mt-1">View Deal</h2>
            <hr class="my-4">
             <div class="checkout_details_area mt-50 clearfix">
                            <div class="card">                        	     
                        	     <div class="card-body">
                        	       <h3 class="card-title" style="color: #fbb710 !important; padding: 5px;">View/edit information about your store</h3>                     
                                   
                                   <form action="{{url('edit-deal')}}" method="post">
                                   	{!! csrf_field() !!}
                                   <input type="hidden" name="ird" id="ird" value="{{$imgg[0]['url']}}" required>
                                   <input type="hidden" name="irdc" id="irdc" value="{{$imgg[0]['irdc']}}" required>
                                   	<input type="hidden" name="sku" id="sku" value="{{$deal['sku']}}" required>
                                <div class="row">
                                    <div class="col-md-6 col-xs-12 mb-3">
                                    	<p class="form-control-plaintext text-left mb-1">
                                          <img src="{{$img}}" class="img-fluid"alt="" width="200">
                                          <?php
                                           if($imgg[0]['irdc'] > 1){
                                           	$imu = "";
                                               ?>
                                          	<ul class="deals-avatar">
                                          <?php
                                           	for($a = 1; $a < $imgg[0]['irdc']; $a++)
                                               {
                                                   $jara = "";
                                                  $jara = "-".($a);
                                      	        $imu = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$imgg[0]['url'].$jara;
                                              #if($imu != $img) {
                                          ?>
                                          	<li class="deals-avatar-item">
                                          	<img src="{{$imu}}" class="img-fluid"alt="">
                                          	</li>
                                          <?php
                                               #}
                                             }
                                           }
                                          ?>
                                           </ul>
                                           <?php
                                           if($imgg[0]['url'] == "none"){                                       	
                                          ?>
                                          <button id="deal-upload" class="cloudinary-button">Upload new images</button>
                                          <span id="cloudinary-loading">It usually takes a few minutes to upload images so please be patient when you click Upload above :)</span>
                                          <?php
                                           }
                                           else{
                                           $dri = url('ddri')."?loc=edit-deal&ird=".$imgg[0]['url'];
                                          ?>
                                          <a href="{{$dri}}" class="amado-btn mb-3">Delete images</a>
                                          <?php
                                           }
                                          ?>
                                        </p><br>
                                    </div>
                                    <div class="col-md-6 col-xs-12 mb-3">
                                    	<p class="form-control-plaintext text-left"><i class="fa fa-suitcase"></i> Name</p><br>
                                        <input name='name' type="text" class="form-control" value="{{$deal['name']}}" required><br><br>
                                        <p class="form-control-plaintext text-left"><i class="fa fa-suitcase"></i> SKU</p><br>
                                        <input type="text" class="form-control" value="{{$deal['sku']}}" disabled required><br>
                                    </div>
                                    <div class="col-md-6 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-user"></i> Category</p><br>
                                        <select class="form-control" name='category' required>
                          	<option value="none">Select category</option>
                              @foreach($categories as $key => $value)
                              <?php $ss = ($deal['category'] == $key) ? 'selected="selected"' : ''; ?>
                              <option value="{{$key}}" {{$ss}}>{{$value}}</option>
                              @endforeach
                          </select><br><br>
                          <p class="form-control-plaintext text-left"><i class="fa fa-pencil"></i> Inventory status</p><br>
                                        <select class="form-control" name='in_stock' required>
                          	<option value="none">Select inventory status</option>
                              <?php 
                              $iss = ['yes' => 'In stock','new' => 'New!','no' => 'Out of Stock'];                           
                              foreach($iss as $key => $value){ 
                              	$ss = ($deal['data']['in_stock'] == $key) ? 'selected="selected"' : ''; 
                              ?>
                              <option value="<?=$key?>" <?=$ss?>><?=$value?></option>
                              <?php } ?>
                          </select>
                                    </div>
                                    <div class="col-md-6 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-pencil"></i> Description</p><br>
                                        <textarea class="form-control summernote" name='description' required>{{$deal['data']['description']}}</textarea>
                                    </div>
                                    <div class="col-md-6 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-briefcase"></i> Price(&#8358;)</p><br>
                                        <input name='amount' type="number" class="form-control" value="{{$deal['data']['amount']}}" required>
                                    </div>
                                    <div class="col-md-6 col-xs-12 mb-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-star"></i> Rating</p><br>
                                        <span class="">
                          	<?php for($u = 0; $u < $deal['rating']; $u++){ ?>
                            	<i class="fa fa-star fa-2x"></i>
                              <?php } ?>
                          </span>
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