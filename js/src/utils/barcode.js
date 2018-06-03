define(new class {
    readBarcode(dataArray) {
        let line = this.grayscaleImg(dataArray);
        console.log(line)
    }

    readFromCanvas(canvas, y = -1) {
        let width = canvas.width
        let height = canvas.height
        let ctx = canvas.getContext("2d")
        let spoints = [1, 9, 2, 8, 3, 7, 4, 6, 5]
        let numLines = spoints.length
        let slineStep = height / (numLines + 1)
        let round = Math.round;
        if(y == -1)
            y = height / 2;
        console.log("width: " + width + ", height: " + height);
        let data = ctx.getImageData(0, y, width, 1).data;
        let canvas2 = document.getElementById("debugger1");
        let ctx2 = canvas2.getContext("2d");
        let imgData = ctx2.createImageData(width, height);

        this.readBarcode(data);

        ctx2.putImageData(imgData, 0, 0);
        this.drawDebug(canvas);
        return false;
    }

    grayscaleImg(imgData) {
        let line = [];
        let counter = 0;
        for(let i = 0; i < imgData.length; i += 4) {
            let r = imgData[i];
            let g = imgData[i + 1];
            let b = imgData[i + 2];

            let grayscale = r * .3 + g * .59 + b * .11;
            if(grayscale > 124)
                line[counter] = true;
            else
                line[counter] = false;
            counter++;
        }
        return line;
    }

    drawDebug(canvas) {
        let canvas2 = document.getElementById("debugger2");
        let ctx2 = canvas2.getContext("2d");

        let ctx = canvas.getContext("2d");
        let imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        ctx2.putImageData(imgData, 0, 0)
        ctx2.beginPath()
        ctx2.lineWidth="1";
        ctx2.strokeStyle="red";
        ctx2.rect(0, canvas.height/2, canvas.width, 1)
        ctx2.stroke();
    }
});
