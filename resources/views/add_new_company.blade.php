@extends('layouts.master')
@section('css')
    .addCompany { width:500px; height:auto; background-color:#1abc9c; padding:15px; margin:20px auto;}
     input[type=text] { width:100%;}
    .form { margin-top: 15px; }
    .btn-primary { margin-top: 10px; }
    .btn-sm { float: right; }
    .anotherAdresses > input[type=text] { margin-top:10px;}
    .adressFields { margin-top: 15px; }
@endsection
@section('content')
    <div class="addCompany">
        <h1>Yeni Şirket Ekleme Formu</h1>
        <div class="form">
        <label for="company_name">Şirket Adı</label> <input type="text" name="company_name" id="company_name" class="form-control">
        </div>
        <div class="form">
        <div id="locationField">
            <label for="autocomplete">Şirket Adresi</label> <button class="btn btn-danger btn-sm" onclick="add_field()">Yeni Alan Ekle +</button>
            <input id="autocomplete" onFocus="geolocate()" type="text" name="adress_field[]" class="adress form-control"/>
            <div id="anotherAdresses"></div>
        </div>
        </div>
        <div class="form">
        <label for="companyWebAdress">Web Adresi</label>
        <input type="text" name="companyWebAdress" id="companyWebAdress" class="form-control">
        </div>
        <br><button onclick="save()" class="btn btn-primary">Ekle</button>
    </div>
@endsection
@section('js')
    <script>
        // Ajax
        function save(){
            var inputValues = "";
            var input = document.getElementsByName('adress_field[]');
            for(var i = 0; i < input.length; i++){
                var element = input[i];
                inputValues = inputValues + "#" + element.value;
            }
            var companyName = document.getElementById('company_name').value;
            var companyWebAdress = document.getElementById('companyWebAdress').value;
            if(companyName === "" || companyWebAdress === ""){
                alert('Tüm alanları doldurun')
            }else {
                axios.post('{{route('company.post.add')}}', {
                    companyName: companyName,
                    companyAdresses: inputValues,
                    webAdres: companyWebAdress
                })
                    .then(function (response) {
                        if (response.data === "company added"){
                            alert('Şirket bilgileri eklendi.');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
        var countSearchInput = 1;
        function add_field(){
            var inputId =  "autocomplete"+countSearchInput;
            var x = document.getElementById("anotherAdresses");
            // create an input field to insert
            var new_field = document.createElement("input");
            // set input field data type to text
            new_field.setAttribute("type", "text");
            // set input field name
            new_field.setAttribute("name", "adress_field[]");
            new_field.setAttribute("class", "adressFields");
            new_field.setAttribute("id", inputId);
            new_field.setAttribute("onFocus", "geldi()");
            new_field.setAttribute("autocomplete", "off");
            // select last position to insert element before it
            var pos = x.childElementCount;
            // insert element
            x.insertBefore(new_field, x.childNodes[pos]);
            inputId = new google.maps.places.Autocomplete(document.getElementById(inputId), { types: [ 'geocode' ] });
            google.maps.event.addListener(inputId, 'place_changed', function() {
                fillInAddress();
            });
            countSearchInput++;
        }
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUfx61aNJL10iPFonejGs6VUqHAQl4KX0&callback=initAutocomplete&libraries=places&v=weekly"
    defer></script>
<script>
    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("autocomplete"),
            { types: ["geocode"] }
        );
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                const circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy,
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
@endsection

