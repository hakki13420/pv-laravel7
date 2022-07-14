@extends('layouts.master')

@section('slogan')
    <span class="brand-text font-weight-light">
        {{$slogan}}
    </span>
@endsection
@section('copyright')
    <a href="https://www.dcwtlemcen.dz"><strong>{{$organisme}} &copy; @php echo date('Y'); @endphp </strong></a>جميع الحقوق محفوظة
@endsection
