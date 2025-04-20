@extends('layouts.app')

@section('content') 
<div class="container"> 
    <div class="row justify-content-center"> 
        <div class="col-md-8"> 
            <div class="card"> 
                <div class="card-header">Dashboard</div> 
                <div class="card-body"> 

                    {{-- Flash success message --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Welcome message from cookie --}}
                    <h4>Welcome back, {{ request()->cookie('admin_name') ?? 'Administrator' }}!</h4>

                    {{-- Admin user ID from session --}}
                    <p>Your session user ID is: {{ session('admin_user_id') ?? 'Not found' }}</p>

                    <hr>
                    You must be the privileged administrator of this site! 

                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection
