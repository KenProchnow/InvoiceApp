@extends('templates/main')
@section('content')	

<h3>Show All Expenses:</h3>

  <table class="table table-striped">	

	<thead>
	  <tr>
	    <th>{{ SortableTrait::link_to_sorting_action('id')  }}</th>
	    <th>{{ SortableTrait::link_to_sorting_action('merchant')  }}</th>
	    <th>{{ SortableTrait::link_to_sorting_action('trans_date')  }}</th>
	    <th>{{ SortableTrait::link_to_sorting_action('amount')  }}</th>
	    <th>{{ SortableTrait::link_to_sorting_action('category')  }}</th>	    
	  </tr>
	</thead>	
	
	

	<tbody>

		@foreach ($lists as $list)
			</tr> 
				<td>{{ $list->id  }}</td>
				<td>{{ $list->merchant  }} </td>
				<td>{{ $list->trans_date  }} </td>
				<td>{{ $list->amount  }} </td>
				<td>{{ $list->category  }} </td>
			{{-- {{ $expenses->appends(Input::except('page'))->links() }}			 --}}
			</tr>


		@endforeach	


		{{ $lists->links() }}

{{-- {{ $lists->appends(Input::except('page'))->links() }} --}}

	</tbody>

</table>


@stop



