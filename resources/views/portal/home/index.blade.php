@extends('portal')

@section('content')

    <div class="page animsition">
        <div class="page-content">
            <div class="panel">
                home do sistema
            </div>
            <!-- End Panel -->
            {{session()->get('image')}}
        </div>
    </div>

@endsection