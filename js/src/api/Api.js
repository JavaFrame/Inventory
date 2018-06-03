define([], function() {
    return new class Api {
        constructor() {
            this.cart = [];
        }

        getItem(productId) {
            return this.request("/get", [productId]);
        }

        buyItems(items) {
            return this.request("/buy", [items]);
        }

        request(url, parameter, baseUrl = "php/src/api.php") {
            return new Promise((resolve, reject) => {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", baseUrl + url, true);
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onload = () => {
                    let obj = JSON.parse(xhr.responseText);
                    if(obj.type == "error")
                        reject(obj);
                    resolve(obj.data);
                };
                xhr.onerror = () => reject({type: "error", code: 0, msg: xhr.statusText});
                xhr.send(JSON.stringify(parameter));
            }).catch(this.errorHandling);
        }

        errorHandling(error) {
            if([].indexOf(error.code) != -1)
                return;
            console.error("PHP error (" + error.code + "): " + error.msg + "\n" + error.ex)
        }
    }
})
