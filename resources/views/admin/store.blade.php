@extends("admin.layout")

@section('title',"View Store")

@section('content')
<?php 
$ct = (isset($category) && $category != null) ? " - ".$category : ""; 
$deals = (isset($store["deals"])) ? $store["deals"] : [];

$img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$store['img'];
 if($store['img'] == "none") $img = "https://via.placeholder.com/150";
?>
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">View Store</h4>
                  <p class="card-category">View, edit or remove this store</p>
                </div>
                <div class="card-body">
                  <form method='post' action="{{url('cobra-store')}}">
                  	{!! csrf_field() !!}
                     <input type="hidden" name="ird" id="ird" value="{{$store['img']}}" required>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <input name='name' type="text" class="form-control" value="{{$store['name']}}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Image</label>
                          <img class="img img-fluid mx-auto d-block" src="{{$imgg}}"><br>       
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
                        </div>
                      </div>
                    </div>
                    <div class="row mt-5">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>                         
                          <select class="form-control" name='category' required>
                          	<option value="none">Select category</option>
                              <?php $op = ['approved' => "Verified",'pending' => "Pending",'disabled' => "Disabled"]; ?>
                              @foreach($op as $key => $value)
                              <?php $ss = ($store['status'] == $key) ? 'selected="selected"' : ''; ?>
                              <option value="{{$key}}" {{$ss}}>{{$value}}</option>
                              @endforeach
                          </select>
                        </div><br>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Friendly URL</label>
                          <input name='flink' type="text" class="form-control" value="{{$store['flink']}}" required>
                        </div>
                      </div>
                    </div> 

                    <div class="row mt-5">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Rating</label>                         
                          @for($s = 0; $s < $store['rating']; $s++)
                                          <i class="fa fa-star fa-2x" aria-hidden="true"></i>
                                        @endfor
                        </div><br>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Description</label>
                          <textarea class="form-control summernote" placeholder="Enter description" name="description" required>{{$store['description']}}</textarea>
                        </div>
                      </div>
                    </div>                      
                    
                    <button type="submit" class="btn btn-primary pull-right">Update Store</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="assets/img/faces/marc.jpg" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">Tasks</h6>
                  <h4 class="card-title">Deal Management</h4>
                  <p class="card-description">
                    Create an auction listing. 
                  </p>
                  <?php $auctionURL = url('cobra-add-auction').'?xf='.$deal['id']; ?>
                  <a href="{{$auctionURL}}" class="btn btn-primary btn-round">Add Auction</a>
                  
                  <p class="card-description mt-5">
                    Removes this deal from the system. 
                  </p>
                  <?php $deleteURL = url('cobra-delete-deal').'?sku='.$deal['sku']; ?>
                  <a href="{{$deleteURL}}" class="btn btn-primary btn-round">Delete Deal</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@stop