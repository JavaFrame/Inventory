Vue.component("camera", {
    mounted: function() {
        new WebCodeCamJS("canvas").init({
            resultFunction: result => {
                let format = result.format;
                if(format != "EAN-13" && format != "EAN-8") return;
                this.$emit("code-recognized", result.code);
            },

            decoderWorker: "js/lib/DecoderWorker.js",
            codeRepetition: false,
        }).play();

    },
    template: `<canvas id="camera" width="320" height="180" style="transform:scale(1,1);"></canvas>`,
})
