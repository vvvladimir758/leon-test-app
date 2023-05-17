@extends('layout.app')

@section('title')
    Основная
@endsection

@section('content')
   
     
           <table class="table" id="vueTable">
  <thead>
    <tr>

      <th scope="col"><a href="{{$sitePath}}main/{{$page}}/Continent/{{ $orderType == 'desc' ? 'asc' : 'desc'}}">Continent</a></th>
      <th scope="col"><a href="{{$sitePath}}main/{{$page}}/Region/{{ $orderType == 'desc' ? 'asc' : 'desc'}}">Region</a></th>
      <th scope="col"><a href="{{$sitePath}}main/{{$page}}/Countries/{{ $orderType == 'desc' ? 'asc' : 'desc'}}">Countries</a></th>
       <th scope="col"><a href="{{$sitePath}}main/{{$page}}/LifeDuration/{{ $orderType == 'desc' ? 'asc' : 'desc'}}">Life duration</a></th>
        <th scope="col"><a href="{{$sitePath}}main/{{$page}}/Population/{{ $orderType == 'desc' ? 'asc' : 'desc'}}">Population</a></th>
         <th scope="col"><a href="{{$sitePath}}main/{{$page}}/Cities/{{ $orderType == 'desc' ? 'asc' : 'desc'}}">Cities</a></th>
          <th scope="col"><a href="{{$sitePath}}main/{{$page}}/Languages/{{ $orderType == 'desc' ? 'asc' : 'desc'}}">Languages</a></th>

    </tr>
  </thead>
  <tbody>

            @foreach($data as $item)
            
            <tr>
            <td>{{$item->Continent}}</td>
            <td>{{$item->Region}}</td>
            <td>{{$item->Countries}}</td>
            <td>{{$item->LifeDuration}}</td>
            <td>{{$item->Population}}</td>
            <td>{{$item->Cities}}</td>
            <td>{{$item->Languages}}</td>
            
            @endforeach
    </tbody>
    </table>
    
    
           <nav aria-label="Page navigation example">
  <ul class="pagination">
   <li class="page-item"><a class="page-link" href="{{$sitePath}}main/{{ ($page-1) > 0 ? ($page-1) : 1 }}"><</a></li>
  @foreach($pageCount as $n)
  
    <li class="page-item"><a class="page-link {{ $page == $n ? 'active' : '' }}" href="{{$sitePath}}main/{{$n}}">{{$n}}</a></li>
 
    @endforeach
       <li class="page-item"><a class="page-link" href="{{$sitePath}}main/ {{ ($page+1) < count($pageCount) ? ($page+1) : count($pageCount) }}">></a></li>
  </ul>
</nav> 

          
   
@endsection