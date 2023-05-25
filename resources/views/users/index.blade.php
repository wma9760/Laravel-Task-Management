@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        
        <!-- end row -->
        <div class="row" id="contactList">

            <div class="col-xl-8 offset-xl-2">
                <div class="card">
                    <div class="text-center card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="{{route('contact.destroy',Auth::user()->id)}}" class="dropdown-item">Remove</a>
                                <a href="{{route('contact.edit',Auth::user()->id)}}" class="dropdown-item">Edit</a>
                               
                            </div>
                        </div>
                        <div>
                            <img src="{{ asset('assets/images/users/' . Auth::user()->image) }}"
                                class="rounded-circle avatar-xl img-thumbnail mb-2" alt="profile-image">

                            <p class="text-muted font-13 mb-3">
                                {{ Auth::user()->profile }} </p>

                            <div class="text-start">
                                <p class="text-muted font-13"><strong>Full Name :</strong> <span
                                        class="ms-2">{{ Auth::user()->name }}o</span></p>

                                <p class="text-muted font-13"><strong>Mobile :</strong><span
                                        class="ms-2">{{ Auth::user()->phone }}</span></p>

                                <p class="text-muted font-13"><strong>Email :</strong> <span
                                        class="ms-2">{{ Auth::user()->email }}</span></p>

                                <p class="text-muted font-13"><strong>Location :</strong> <span
                                        class="ms-2">{{ Auth::user()->location }}</span></p>
                            </div>

                            <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light">Send
                                Message</button>
                        </div>
                    </div>
                </div>


            </div>
            <!-- end col -->

        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var searchTerm = $(this).val();
                $.ajax({
                    url: '/contacts/search',
                    type: 'GET',
                    data: {
                        searchTerm: searchTerm
                    },
                    success: function(data) {
                        $('#contactList').html(data);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
        </script>
       
      
        
        
        
        
        
@endsection
