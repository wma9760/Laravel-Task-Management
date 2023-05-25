@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat</div>

                <div class="card-body">
                    <div id="app">
                        <chat-log :messages="messages"></chat-log>
                        <chat-composer v-on:messagesent="addMessage"></chat-composer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
