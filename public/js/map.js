    var map = L.map('map', {
    center: [0.7893, 120.9213],
    zoom: 5,
    // attributionControl: false,
    zoomControl: false
    });

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Auriga Nusantara'
    }).addTo(map);



    Array.prototype.removeByValue = function (val) {
        for (var i = 0; i < this.length; i++) {
          if (this[i] === val) {
            this.splice(i, 1);
            i--;
          }
        }
        return this;
      }
    var layerID = []

    function show(element) {
        // console.log(element.id)

        var layerName = element.id
        if (element.checked) {
            var layerName = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
            layers: "administrative_boundaries",
            transparent: true,
            format: 'image/png'
            });


            layerID.push(layerName);
            map.addLayer(layerName)
            console.log(layerID)

        }
        else {
            layerID.removeByValue(layerID);
        }

    }




