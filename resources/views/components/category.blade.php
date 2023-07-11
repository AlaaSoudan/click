
<div>
    category
                @foreach ( $letcategories as  $category )
                <form method="POST" action="{{ route('filter') }}">
                    @csrf
  
                </form>

                @endforeach

                </div>
<div>
