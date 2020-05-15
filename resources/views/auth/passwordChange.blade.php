@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center text-uppercase">{{ __('Change Password') }}</div>

                    <div class="card-body">

                        <div class="old Password">

                            <form id="form" action="{{ route('old.password') }}" method="POST">

                                @csrf
                                <div class="form-group">
                                    <label id="label">Enter old password</label>
                                    <input class="form-control" name="old_password" id="password" type="password">
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        //ajax data submit
        $('#form').on('submit', function (event) {
            event.preventDefault();
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let formData = new FormData($(this)[0]);
            $.ajax({
                headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                url: $(this).attr('action'),
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (resp) {
                    console.log(resp);
                    if (resp.success == "OK") {
                        Swal.fire({
                            type: 'success',
                            title: resp.message,
                        });

                        //if password match next we are change our form action and other things.
                        let action = '{{route('new.password')}}';
                        $("#form").attr('action', action);
                        $("#password").attr('name', 'new_password');
                        $("#label").text("Enter New Password");
                    } else {
                        //  $('.preloader').hide();
                        Swal.fire({
                            type: 'error',
                            title: '<P style="color: red;">Oops...<p>',
                            text: resp.errors,
                            footer: '<b> Something Wrong</b>'
                        });
                        //  console.log(resp);
                    }
                },
                //error function
                error: function (e) {
                    alert("some thing want wrong");
                }
            });
        });

    </script>
@endsection

