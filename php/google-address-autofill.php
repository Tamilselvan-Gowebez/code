<!-- google address autofill script -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9jMc11X8eFCfqffiuzDxWrO7UrZLEgH0&amp;libraries=places"></script>

<!-- Start : Address Details
            ======================================================================== -->
<div class="row mt-3">
    <div class="col-md-6 form-group position-relative">
        <label for="address" class="form-label">Street Address<span class="text-danger">*</span></label>
        <input type="text" name="address" class="form-control required-input" id="address" value="" placeholder="" autocomplete="off">
        <small id="address-error" class="text-danger d-none position-absolute">Street address can't be empty.</small>
    </div>
    <div class="col-md-6 form-group position-relative">
        <label for="city" class="form-label">City<span class="text-danger">*</span></label>
        <input type="text" name="city" class="form-control required-input" value="" id="city">
        <small id="city-error" class="text-danger d-none position-absolute">City can't be empty.</small>
    </div>
    <div class="col-md-6 form-group position-relative">
        <label for="state" class="form-label">State<span class="text-danger">*</span></label>
        <input type="text" name="state" class="form-control required-input" id="state">
        <small id="state-error" class="text-danger d-none position-absolute">State can't be empty.</small>
    </div>
    <div class="col-md-6 form-group position-relative">
        <label for="zip-code" class="form-label">Zip Code<span class="text-danger">*</span></label>
        <input type="text" name="zip-code" class="form-control" id="zip-code" value="" autocomplete="off">
        <small id="zip-code-error" class="text-danger d-none position-absolute">Zip code can't be empty.</small>
    </div>
</div>
<!-- End : Address Details
======================================================================== -->

<!-- Start : Google Address Autocomplete
======================================================================== -->
<script type="text/javascript">
    var state_code;

    google.maps.event.addDomListener(window, 'load', initialise);

    function initialise() {
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (place)
                getCityState(place);
        });
    }

    function getCityState(place) {
        var full_address = $('#address').val();
        var city_state = "";
        $("#city").val("");
        $("#state").val("");
        $("#zip-code").val("");

        place.address_components.forEach(function(c) {
            var type = c.types[0];

            if (type === 'locality') {
                $("#city").val(c.long_name)
                city_state += ", " + c.long_name + ", ";

            }
            //for city
            if (type === 'administrative_area_level_1') {
                state_code = c.short_name;
                $("#state").val(c.short_name)
                city_state += c.short_name + ", ";
            }
            if (type === 'country') {
                if (c.short_name == 'US')
                    city_state += 'USA';
                else
                    city_state += c.short_name;

            }
            //for pin code
            if (type === 'postal_code') {
                $("#zip-code").val(c.long_name)
            }
        });
        full_address = full_address.replace(city_state, "")
        $("#address").val(full_address)

    }
</script>
<!-- End : Google Address Autocomplete
======================================================================== -->