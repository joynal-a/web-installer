@extends('joynala.web-installer::app')

@section('content')
<div class="row px-5">
    <div class="col-6 col-md-4 ms-auto d-flex align-items-center me-5" style="height: 100vh;" id="mainCard">
        <div class="card w-100 pt-3" style="overflow: hidden;border-bottom: none;">
            <div class="loader" id="loader" style="display: none">
                <img src="https://i.ibb.co/vzDRR5f/cog.gif" alt="cog" border="0">
            </div>

            <h2 class="text-center mt-3">Verify Your Purchase</h2>
            <p class="fs-7 text-center">
                <strong class="text-danger">You're all set, and now you can upgrade.</strong>
            </p>

            <div class="w-80 m-auto">

            {{-- verify purchase code process start here --}}
            @if (config('installer.verify_purchase'))
                <form method="post"  id="form_0">
                    @foreach ($verifyRules as $name => $verifyRule)
                    <div class="mb-3">
                        <label for="">{{ $verifyRule['label'] }}@if(substr($verifyRule['rule'], 0, 8) === 'required')<strong class="text-danger">*</strong>@endif</label>
                        <input type="{{ $verifyRule['type'] }}" name="{{ $name }}" placeholder="{{ $verifyRule['placeholder'] }}" class="form-control">
                    </div>
                    @endforeach

                    <div class="my-4 py-4 absolute-bottom-left right-0 d-flex justify-content-center">
                        <button onclick='verifyPurchase(`{{ route("installer.verify-perchase") }}`, "form_2", "form_0")' type="button" class="btn btn-install text-uppercase">Verify Purchase</button>
                    </div>
                </form>

            @endif
            {{-- verify purchase code process end here --}}

            </div>

            <div class="row">
                <div class="col" style="min-height: 3px; background: #006a4e"></div>
                <div class="col" style="min-height: 3px;  background: #f42a41"></div>
                <div class="col" style="min-height: 3px;  background: #006a4e"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const url = "{{ route('updater.file-update') }}"
    function uploadFile(){

        // $.ajax({
        //     url : url,
        //     type : "POST",
        //     dataType : "json",
        //     data: formData,
        //     headers: {
        //         'X-CSRF-Token': csrfToken
        //     },
        //     success:function(data)
        //     {
        //         loader.style.display = 'none'
        //         if(data.status === 422){
        //             Swal.fire({
        //                 title: 'Wrong!',
        //                 text: data.message,
        //                 icon: 'error',
        //                 confirmButtonText: 'Try Again'
        //             })
        //         }
        //         if(data.status === 200){
        //             Toast.fire({
        //                 icon: "success",
        //                 title: data.message
        //             });
        //             currentForm.style.display = 'none'
        //             nextForm.style.display = 'block'
        //         }
        //     },
        //     error:function(jqXHR, textStatus, errorThrown) {
        //         console.log('ok');
        //         if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
        //             var errors = jqXHR.responseJSON.errors;
        //             // Loop through the errors and display them in your fields
        //             for (var field in errors) {
        //                 if (errors.hasOwnProperty(field)) {
        //                     $(`input[name="${field}"]`).addClass("is-invalid")
        //                     $(`select[name="${field}"]`).addClass("is-invalid")

        //                     var errorMessage = errors[field];
        //                 }

        //             }
        //         }
        //         loader.style.display = 'none'
        //     }
        // })
    }
</script>
@endpush
