// jQuery functions to manipulate the main page and handle communication with
// the books web service via Ajax.
//
// Note that there is very little error handling in this file.  In particular, there
// is no validation in the handling of form data.  This is to avoid obscuring the 
// core concepts that the demo is supposed to show.

var barColors = ['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', 
'#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',
'#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', 
'#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
'#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', 
'#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
'#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', 
'#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
'#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', 
'#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'];

// Get all knife crime results
function getAllKnifeCrimes()
{
    $.ajax({
        url: '/knifecrimes',
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Filter results
function getCrimeByFilter()
{
    var force = document.getElementById("searchcrimebyforce").value;
    var region = document.getElementById("searchcrimebyregion").value
    var date = document.getElementById("searchcrimebyyear").value

    // If no filters applied to force, region and date
    if ((force == 'All') && (region == 'All') && (date == 'All')){
        document.getElementById('availableresults').disabled=false;
        getAllKnifeCrimes();
    }
    // If filter applied to only force
    else if ((force != 'All') && (region == 'All') && (date == 'All')){
        document.getElementById('availableresults').disabled=true;
        getKnifeCrimeByForce(force);
    }
    // If filter applied to only region
    else if ((force == 'All') && (region != 'All') && (date == 'All')){
        document.getElementById('availableresults').disabled=true;
        getKnifeCrimeByRegion(region);
    }
    // If filter applied to only date
    else if ((force == 'All') && (region == 'All') && (date != 'All')){
        document.getElementById('availableresults').disabled=true;
        getKnifeCrimeByDate(date);
    }
    // If filter applied to force and region
    else if ((force != 'All') && (region != 'All') && (date == 'All')){
        document.getElementById('availableresults').disabled=true;
        getKnifeCrimeByForceRegion(force, region);
    }
    // If filter applied to force and date
    else if ((force != 'All') && (region == 'All') && (date != 'All')){
        document.getElementById('availableresults').disabled=true;
        getKnifeCrimeByForceDate(force, date);
    }
    // If filter applied to region and date
    else if ((force == 'All') && (region != 'All') && (date != 'All')){
        document.getElementById('availableresults').disabled=true;
        getKnifeCrimeByRegionDate(region, date);
    }
    // If filter applied to all
    else
    {
        getKnifeCrimeByForceRegionDate(force, region, date);
    }

}

// Get knife crime by police force
function getKnifeCrimeByForce(force)
{
    $.ajax({
        url: '/knifecrimes/force='+force,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Get knife crime by region
function getKnifeCrimeByRegion(region)
{
    $.ajax({
        url: '/knifecrimes/region='+region,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Get knife crime by date
function getKnifeCrimeByDate(date)
{
    $.ajax({
        url: '/knifecrimes/date='+date,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Get knife crime by force and region
function getKnifeCrimeByForceRegion(force, region)
{
    $.ajax({
        url: '/knifecrimes/force='+force+'/region='+region,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Get knife crime by force and date
function getKnifeCrimeByForceDate(force, date)
{
    $.ajax({
        url: '/knifecrimes/force='+force+'/date='+date,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Get knife crime by region and date
function getKnifeCrimeByRegionDate(region, date)
{
    $.ajax({
        url: '/knifecrimes/region='+region+'/date='+date,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Get knife crime by force, region and date
function getKnifeCrimeByForceRegionDate(force, region, date)
{
    $.ajax({
        url: '/knifecrimes/force='+force+'/region='+region+'/date='+date,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Get quantity
function getQuantity()
{
    var resultquantity = document.getElementById("availableresults").value;
    if (resultquantity == 'All'){
        getAllKnifeCrimes();
    }
    else
    {
      getQuantityKnifeCrimes(resultquantity);  
    }
}

// Get specific amount of knife crimes
function getQuantityKnifeCrimes(resultquantity)
{
    $.ajax({
        url: '/knifecrimes/results/'+resultquantity,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Get graph data for yearly knife crimes
function getGraphYearlyKnifeCrimes()
{
    var xForce = [];
    var yTotalCrime = [];

    var years = document.getElementById("yearlyresults").value;

    $.ajax({
        url: '/knifecrimes/year='+years,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            for (var i = 0; i < data.length; i++)
            {
                xForce.push(data[i].ForceName);
                yTotalCrime.push(data[i].TotalKnifeCrime);
            }
            title = "Total knife crimes between "+years;
            generateBarGraph(xForce, yTotalCrime, title);
            generateDoughnutGraph(xForce, yTotalCrime, title);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Get region coordinates
function getRegionCoordinates(region)
{
    $.ajax({
        url: '/knifecrimes/coordinates/region='+region,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createKnifeCrimeTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Retrieve map data
function generateCrimeDataMap()
{
    $.ajax({
        url: '/knifecrimes/coordinates',
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            getMapKnifeCrimes(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Geerate bar chart graph
function generateBarGraph(xValues, yValues, title)
{
    document.getElementById("barChartContainer").innerHTML = '&nbsp;';
    document.getElementById("barChartContainer").innerHTML = '<canvas id="yearlyKnifeCrimesBarChart" style="width:100%;max-width:1000px"></canvas>';

    new Chart("yearlyKnifeCrimesBarChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
          display: true,
          text: title
        }
      }
    });
}

// Generate doughnut graph
function generateDoughnutGraph(xValues, yValues, title)
{
    document.getElementById("doughnutChartContainer").innerHTML = '&nbsp;';
    document.getElementById("doughnutChartContainer").innerHTML = '<canvas id="yearlyKnifeCrimesDoughnutChart" style="width:100%;max-width:1000px"></canvas>';
    
    new Chart("yearlyKnifeCrimesDoughnutChart", {
    type: "doughnut",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        title: {
        display: true,
        text: title
        }
    }
    });
}

// Edit knife crimes - UPDATE
function editKnifeCrimes(crimeDetailId)
{
    $.ajax({
        url: '/knifecrimes/id='+crimeDetailId,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createEditKnifeCrimeForm(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Generate knife crime table
function createKnifeCrimeTable(knifecrimes)
{
    var strResult = '<div class="col-md-12">' + 
                    '<table class="table table-bordered table-hover">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Force name</th>' +
                    '<th>Region</th>' +
                    '<th>Date</th>' +
                    '<th>Knife Enabled</th>' +
                    '<th>Violence With Injury</th>' +
                    '<th>Homocide and Serious Injury</th>' +
                    '<th>Total Knife Crime</th>' +
                    '<th>&nbsp;</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
    $.each(knifecrimes, function (index, availablecrimes)  
    {                 
        strResult += "<tr><td>" + availablecrimes.ForceName + "</td><td> " + availablecrimes.Region + "</td><td>" + availablecrimes.Date + "</td><td>" + availablecrimes.KnifeEnabled + "</td><td>" + availablecrimes.ViolenceWithInjury + "</td><td>" + availablecrimes.HomocideAndSeriousInjury + "</td><td>" + availablecrimes.TotalKnifeCrime  + "</td><td>";
        strResult += '<input type="button" value="Edit crime details" class="btn btn-sm btn-primary" onclick="editKnifeCrimes(' + availablecrimes.CrimeDetailId + ');"/>';
        strResult += '</td></tr>';
    });
    strResult += "</tbody></table>";
    $("#allknifecrimes").html(strResult);
}

// Edit knife crime data - UPDATE
function editCrimeDetailsValues(crimeId, crimeDetailId)
{
    var crimeDetails = {
        CrimeDetailId: crimeId,
        ForceName: $('#crimePoliceForce').val(),
        Region: $('#crimeRegion').val(),
        Date: $('#crimeDate').val(),
        KnifeEnabled: $('#crimeKnifeEnabled').val(),
        ViolenceWithInjury: $('#crimeViolenceWithInjury').val(),
        HomocideAndSeriousInjury: $('#crimeHomocideSeriousInjury').val(),
        TotalKnifeCrime: $('#crimeTotalKnifeCrime').val()
    };

    $.ajax({
        url: '/knifecrimes',
        type: 'PUT',
        data: JSON.stringify(crimeDetails),
        contentType: "application/json;charset=utf-8",
        success: function (data) {
            alert("Completed");
            editKnifeCrimes(crimeDetailId);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

// Reload page if cancel button is clicked
function cancelChangeCrimeDetails()
{
    location.reload()
}

// Generate edit knife crime form
function createEditKnifeCrimeForm(knifecrimes)
{
    var policeForce;
    var region;
    var knifecrimes = knifecrimes;

    var strResult = '<div class="col-md-12">' + 
                    '<table class="table table-bordered table-hover">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Force name</th>' +
                    '<th>Region</th>' +
                    '<th>Date</th>' +
                    '<th>Knife Enabled</th>' +
                    '<th>Violence With Injury</th>' +
                    '<th>Homocide and Serious Injury</th>' +
                    '<th>Total Knife Crime</th>' +
                    '<th>&nbsp;</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
    $.each(knifecrimes, function (index, availablecrimes)  
    {          
        policeForce = availablecrimes.ForceName;
        region = availablecrimes.Region;
        crimeIds = availablecrimes.CrimeId + ',' + availablecrimes.CrimeDetailId;

        strResult += "<tr><td>" + availablecrimes.ForceName + "</td><td> " + availablecrimes.Region + "</td><td>" + availablecrimes.Date + "</td><td>" + availablecrimes.KnifeEnabled + "</td><td>" + availablecrimes.ViolenceWithInjury + "</td><td>" + availablecrimes.HomocideAndSeriousInjury + "</td><td>" + availablecrimes.TotalKnifeCrime  + "</td><td>";
        strResult += '<input type="button" value="Edit crime details" class="btn btn-sm btn-primary" onclick="editKnifeCrimes(' + availablecrimes.CrimeDetailId + ');"/>';
        strResult += '</td></tr>';
        strResult += "</tbody></table>";
        strResult += '<div class="col-md-12">';
        strResult += '<form class="form-horizontal" role="form">';
        strResult += '<div class="form-group"><label for="crimeForceName" class="col-md-3 control-label">Force name:</label><div class="col-md-9">' + createPoliceForceCombobox() + '</div></div>';
        strResult += '<div class="form-group"><label for="crimeRegion" class="col-md-3 control-label">Region:</label><div class="col-md-9">' + createRegionCombobox() + '</div></div>';
        strResult += '<div class="form-group"><label for="crimeDate" class="col-md-3 control-label">Date:</label><div class="col-md-9"><input type="text" class="form-control" id="crimeDate" value="' + availablecrimes.Date +'"></div></div>';
        strResult += '<div class="form-group"><label for="crimeKnifeEnabled" class="col-md-3 control-label">Knife enabled:</label><div class="col-md-9"><input type="text" class="form-control" id="crimeKnifeEnabled" value="' + availablecrimes.KnifeEnabled +'"></div></div>';
        strResult += '<div class="form-group"><label for="crimeViolenceWithInjury" class="col-md-3 control-label">Violence With Injury:</label><div class="col-md-9"><input type="text" class="form-control" id="crimeViolenceWithInjury" value="' + availablecrimes.ViolenceWithInjury +'"></div></div>';
        strResult += '<div class="form-group"><label for="crimeHomocideSeriousInjury" class="col-md-3 control-label">Homocide and Serious Injury:</label><div class="col-md-9"><input type="text" class="form-control" id="crimeHomocideSeriousInjury" value="' + availablecrimes.HomocideAndSeriousInjury +'"></div></div>';
        strResult += '<div class="form-group"><label for="crimeTotalKnifeCrime" class="col-md-3 control-label">Total Knife Crime:</label><div class="col-md-9"><input type="text" class="form-control" id="crimeTotalKnifeCrime" value="' + availablecrimes.TotalKnifeCrime +'"></div></div>';
        strResult += '<div class="form-group"><div class="col-md-offset-3 col-md-9"><input type="button" value="Confirm edit" class="btn btn-sm btn-primary" onclick="editCrimeDetailsValues(' + crimeIds + ');" />&nbsp;&nbsp;<input type="button" value="Cancel" class="btn btn-sm btn-primary" onclick="cancelChangeCrimeDetails();" /></div></div>';
        strResult += '</form></div>';
    });
    $("#allknifecrimes").html(strResult);

    const changeSelectedForce = (e) => {
        const text = policeForce;
        const $select = document.querySelector('#crimePoliceForce');
        const $options = Array.from($select.options);
        const optionToSelect = $options.find(item => item.text ===text);
        optionToSelect.selected = true;
      };

    const changeSelectedRegion = (e) => {
        const text = region;
        const $select = document.querySelector('#crimeRegion');
        const $options = Array.from($select.options);
        const optionToSelect = $options.find(item => item.text ===text);
        optionToSelect.selected = true;
    };
    
    changeSelectedForce();
    changeSelectedRegion();
}

// Generate police force combobox
function createPoliceForceCombobox()
{
    var strResult = '<select name="policeforces" id="crimePoliceForce">' +
                    '<option value="41">Avon and Somerset</option>' +
                    '<option value="91">Bedfordshire</option>' +
                    '<option value="70">Cambridgeshire</option>' +
                    '<option value="42">Cheshire</option>' +
                    '<option value="15">Cleveland</option>' +
                    '<option value="19">Cumbria</option>' +
                    '<option value="80">Derbyshire</option>' +
                    '<option value="72">Devon and Cornwall</option>' +
                    '<option value="57">Dorset</option>' +
                    '<option value="33">Durham</option>' +
                    '<option value="1">Dyfed-Powys</option>' +
                    '<option value="8">Essex</option>' +
                    '<option value="44">Gloucestershire</option>' +
                    '<option value="36">Greater Manchester</option>' +
                    '<option value="5">Gwent</option>' +
                    '<option value="25">Hampshire</option>' +
                    '<option value="32">Hertfordshire</option>' +
                    '<option value="10">Humberside</option>' +
                    '<option value="29">Kent</option>' +
                    '<option value="61">Lancashire</option>' +
                    '<option value="20">Leicestershire</option>' +
                    '<option value="24">Lincolnshire</option>' +
                    '<option value="59">Merseyside</option>' +
                    '<option value="11">Metropolitan Police</option>' +
                    '<option value="55">Norfolk</option>' +
                    '<option value="90">North Wales</option>' +
                    '<option value="64">North Yorkshire</option>' +
                    '<option value="84">Northamptonshire</option>' +
                    '<option value="82">Northumbria</option>' +
                    '<option value="3">Nottinghamshire</option>' +
                    '<option value="26">South Wales</option>' +
                    '<option value="86">South Yorkshire</option>' +
                    '<option value="73">Staffordshire</option>' +
                    '<option value="13">Suffolk</option>' +
                    '<option value="85">Surry</option>' +
                    '<option value="100">Sussex</option>' +
                    '<option value="22">Thames Valley</option>' +
                    '<option value="37">Warwickshire</option>' +
                    '<option value="67">West Mercia</option>' +
                    '<option value="66">West Midlands</option>' +
                    '<option value="76">West Yorkshire</option>' +
                    '<option value="97">Wiltshire</option>' +
                    '</select>';
    return strResult;
}

// Generate region combobox
function createRegionCombobox()
{
    var strResult = '<select name="regions" id="crimeRegion">' +
                    '<option value="2">East</option>' +
                    '<option value="18">East Midlands</option>' +
                    '<option value="10">London</option>' +
                    '<option value="6">North East</option>' +
                    '<option value="15">North West</option>' +
                    '<option value="7">South East</option>' +
                    '<option value="11">South West</option>' +
                    '<option value="9">Wales</option>' +
                    '<option value="1">West Midlands</option>' +
                    '<option value="12">Yorkshire</option>' +
                    '</select>'
    return strResult;
}

// Generate map
function getMapKnifeCrimes(coordinates)
{
    // Popup get ids
    var container = document.getElementById('popup');
    var content = document.getElementById('popup-content');
    var closer = document.getElementById('popup-closer');

    // map view, coordinates to zoom in on - zoom on UK
    const map = new ol.Map({
        view: new ol.View({
            center: [-155664.66967859038,7274753.743376922],
            zoom: 5.5
        }),
        target: 'js-map'
    })

    // Basemap Layers
    // standard layer
    const openStreetMapStandard = new ol.layer.Tile({
        source: new ol.source.OSM(),
        visible: true,
        title: 'OSMStandard'
    })

    // Humanitarian layer
    const openStreetMapHumanitarian = new ol.layer.Tile({
        source: new ol.source.OSM({
            url: 'http://{a-c}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png'
        }),
        visible: false,
        title: 'OSMHumanitarian'
    })

    // Stamen terrain layer
    const stamenTerrain = new ol.layer.Tile({
        source: new ol.source.XYZ({
        url: 'http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg',
        attributions: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
        }),
        visible: false,
        title: 'StamenTerrain'
    })
    
    // Layer Group
    const baseLayerGroup = new ol.layer.Group({
        layers: [
            openStreetMapStandard, openStreetMapHumanitarian, stamenTerrain
        ]
    })
    map.addLayer(baseLayerGroup);

    // Layer switcher - switch between basemaps, depending on radio button selector
    const baseLayerElements = document.querySelectorAll('.sidebar > input[type=radio]')
    for(let baseLayerElement of baseLayerElements){
        baseLayerElement.addEventListener('change', function(){
            let baseLayerElementValue = this.value;
            baseLayerGroup.getLayers().forEach(function(element, index, array){
                let baseLayerTitle = element.get('title');
                element.setVisible(baseLayerTitle === baseLayerElementValue);
            })
        })
    }

    // Get all region data from API
    var getCoordinates = coordinates;
    var coordinateArray = []
    $.each(getCoordinates, function (index, availablecoordinates)
    {
        // Split coordinate, lat and lon
        coordinateArray.push(availablecoordinates.RegionCoordinates);
        const coordinateSplit = availablecoordinates.RegionCoordinates.split(",");
        // Map markers - individual points for map markers - all region
        var layer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [
                    new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.fromLonLat([coordinateSplit[1],coordinateSplit[0]]))
                    })
                ]
            })
        });
        map.addLayer(layer);        
    });
    
    // Initialise marker popup
    var overlay = new ol.Overlay({
        element: container,
        autoPan: true,
        autoPanAnimation: {
            duration: 250
        }
    });
    map.addOverlay(overlay);
   
    // When marker has been clicked
    closer.onclick = function() {
        overlay.setPosition(undefined);
        closer.blur();
        return false;
    };

    // When map marker is clicked, popup opens
    map.on('singleclick', function (event) {
        if (map.hasFeatureAtPixel(event.pixel) === true) {
            var userCoordinate = event.coordinate;
            let xy = ol.proj.toLonLat(userCoordinate);
   
            // Compare coordinates - display location + data
            // Round user selected coordinates to nearest whole number
            var lon = (Math.round(xy[0]));
            var lat = (Math.round(xy[1]));
            
            // Go through every lon and lat from API list
            for (let i = 0; i < coordinates.length; i++) { 
                // Slit API coordinates into lon and lat
                const coordinateSplit = coordinates[i].RegionCoordinates.split(",");
                // Compare marker lon and lat with API
                if ((lon == Math.round(coordinateSplit[1])) && (lat == Math.round(coordinateSplit[0])))
                {
                    // If marker matches API
                    content.innerHTML = '<b style="background-color:white">'+coordinates[i].RegionName+'</b>';
                    // Create table with API crime details for specific region
                    displayCrimeDetailsOnMap(coordinates[i].RegionName);
                    break;
                }

              }
            overlay.setPosition(userCoordinate);
        } 
        else {
            overlay.setPosition(undefined);
            closer.blur();
        }
    });

    // Functionality - when user moves mouse on map display coordinates in myposition
    map.on('pointermove', function(e){
        let clickedCoordinate = e.coordinate;
        let xy = ol.proj.toLonLat(clickedCoordinate);
        $("#myposition").html("Lattitude: "+xy[1]+"<br>"+"Longitude: "+xy[0]);
    })
} 

// Generate table within side bar of map page
function displayCrimeDetailsOnMap(region)
{
    $.ajax({
        url: '/knifecrimes/coordinates/region='+region+'/dates',
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            document.getElementById("table").innerHTML = '&nbsp;';
            var content = document.getElementById("table");
            var tableHTML = '<table class="tabledata">'+
                         '<tr>'+
                         '<th>Force</th>'+
                         '<th>Region</th>'+
                         '<th>Date</th>'+
                         '<th>Crime total</th>'+
                         '</tr>';
            $.each(data, function (index, specificKnifeCrimeData)
            {
                tableHTML += '<tr>'+
                             '<td>'+specificKnifeCrimeData.ForceName+'</td>'+
                             '<td>'+specificKnifeCrimeData.Region+'</td>'+
                             '<td>'+specificKnifeCrimeData.Date+'</td>'+
                             '<td>'+specificKnifeCrimeData.TotalKnifeCrime+'</td>'+
                             '</tr>';
            });
            tableHTML += '</table>';
            content.innerHTML = tableHTML;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    }); 
}