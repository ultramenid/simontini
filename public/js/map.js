    var map = L.map('map', {
    center: [0.7893, 120.9213],
    zoom: 5,
    // attributionControl: false,
    zoomControl: false
    });

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Auriga Nusantara'
    }).addTo(map);


    var kawasanhutan = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'simontini:Forest_estate_adm',
        transparent: true,
        format: 'image/png'
    });
    var hutanalam = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'simontini:Hutan_Alam_adm',
        transparent: true,
        format: 'image/png'
    });
    var kantonghabitat = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'simontini:KantongGajah2018RTM',
        transparent: true,
        format: 'image/png'
    });
    var deforestasi2023 = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'simontini:def_test 4326 v Thresholded',
        transparent: true,
        format: 'image/png'
    });
    var hgu = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'kpa:HGU_BPN_2019',
        transparent: true,
        format: 'image/png'
    });
    var adminkabkota = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'administrative_boundaries',
        transparent: true,
        format: 'image/png'
    });

    var potensiminerba = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'tiger:Geologi 100K Selected',
        transparent: true,
        format: 'image/png'
    });

    var pbph = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'simontini:PBPH_AR_50K_DESEMBER_2023',
        transparent: true,
        format: 'image/png'
    });

    var iup = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'simontini:2024 Momi Minerba 6 February',
        transparent: true,
        format: 'image/png'
    });

    // checkbox section
    $('#adminkabkota:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(adminkabkota);
        } else {
            map.removeLayer(adminkabkota);
        }
    });
    $('#hutanalam:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(hutanalam);
        } else {
            map.removeLayer(hutanalam);
        }
    });
    $('#hgu:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(hgu);
        } else {
            map.removeLayer(hgu);
        }
    });
    $('#kawasanhutan:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(kawasanhutan);
        } else {
            map.removeLayer(kawasanhutan);
        }
    });
    $('#deforestasi2023:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(deforestasi2023);
        } else {
            map.removeLayer(deforestasi2023);
        }
    });
    $('#kantonghabitat:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(kantonghabitat);
        } else {
            map.removeLayer(kantonghabitat);
        }
    });
    $('#pbph:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(pbph);
        } else {
            map.removeLayer(pbph);
        }
    });

    $('#iup:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(iup);
        } else {
            map.removeLayer(iup);
        }
    });




