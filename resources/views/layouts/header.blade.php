<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" style="color: #ffff;" href="/">Home </a>
      </li>
   
    </ul>
  
  </div>
</nav>

@foreach (['success','danger'] as $msg)
                    @if(Session::has('alert-' . $msg))

				

					<script>
						
						function info_noti(){
		Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		size: 'mini',
		position: 'top right',
		icon: 'bx bx-info-circle',
		msg: "{{ Session::get('alert-' . $msg) }}"
		});
	  } 
	  
					</script>

          
                       @endif
                       @endforeach