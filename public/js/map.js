    var map = L.map('map', {
    center: [0.7893, 118.9213],
    zoom: 5,
    // attributionControl: false,
    zoomControl: false
    });

    new L.bmSwitcher([
        {
          layer:  L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}.png', {
            detectRetina: true,
            attribution: 'Auriga Nusantara',
            maxNativeZoom: 17}),
          icon: '../assets/esri-satelit.png',
          name: ''
        },
        {
          layer: L.tileLayer('http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Dark_Gray_Base/MapServer/tile/{z}/{y}/{x}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3'],
            attribution: 'Auriga Nusantara'
        }),
          icon: '../assets/dark.jpeg',
          name: ''
        },
        {
          layer: L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            detectRetina: true,
            attribution: 'Auriga Nusantara',
            maxNativeZoom: 17
        }).addTo(map),
          icon: '../assets/osm.png',
          name: ''
        },
      ], { position: 'bottomleft' }).addTo(map);

    var deforestasi2023 = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
        layers: 'simontini:Auriga - Deforestasi 2023',
        transparent: true,
        format: 'image/png'
    });
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
            document.getElementById("administrasikabkotalegend").style.display = 'block';
        } else {
            map.removeLayer(adminkabkota);
            document.getElementById("administrasikabkotalegend").style.display = 'none';

        }
    });
    $('#hutanalam:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(hutanalam);
            document.getElementById("hutanalamlegend").style.display = 'block';

        } else {
            map.removeLayer(hutanalam);
            document.getElementById("hutanalamlegend").style.display = 'block';

        }
    });
    $('#hgu:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(hgu);
            document.getElementById("hgulegend").style.display = 'block';

        } else {
            map.removeLayer(hgu);
            document.getElementById("hgulegend").style.display = 'none';

        }
    });
    $('#kawasanhutan:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(kawasanhutan);
            document.getElementById("kawasanhutanlegend").style.display = 'block';
        } else {
            map.removeLayer(kawasanhutan);
            document.getElementById("kawasanhutanlegend").style.display = 'none';

        }
    });
    $('#deforestasi2023:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(deforestasi2023);
            document.getElementById("deforestasi2023legend").style.display = 'block';
        } else {
            map.removeLayer(deforestasi2023);
            document.getElementById("deforestasi2023legend").style.display = 'none';

        }
    });
    $('#kantonghabitat:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(kantonghabitat);
            document.getElementById("katonghabitatlegend").style.display = 'block';

        } else {
            map.removeLayer(kantonghabitat);
            document.getElementById("katonghabitatlegend").style.display = 'none';

        }
    });
    $('#pbph:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(pbph);
            document.getElementById("pbphlegend").style.display = 'block';

        } else {
            map.removeLayer(pbph);
            document.getElementById("pbphlegend").style.display = 'none';

        }
    });

    $('#iup:checkbox').on('change', function() {
        var checkbox = $(this);
        // toggle the layer
        if ($(checkbox).is(':checked')) {
            map.addLayer(iup);
            document.getElementById("iuplegend").style.display = 'block';
        } else {
            map.removeLayer(iup);
            document.getElementById("iuplegend").style.display = 'block';
        }
    });




