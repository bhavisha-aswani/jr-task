@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>company</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('company.create') }}"> Create New company</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Logo</th>
            <th>website</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($companies as $company)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $company->name }}</td>
             <td>{{ $company->email }}</td>
              <td>
                <img src="/storage/logo/{{$company->logo}}" height="100px" width="100px">
            </td>
            <td>{{ $company->website }}</td>
            <td>
                <form action="{{ route('company.destroy',$company->id) }}" method="POST">
   
                    <a class="btn btn-primary" href="{{ route('company.edit',$company->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  </div>
    {!! $companies->links() !!}
     
@endsection