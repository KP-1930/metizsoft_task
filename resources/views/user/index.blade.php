@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
                <div style="text-align: center;">{{ __('User List') }}</div>                
                <a href="{{route('create')}}" class="fa fa-plus"> Add User</a>
                <table class="table">
                    <thead>
                        <tr>                        
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Country</th>
                        <th scope="col">State</th>
                        <th scope="col">City</th>
                        <th scope="col">zipcode</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Hobbies</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    @foreach ($user_data as $data)

                    <tbody>
                        <tr>                        
                        <td>{{ $data->first_name }}</td>
                        <td>{{ $data->last_name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->address }}</td>
                        <td>{{ $data->country->name }}</td>
                        <td>{{ $data->state->name }}</td>
                        <td>{{ $data->city->name }}</td>
                        <td>{{ $data->zipcode }}</td>
                        <td>{{ $data->gender }}</td>
                        <td>{{ $data->hobbies }}</td>
                        <td><img src="/image/{{ $data->image }}" width="80px"></td>
                        <td>
                            <a href="{{route('edit',$data->id)}}"><i class="fa fa-edit"></i></a>
                            <a href="{{route('show',$data->id)}}"><i class="fa fa-eye"></i></a>
                            <a href="{{route('delete',$data->id)}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                        </td>
                        </tr>                
                    </tbody>
                    @endforeach
                    </table>                
            </div>    
        </div>
    </div>
</div>
@endsection
