@extends('layouts.app')

@section('content')
<script>
    $(document).ready(function() {
   
       $("#btnAdd").on("click", function() {
            $("#frmUser").attr("action", "/users/add");
            $("#frmUser").submit();
        });

       $("#btnClear").on("click", function() {
            $("#frmUser").attr("action", "/users/add");
            $("#frmUser").submit();
       });

        $("#btnUpdate").on("click", function() {
            $("#frmUser").attr("action", "/users/update");
            $("#frmUser").submit();
       });

    });

 
    
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users Administration</div>

                <div class="card-body">
                    @include('common.errors')
                </div>


                <div class="card-body">
                    <form id="frmUser" name="frmUser" method="post">
                    
                    {{ csrf_field() }}

                    @if( !empty($userEdit->name) )
                        <input type="hidden" name="id" id="id" 
                                    value="{{ $userEdit->id }}">
                    @else
                        <input type="hidden" name="id" id="id" value="0">
                    @endif


                    <table>
                        <tr>
                            <td>Name:</td>
                            <td>
                                @if( !empty($userEdit->name) )
                                    <input type="text" name="name" id="name" 
                                    value="{{ $userEdit->name }}">
                                @else
                                    <input type="text" name="name" id="name" 
                                    value="{{ old('name') }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td>
                                <input type="text" name="email" id="email" 
                                value="{{ $userEdit->email or old('email') }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td>
                                <input type="password" name="pwd" id="pwd" 
                                value="{{ $userEdit->password or old('password') }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Role: </td>
                            <td>
                                <select name="role" id="role">
                                    <option value="staff">Staff</option>
                                    <option value="admin">Adminstrator</option>
                                </select>
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2" align="center">
                            @if (empty($userEdit))
                             <button id="btnAdd" name="btnAdd">Add</button> 
                            @else
                             <button id="btnUpdate" name="btnUpdate">Update</button>
                            @endif
                            <button id="btnClear" name="btnClear" >Clear</button>
                            </td>           
                        </tr>
                    </table>
                    </form>
                </div>

                <div class="card-body">                
                   <table border="1" width="70%">
                    <thead>
                        <th width="30%">Name</th>
                        <th width="30%">Email</th>
                        <th width="10%">Role</th>
                        <th width="30%">&nbsp;</th>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td> 
                                <a href="/users/edit/{{$user->id}}">{{ $user->name }}</a>
                            </td>
                            <td>
                                <a href="/users/edit/{{$user->id}}">{{ $user->email }}</a>
                            </td>
                            <td>
                                {{ $user->role }}
                            </td>
                            <td>
                                
                                <form action="/users/delete/{{ $user->id }}" method="post">
                                    {{ csrf_field() }}
                                    
                                    <button>Delete</button>
                                </form>
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