<x-admin-master>

    @section('content')
        <h1>{{$user->name}}</h1>
        <div class="row">
            <div class="col-sm-6">
                <form action="{{route('user.profile.update', $user->id)}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4"><img height="100px" src="{{$user->avatar}}" alt=""/></div>
                <div class="form-group">
                    <input type="file" name="avatar">
                </div>
                <div class="form-group">
                    <label for="title">User Name</label>
                    <input type="text" name="username" class="form-control" id="name" 
                    aria-describedby="" value="{{$user->username}}">
                    @error('username')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
              </div>
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name="name" class="form-control" id="name" 
                    aria-describedby="" value="{{$user->name}}">
                    @error('name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Email</label>
                    <input type="text" name="email" class="form-control" id="email" 
                    aria-describedby="" value="{{$user->email}}">
                    @error('email')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror                   
                </div>   
                <div class="form-group">
                    <label for="title">Password</label>
                    <input type="password" name="password" class="form-control" id="password" 
                    aria-describedby="">
                    @error('password')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="title">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" 
                    aria-describedby="">
                    @error('password_confirmation')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>              
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
             </div>
        </div>

        <div class="row">
            <div class="col-sm-12">   
                  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="rolesTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Change Role</th>
                    </tr>
                  </thead>
                  <tbody> 
                      @foreach ($roles as $role)
                        <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->slug}}</td>
                        @if (!$user->userHasRole($role->name))
                        <td>
                            <form action="{{route('user.role.attach', $user->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="{{$role->id}}"/>
                                <button class="btn btn-info" 
                                type="submit">Attach</button>
                            </form>
                        </td>
                        @endif
                        
                        @if ($user->userHasRole($role->name))  
                        <td>
                             <form action="{{route('user.role.detach', $user->id)}}" method="post">
                                 @csrf
                                 @method('DELETE')
                                <input type="hidden" name="role" value="{{$role->id}}"/>
                                 <button class="btn btn-danger" 
                                 type="submit">Delete</button>
                             </form>
                        </td>
                        @endif
                        </td>
                      </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>     
            </div>
        </div>     
    @endsection
</x-admin-master>