@extends('base')

@section('extra-css')

<style>
        .thank-you-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        justify-content: center;
        flex: 1;
        padding: 100px;
    }
</style>

@endsection


@section('content')
<section class="confirmations" style="padding: 120px">
    <div class="container">
        @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif
        @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
                <div class="thank-you-section">
                    <h1>Thank you for <br> Your Order!</h1>
                    <p>A confirmation email was sent</p>
                    <div class="spacer"></div>
                    <div>
                        <a href="{{ url('/') }}" class="btn site-btn">Home Page</a>
                    </div>
                    <div class="spacer"></div>
                    {{-- <div>
                        <a href="{{ route('confirmation.show') }}" class="btn site-btn">View Bill Payment</a>
                    </div> --}}
                </div>
        </div>
    </div>
</section>
@endsection