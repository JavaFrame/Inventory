requirejs.config({
    baseUrl: "js/src/",
    paths: {
        "vue": "../lib/vue",
        "webcam" : "../lib/webcam.min",
        "barcode": "../lib/JOB/BarcodeReader"
    }
})
require(["vue",  "api/Api", "webcam", "barcode"],
    function(Vue, Api, Webcam, Barcode) {
        var app = new Vue({
            el: "#app",
            data: {
                cart: [],
                total: 0,
                camImg: null,
                barcode: ""
            },
            methods: {
    /*            readBarcode: function() {
                    let that = this;
                    Webcam.snap(function(data, canvas) {
                        that.barcode = Barcode.readFromCanvas(canvas);
                    })
    */
                readBarcode: function() {

                }
            }
        })

        //init webcam
        Webcam.set({
            width: 720,
            height: 240,
            image_format: "jpeg",
            jpeg_quality: 90,
            fps: 15
        })
        Webcam.attach("#camera");
        Barcode.Init();
        Barcode.SetStreamCallback(function(result) {
            console.log(result);
        })
        Webcam.on("live", function() {
        })
    });
