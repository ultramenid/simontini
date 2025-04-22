// Initialize the map
const map = L.map('map', {
    center: [0.7893, 118.9213],
    zoom: 5,
    zoomControl: false
  });

  // Base maps
  const baseLayers = [
    {
      url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}.png',
      icon: '../assets/esri-satelit.png'
    },
    {
      url: 'http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Dark_Gray_Base/MapServer/tile/{z}/{y}/{x}',
      icon: '../assets/dark.jpeg'
    },
    {
      url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
      icon: '../assets/osm.png',
      addToMap: true
    }
  ];

  // Prepare layers and optionally add to map
const baseLayerConfigs = baseLayers.map(b => {
    const layer = L.tileLayer(b.url, {
      attribution: 'Auriga Nusantara',
      detectRetina: true,
      maxNativeZoom: 17
    });

    if (b.addToMap) {
      layer.addTo(map);
    }

    return {
      layer,
      icon: b.icon,
      name: ''
    };
  });

  // Add switcher
  new L.bmSwitcher(baseLayerConfigs, { position: 'bottomleft' }).addTo(map);

  // WMS layers
  const wmsLayers = {
    deforestasi2023: 'simontini:Auriga - Deforestasi 2023',
    deforestasi2024: 'simontini:ID_STADI24_CEA',
    kawasanhutan: 'simontini:Forest_estate_adm',
    hutanalam: 'simontini:Hutan_Alam_adm',
    kantonghabitat: 'simontini:KantongGajah2018RTM',
    hgu: 'kpa:HGU_BPN_2019',
    adminkabkota: 'administrative_boundaries',
    potensiminerba: 'tiger:Geologi 100K Selected',
    pbph: 'simontini:PBPH_AR_50K_DESEMBER_2023',
    iup: 'simontini:mining_concession_2025_01_27'
  };

  const layers = {};
  for (const [key, layerName] of Object.entries(wmsLayers)) {
    layers[key] = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
      layers: layerName,
      transparent: true,
      format: 'image/png'
    });
  }

  // Setup checkboxes
  Object.keys(layers).forEach(key => {
    $(`#${key}:checkbox`).on('change', function () {
      const isChecked = $(this).is(':checked');
      const legend = document.getElementById(`${key}legend`);

      isChecked ? map.addLayer(layers[key]) : map.removeLayer(layers[key]);
      if (legend) legend.style.display = isChecked ? 'block' : 'none';
    });
  });
