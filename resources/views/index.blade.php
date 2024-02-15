<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <main class="main">
        <div class="opachity">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 col-md-4 m-auto m-auto d-flex align-items-center" style="height: 100vh;">
                        <div class="card w-100 pt-3" style="overflow: hidden;border-bottom: none;">
                            <h2 class="text-center mt-3">Thanks For Installing</h2>
                            <p class="fs-7 text-center">
                                <strong class="text-danger">You will need to know the following items before
                                    proceeding.</strong>
                            </p>

                            <div class="w-80 m-auto">
                                <ol class="list-group rounded-2 mb-4" style="border: 1px solid #ddd;">
                                    {{-- <li class="list-group-item fw-600 d-flex align-items-center" style="line-height: 18px; color: #666; gap: 7px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                                                <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47"></path>
                                            </svg>
                                            Codecanyon purchase code
                                        </li> --}}
                                    <li class="list-group-item fs-7 fw-600 d-flex align-items-center"
                                        style="line-height: 18px; color: #666; gap: 7px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435"
                                            viewBox="0 0 13.435 13.435">
                                            <path id="Union_2" data-name="Union 2"
                                                d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z"
                                                transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47">
                                            </path>
                                        </svg>
                                        Database Name
                                    </li>
                                    <li class="list-group-item fs-7 fw-600 d-flex align-items-center"
                                        style="line-height: 18px; color: #666; gap: 7px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435"
                                            viewBox="0 0 13.435 13.435">
                                            <path id="Union_2" data-name="Union 2"
                                                d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z"
                                                transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47">
                                            </path>
                                        </svg>
                                        Database Username
                                    </li>
                                    <li class="list-group-item fs-7 fw-600 d-flex align-items-center"
                                        style="line-height: 18px; color: #666; gap: 7px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435"
                                            viewBox="0 0 13.435 13.435">
                                            <path id="Union_2" data-name="Union 2"
                                                d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z"
                                                transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47">
                                            </path>
                                        </svg>
                                        Database Password
                                    </li>
                                    <li class="list-group-item fs-7 fw-600 d-flex align-items-center"
                                        style="line-height: 18px; color: #666; gap: 7px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435"
                                            viewBox="0 0 13.435 13.435">
                                            <path id="Union_2" data-name="Union 2"
                                                d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z"
                                                transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47">
                                            </path>
                                        </svg>
                                        Database Hostname
                                    </li>
                                </ol>

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
                                    <a href="http://install.test/step1" class="btn btn-install text-uppercase">
                                        Start Installation Process
                                    </a>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col" style="min-height: 3px; background: #006a4e"></div>
                                <div class="col" style="min-height: 3px;  background: #f42a41"></div>
                                <div class="col" style="min-height: 3px;  background: #006a4e"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .main {
            background: url("/../assets/images/background.jpg");
            width: 100%;
            height: 100vh;
            background-repeat: no-repeat;
            background-size: cover;

        }

        .opachity {
            background: #0000006b;
            width: 100%;
            height: 100%;
        }

        .fs-7 {
            font-size: 0.75rem !important;
        }

        .fw-500 {
            font-weight: 500 !important;
        }

        .fw-600 {
            font-weight: 600 !important;
        }

        .w-80 {
            width: 80% !important;
        }

        .btn-install {
            width: 280px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 20px;
            background: linear-gradient(to right, #e90608 0%, #f59e39 100%);
            box-shadow: 0px 8px 16px rgba(255, 88, 0, 0.16);
            font-weight: bold;
            font-size: 14px;
            line-height: 18px;
            text-align: center;
            color: #fff !important;
            transition: all 0.5s;
        }

        .btn-install:hover {
            box-shadow: 0px 8px 40px rgb(255 88 0 / 30%);
            letter-spacing: 0.3px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
