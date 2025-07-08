@extends('joynala.web-installer::app')

@section('content')
<div class="row px-5">
    <div class="col-6 col-md-4 ms-auto d-flex align-items-center me-5" style="height: 100vh;" id="mainCard">
        <div class="card w-100 pt-3" style="overflow: hidden;border-bottom: none;">
            <div class="loader" id="loader" style="display: none">
                <img src="https://i.ibb.co/9mWzCWCt/cog-loader.gif" alt="cog" border="0">
            </div>

            <h2 class="text-center mt-3">Verify Your Purchase</h2>
            <p class="fs-7 text-center">
                <strong class="text-danger">You're all set, and now you can upgrade.</strong>
            </p>

            <div class="w-80 m-auto">

            {{-- verify purchase code process start here --}}
            @if (config('installer.verify_purchase'))
                <form method="post" action="{{ route('updater.purcgase-verify') }}"> @csrf
                    @foreach ($verifyRules as $name => $verifyRule)
                    <div class="mb-3">
                        <label for="">{{ $verifyRule['label'] }}@if(substr($verifyRule['rule'], 0, 8) === 'required')<strong class="text-danger">*</strong>@endif</label>
                        <input type="{{ $verifyRule['type'] }}" name="{{ $name }}" placeholder="{{ $verifyRule['placeholder'] }}" value="{{ old($name) }}" class="form-control @error($name) is-invalid @enderror">
                    </div>
                    @endforeach

                    <div class="my-4 py-4 absolute-bottom-left right-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-install text-uppercase">Verify Purchase</button>
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
@if (session('error'))
<script>
    Swal.fire({
        title: 'Wrong!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'Try Again'
    })
</script>
@endif

@endpush
