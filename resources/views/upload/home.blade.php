@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Photo Upload</div>

                <div class="card-body">                    
                    <form action="/upload" method="post">
                        {{ csrf_field() }}
                        Select a file to upload
                        <br />
                        <input type="file" name="photo" />
                        <br />
                        <input type="submit" value="Upload" />
                    </form>      
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection