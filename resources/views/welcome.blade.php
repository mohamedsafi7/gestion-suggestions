welcome
<form method="POST" action="{{ route('logout') }}" class="d-inline">
   @csrf
   <button type="submit" class="btn btn-link nav-link">
       {{ __('Logout') }}
   </button>
   </form>