@extends('layouts.main')
@section('content') 


<div class="container-fluid" style="width: 80%; margin-top: 100px;">
 
<div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
 <button class="btn btn-dark addseller">Add New</button>
</div>

<div class="col-lg-12">
<div class="table-responsive"> 
<table class="table table-secondary table-responsive" >
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

  @foreach($data as $seller)
    <tr>
    <td>{{$seller->id}}</td>
    <td>{{$seller->name}}</td>
    <td>{{$seller->email}}</td>
    <td><a href="{{route('seller.show',$seller->id)}}">Products</a>
    <a class="editseller" data-id="{{$seller->id}}" style="cursor: pointer;">Edit</a></td>


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
      <div id="errors"></div>
      <table class="table">
  <thead>

  </thead>
  <tbody>
    
    <tr>
      <th scope="row">Name</th>
      <td >
      <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
      </td>

    </tr>

    <tr>
      <th scope="row">Email</th>
      <td >
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
      </td>

      <input type="hidden" class="form-control" id="sellerid" aria-describedby="emailHelp" placeholder="Enter Name">


    </tr>

    <tr>
      <th scope="row">Status</th>
      <td >
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" checked id="status1" name="status" value="1" class="custom-control-input">
        <label class="custom-control-label" for="customRadioInline1">Active</label>
      </div>

     <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="status2" name="status" value="0" class="custom-control-input">
        <label class="custom-control-label" for="customRadioInline1">Inactive</label>
      </div>
      </td>

    </tr>



  </tbody>
</table>

      </div>
      <div class="modal-footer" style="background: #212529;">
        <button type="button" class="btn btn-secondary btncancel" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-secondary btnsave" data-dismiss="modal">Save</button>

       
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->


<script>

$(document).on('click', '.addseller', function(){ 
		
	$('#modal1').modal('toggle');

	
      }); 


 $(document).on('click', '.btncancel', function(){ 
		
    $('#modal1').modal('toggle');
  
    
    }); 


  $(document).on('click', '.btnsave', function(){ 
		
		var name = $("#name").val();
    var email = $("#email").val();
    var id = $("#sellerid").val();

    var status = $("input[name='status']:checked").val();
    $("#errors").text('');

    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	
           $.ajax({  
            url: '{{route("seller.store")}}',
	          type: 'POST',
	          data: {
            'id': id,
		      	'name': name,
		      	'email': email,
		      	'status': status,

		       	},   
                dataType:"json",  
                success:function(data)  
                {  


                  if(data.status==422){

             $.each(data.validate_err, function (key, item) 
                 {
                $("#errors").append("<li style='font-size:12px;' class='alert alert-danger'>"+item+"</li>")
                 });

      }else{
  $('#modal1').modal('toggle');

Swal.fire({
position: 'top-end',
icon: 'success',
title: 'success',
text: data.message,
showConfirmButton: false,
timer: 1500
});

$("#name").val('');
$("#email").val('');
setTimeout(function(){
        location.reload();
    }, 1000) 

}
                     
                    //  $('#cor').val(data.course); 
           
                }  
           })  
      }); 



      $(document).on('click', '.editseller', function(){ 
		
        var id = $(this).attr("data-id");
        $.ajax({  
                url:"/showseller/"+id+"",  
                method:"GET",    
                dataType:"json",  
                success:function(data)  
                {  
                  if(data.status==200){
                 
                    $('#modal1').modal('toggle');
                     $("#name").val(data.data.name);
                     $("#email").val(data.data.email);
                     $("#sellerid").val(data.data.id);

                     if(data.data.status==0){

                      $("#status2").prop("checked", true);
                     }

                     

                  }else{

                    alert('something went wrong')
                  }
                     
                    //  $('#cor').val(data.course); 
           
                }  
           }) 
  
    
        }); 

      
  

</script>



@endsection