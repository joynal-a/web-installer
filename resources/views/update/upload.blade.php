@extends('joynala.web-installer::app')

@section('content')
<div class="row px-5">
    <div class="col-6 col-md-4 ms-auto d-flex align-items-center me-5" style="height: 100vh;" id="mainCard">
        <div class="card w-100 pt-3" style="overflow: hidden;border-bottom: none;">
            <div class="loader" id="loader" style="display: none">
                <img src="https://razinsoft.com/image/cog_loader.gif" alt="cog" border="0">
            </div>

            <h2 class="text-center mt-3">Ready To Upgrade</h2>
            <p class="fs-7 text-center">
                <strong class="text-danger">You're all set, and now you can upgrade.</strong>
            </p>

            <div class="w-80 m-auto">

            {{-- Final Submission here star --}}
            <span id="form_1" style="">
                <form id="upload" method="POST" enctype="multipart/form-data"> @csrf
                    <div class="mb-2">
                        <label for="zip">Upload your update zip file (e.g update.zip)<strong class="text-danger">*</strong></label>
                        <input type="file" name="zip" id="zip" class="form-control">
                    </div>

                    <div class="d-flex mt-3">
                        <div class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 16 16">
                                <g id="Group_22706" data-name="Group 22706"
                                    transform="translate(-704 -571)">
                                    <g id="Rectangle_19036" data-name="Rectangle 19036"
                                        transform="translate(704 571)" fill="#fff" stroke="#ea4335"
                                        stroke-width="1">
                                        <rect width="16" height="16" rx="8" stroke="none">
                                        </rect>
                                        <rect x="0.5" y="0.5" width="15" height="15" rx="7.5"
                                            fill="none"></rect>
                                    </g>
                                    <g id="Group_22693" data-name="Group 22693"
                                        transform="translate(0 -12)">
                                        <g id="Group_22698" data-name="Group 22698">
                                            <rect id="Rectangle_19044" data-name="Rectangle 19044"
                                                width="1.5" height="5" rx="0.75"
                                                transform="translate(715.475 589.939) rotate(45)"
                                                fill="#ea4335"></rect>
                                            <rect id="Rectangle_19111" data-name="Rectangle 19111"
                                                width="1.5" height="5" rx="0.75"
                                                transform="translate(716.536 591) rotate(135)"
                                                fill="#ea4335"></rect>
                                            <rect id="Rectangle_19051" data-name="Rectangle 19051"
                                                width="8" height="1.5" rx="0.75"
                                                transform="translate(708 590.25)" fill="#ea4335"></rect>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <p class="ml-2 mb-0 fs-7 fw-500" style="color: #666; line-height: 18px;">
                            Be sure to back up your database and all files before updating. By doing this, if you face any kind of problem, you can go back to the previous state.
                        </p>
                    </div>

                    <div class="d-flex mt-3">
                        <div class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 16 16">
                                <g id="Group_22706" data-name="Group 22706"
                                    transform="translate(-704 -571)">
                                    <g id="Rectangle_19036" data-name="Rectangle 19036"
                                        transform="translate(704 571)" fill="#fff" stroke="#e6e6e6"
                                        stroke-width="1">
                                        <rect width="16" height="16" rx="8"
                                            stroke="none"></rect>
                                        <rect x="0.5" y="0.5" width="15" height="15"
                                            rx="7.5" fill="none"></rect>
                                    </g>
                                    <g id="Group_22693" data-name="Group 22693"
                                        transform="translate(0 -12)">
                                        <g id="Group_22698" data-name="Group 22698">
                                            <rect id="Rectangle_19044" data-name="Rectangle 19044"
                                                width="1.5" height="5" rx="0.75"
                                                transform="translate(715.475 589.939) rotate(45)"
                                                fill="#007cff"></rect>
                                            <rect id="Rectangle_19111" data-name="Rectangle 19111"
                                                width="1.5" height="5" rx="0.75"
                                                transform="translate(716.536 591) rotate(135)"
                                                fill="#007cff"></rect>
                                            <rect id="Rectangle_19051" data-name="Rectangle 19051"
                                                width="8" height="1.5" rx="0.75"
                                                transform="translate(708 590.25)" fill="#007cff"></rect>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <p class="ml-2 mb-0 fs-7 fw-500" style="color: #666; line-height: 18px;">
                            Congratulations, you have successfully completed your verification so you are ready to upgrade your system. For upgrade your system you need to upload the update zip file.
                        </p>
                    </div>

                    <div class="my-4 py-4 absolute-bottom-left right-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-install text-uppercase">Upgrade now</button>
                    </div>
                </form>
            </span>
            {{-- Final Submission here end --}}

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
@if (session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Okay'
        })
    </script>
@endif
<script>
    const url = "/update/update-file"

    document.getElementById('upload').addEventListener('submit', function(event) {
        loader.style.display = 'flex'
        event.preventDefault();
        var formData = new FormData(this);

        // AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.onload = function() {
            loader.style.display = 'none'
            if (xhr.status === 200) {
                Swal.fire({
                    title: 'Congratulation',
                    text: 'Your system is perfectly upgraded please wait. You will be redirected within 10 seconds.',
                    icon: 'success',
                    timer: 5000,
                    showConfirmButton: true,
                    confirmButtonText: 'Click To Redirect',
                    willClose: () => {
                        window.location.href = '/';
                    }
                });
            } else {
                Swal.fire({
                    title: 'Wrong!',
                    text: xhr.statusText,
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                })
            }
        };
        xhr.send(formData);
    });
</script>
@endpush
