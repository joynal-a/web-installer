@extends('joynala.web-installer::app')

@section('content')
<div class="row px-5">
    <div class="col-6 col-md-4 ms-auto d-flex align-items-center me-5" style="height: 100vh;" id="mainCard">
        <div class="card w-100 pt-3" style="overflow: hidden;border-bottom: none;">
            <div class="loader" id="loader" style="display: none">
                <img src="https://i.ibb.co/vzDRR5f/cog.gif" alt="cog" border="0">
            </div>

            <h2 class="text-center mt-3">Ready For Instalation</h2>
            <p class="fs-7 text-center">
                <strong class="text-danger">You will need to fill up the following mandatory items before proceeding.</strong>
            </p>

            <div class="w-80 m-auto">
            {{-- Dynamic instalation process start here --}}
                @foreach ($environmentFields as $key => $types)
                    <form method="post" id="form_{{ ($key + 1) }}" style="display: {{ $key > 0 ? 'none':null }}">
                        @csrf
                        @foreach ($types as $name => $fields)
                            @isset($fields['option'])
                                @if ($fields['type'] == 'select')
                                    <div class="mb-3">
                                        <label for="">{{ $fields['label'] }}@if (substr($fields['rule'], 0, 8) === 'required')<strong class="text-danger">*</strong>@endif</label>
                                        <select name="{{ $name }}" class="form-control">
                                            <option value="">{{ $fields['placeholder'] }}</option>
                                            @foreach ($fields['option'] as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                <div class="mb-3">
                                    <label for="">{{ $fields['label'] }}@if (substr($fields['rule'], 0, 8) === 'required')<strong class="text-danger">*</strong>@endif</label> <br>
                                    @foreach ($fields['option'] as $k => $option)
                                    <label for="radio_{{ $option }}" class="{{ $k > 0 ? 'ms-4':'' }}">
                                        {{ $option ? 'True':'False' }} <input type="radio" id="radio_{{ $option }}" {{ !$option ? 'checked':'' }} name="{{ $name }}" value="{{ $option ? 'true':'false' }}" class="form-control-radio">
                                    </label>
                                    @endforeach
                                </div>
                                @endif
                            @else
                                <div class="mb-3">
                                    <label for="">{{ $fields['label'] }}@if (substr($fields['rule'], 0, 8) === 'required')<strong class="text-danger">*</strong>@endif</label>
                                    <input type="{{ $fields['type'] }}" name="{{ $name }}" placeholder="{{ $fields['placeholder'] }}" class="form-control">
                                </div>
                            @endisset
                        @endforeach

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
                                During the installation process, we will check if the files that are needed to
                                be written (.env file) have write permission. We will also check if curl are
                                enabled on your server or not.
                            </p>
                        </div>

                        <div class="my-4 py-4 absolute-bottom-left right-0 d-flex justify-content-center">
                            <button onclick="submitData('form_{{ ($key + 1) }}', 'form_{{ ($key + 2) }}', '{{ route('installer.app-configure.store', $key) }}')" type="button" class="btn btn-install text-uppercase">Next</button>
                        </div>
                    </form>
                @endforeach
            {{-- Dynamic instalation process end here --}}

            {{-- Final Submission here star --}}
            <span id="form_{{ count($environmentFields) + 1 }}" style="display: none">
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
                        During the installation process, we will check if the files that are needed to
                        be written (.env file) have write permission. We will also check if curl are
                        enabled on your server or not.
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
                        Gather the information mentioned above before hitting the start installation
                        button. If you are ready….
                    </p>
                </div>

                <div class="my-4 py-4 absolute-bottom-left right-0 d-flex justify-content-center">
                    <button type="button" onclick="finalSubmit()" class="btn btn-install text-uppercase">Final Submission</button>
                </div>
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
    <script>
        const finalUrl = "{{ route('installer.app.final-install') }}"
        const csrfUrl = "{{ route('installer.new-csrf') }}"
        const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
        });

        function submitData(formId, nextId, url){
            let formData = $('#' + formId).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            let currentForm = document.getElementById(formId)
            let nextForm = document.getElementById(nextId)
            let lastForm = "form_{{ count($environmentFields) }}"
            let loader = document.getElementById('loader');

            loader.style.display = 'flex'
            $.ajax({
                url : url,
                type : "POST",
                dataType : "json",
                data: formData,
                success:function(data)
                {
                    setNewToken()
                    loader.style.display = 'none'
                    if(data.status == 400){
                        Swal.fire({
                            title: 'Wrong!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        })
                    }

                    if(data.status == 200){
                        Toast.fire({
                            icon: "success",
                            title: "The environment setup is successful."
                        });
                        currentForm.style.display = 'none'
                        nextForm.style.display = 'block'
                    }
                },
                error:function(jqXHR, textStatus, errorThrown) {
                    // Check if the server returned a JSON response
                    if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                        var errors = jqXHR.responseJSON.errors;
                        // Loop through the errors and display them in your fields
                        for (var field in errors) {
                            // console.log(field, errors);
                            if (errors.hasOwnProperty(field)) {
                                $(`input[name="${field}"]`).addClass("is-invalid")
                                $(`select[name="${field}"]`).addClass("is-invalid")

                                var errorMessage = errors[field];
                            }

                        }
                    }
                    loader.style.display = 'none'
                }
            });
        }

        function finalSubmit(){
            loader.style.display = 'flex'
            $.ajax({
                url : finalUrl,
                type : "GET",
                dataType : "json",
                success:function(data)
                {
                    if(data.status == 400){
                        Swal.fire({
                            title: 'Wrong!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        })
                    }

                    if(data.status == 200){
                        document.getElementById('mainCard').remove()
                        Swal.fire({
                            title: 'Thanks',
                            text: 'Our Installation system is perfectly done please wait. You will be redirected.',
                            icon: 'success',
                            timer: 5000,
                            showConfirmButton: true,
                            confirmButtonText: 'Click To Redirect',
                            willClose: () => {
                                window.location.href = '/';
                            }
                        });
                    }

                },
                error:function(jqXHR, textStatus, errorThrown) {
                    loader.style.display = 'none'
                }
            })
        }

        function setNewToken(){
            $.ajax({
                url : csrfUrl,
                type : "GET",
                dataType : "json",
                success:function(data)
                {
                    $("input[name='_token']").val(data.token);
                }
            })
        }

    </script>
@endpush
