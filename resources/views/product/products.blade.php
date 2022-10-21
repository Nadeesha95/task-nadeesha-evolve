@extends('layouts.main')
@section('content') 


<div class="container-fluid" style="width: 80%; margin-top: 100px;">
 
<div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
 <a href="/"><button class="btn btn-dark ">Back</button></a>
</div>

<div class="col-lg-12">
<div class="table-responsive"> 
<table class="table table-secondary table-responsive" >
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Availble Qty</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

  @foreach($data as $product)
    <tr>
    <td>{{$product->id}}</td>
    <td>{{$product->product_name}}</td>
    <td>{{$product->stock}}</td>
    <td><a class="vieproduct" style="cursor: pointer;" data-id="{{$product->id}}">Product Details</a></td>

    </tr>
    @endforeach
 
  </tbody>
</table>


</div>
</div>


</div>


<!-- Modal -->

<div id="modal1"  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="background: black; opacity:0.8;">
    <div class="modal-content" >
      <div class="modal-header" style="background: #212529;">
        <h5 class="modal-title" style="color:aliceblue;" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
       
      <table class="table">
  <thead>

  </thead>
  <tbody>
    <tr>
      <th scope="row">Name</th>
      <td id="row_name"></td>

    </tr>

    <tr>
      <th scope="row">Price</th>
      <td id="row_price"></td>

    </tr>

    <tr>
      <th scope="row">Product details</th>
      <td id="row_product_details"></td>

    </tr>

    <tr>
      <th scope="row">Stock</th>
      <td id="row_stock"></td>

    </tr>

 

  </tbody>
</table>

      </div>
      <div class="modal-footer" style="background: #212529;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->


<script>

$(document).on('click', '.vieproduct', function(){ 
		
	
		var id = $(this).attr("data-id");

           $.ajax({  
                url:"/product/"+id+"",  
                method:"GET",    
                dataType:"json",  
                success:function(data)  
                {  
                  if(data.status==200){
                    $('#exampleModalLabel').text(data.data.name);
                    $('#row_name').text(data.data.product_name);
                    $('#row_price').text(data.data.product_price);
                    $('#row_product_details').text(data.data.product_details);
                    $('#row_stock').text(data.data.stock);


                    $('#modal1').modal('toggle');
                  }else{

                    alert('something went wrong')
                  }
                     
                    //  $('#cor').val(data.course); 
           
                }  
           })  
      }); 
</script>



@endsection