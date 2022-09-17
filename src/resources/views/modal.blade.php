<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">
    <link href="{{ asset('themes/' . $theme->folder . '/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="{{ asset('themes/' . $theme->folder . '/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <title>Custom ui</title>
</head>
<body>
<div class="relative block px-10 py-8 ">
    <div>
        <input type="file"
               accept="image/*"
               name="image"
               id="file"
               onchange="loadFile(event)"
               style="display: none"/>
        <p>
            <label for="file"
                   class="bg-gray-300
                text-gray-800
                font-bold
                py-2
                cursor-pointer
                px-4
                rounded
                inline-flex
                items-center">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
                </svg>
                Upload Image
            </label>
        </p>
        <p class="mt-2"><img id="output" width="300" class="border-2 border-indigo-500"/></p>
    </div>

    <div class="mt-5">
        <p class="p-2">All your files</p>
        <div id="owl" class="owl-carousel owl-theme text-center"></div>
    </div>
</div>

<script>
    (async function () {
        const sdk = await new AppExtensionsSDK().initialize();
    })();

    let text = window.location.search;
    let pattern = /\d+/g;
    let match = text.match(pattern);
    let personId = match[2];
    let token = {!! json_encode($token->api_token) !!};
    let endpoint = "{{ config('pipedrive.pipedrive_custom_ui.endpoint') }}";
    getFiles();
    let loadFile = async function (event) {
        let image = document.getElementById("output");
        image.src = URL.createObjectURL(event.target.files[0]);
        try {
            const formData = new FormData();
            formData.append("person_id", personId);
            formData.append("file", event.target.files[0]);
            await fetch(`${endpoint}/files?api_token=${token}`,
                {
                    method: "POST",
                    body: formData,
                }
            )
            addFile();
        } catch (error) {
            console.log(error);
        }

    };

    function addFile() {
        try {
            $.ajax(
                `${endpoint}/files?sort=id_DESC&api_token=${token}`,
            ).then(({data}) => {
                let image = data[0].url;
                $('.owl-carousel')
                    .trigger('add.owl.carousel', [`<div class="item"><p><img src="${image}?api_token=${token}"></p></div>`])
                    .trigger('refresh.owl.carousel');
            })
        } catch (error) {
            console.log(error)
        }
    }

    function getFiles() {
        try {
            $.ajax(
                `${endpoint}/persons/${personId}/files?api_token=${token}`,
            ).then(({data}) => {
                for (let getImage of data) {
                    let image = getImage.url;
                    $('.owl-carousel')
                        .trigger('add.owl.carousel', [`<div class="item"><p><img src="${image}?api_token=${token}"></p></div>`]);
                }
            });
        } catch (error) {
            console.log(error)
        }
        $(".owl-carousel").owlCarousel({
            items: 1,
            margin: 10,
            loop: true,
        })
    }
</script>
</body>
</html>
